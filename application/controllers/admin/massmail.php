<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Massmail extends MY_Controller {

	/**
	 *
	 */
    public function __construct() {

        parent::__construct();

        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }

        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
        	'table_name' => 'package',
        	'primary_key' => 'id'
        ));
    }

    /**
     *
     */
    public function index() {

    	$data['page'] = 'massmail';
        $data['page_title'] = 'DateClip Admin Panel :: Package Management';

       // $data['list'] = $this->my_model_v2->get();

        $data['main_content'] = 'admin/massmail/send';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     */
    public function send() {

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
    		$this->form_validation->set_rules('body', 'Message', 'trim|required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			$names = htmlspecialchars($this->input->post('name'), ENT_QUOTES, 'utf-8');
    			$gender = $this->input->post('gender');
    			$location = htmlspecialchars($this->input->post('location'), ENT_QUOTES, 'utf-8');
    			$age_start = htmlspecialchars($this->input->post('age_start'), ENT_QUOTES, 'utf-8');
    			$age_end = htmlspecialchars($this->input->post('age_end'), ENT_QUOTES, 'utf-8');
    			$status = $this->input->post('status');
    			$dateclip = $this->input->post('dateclip');

    			$subject = htmlspecialchars($this->input->post('subject'), ENT_QUOTES, 'utf-8');
    			$body = htmlspecialchars($this->input->post('body'), ENT_QUOTES, 'utf-8');
    			$email = $this->input->post('email');

    			$where = " WHERE 1=1 ";

    			if (isset($names) && $names <> "") {
    				$users = explode(",", $names);

    				foreach ($users as $user_str) {
    					if (trim($user_str) <> "") {
	    					$pos1 = strrpos($user_str, "(")+1;
	    					$pos2 = strrpos($user_str, ")");

	    					$user_id[] = substr($user_str, $pos1, ($pos2-$pos1));
    					}
    				}
    			}

    			// If Searched by Username
    			if (isset($user_id) && !empty($user_id)) {

    				$idin = implode(',', $user_id);
    				$where .= " AND `id` IN (".$idin.") ";
    			}

    			// If Searched by Gender
    			if (isset($gender) && !empty($gender)) {

    				$genderin = "";
    				foreach ($gender as $gen) {
    					$genderin .= "'".$gen."', ";
    				}
    				$genderin = substr($genderin, 0, -2);
    				$where .= " AND `gender` IN (".$genderin.") ";
    			}

    			// If Searched by Location
    			if (isset($location) && $location <> "") {
    				$where .= " AND location like '%".$location."%' ";
    			}

    			// Search by Status
    			if (isset($status) && !empty($status)) {

    				$statusin = implode(',', $status);
    				$where .= " AND `status` IN (".$statusin.") ";
    			}

    			// Search by DateClip
    			if (isset($dateclip) && $dateclip <> "") {
    				//$where .= " AND location like '%".$location."%' ";
    			}

    			// Search by Start Age
    			if (isset($age_start) && $age_start <> "") {
    				$where .= " AND date_of_birth <= NOW() - INTERVAL ".$age_start." YEAR ";
    			}

    			// Search by End Age
    			if (isset($age_end) && $age_end <> "") {
    				$where .= " AND date_of_birth >= NOW() - INTERVAL ".$age_end." YEAR ";
    			}

    			$this->load->model('my_model_v2');
    			$this->my_model_v2->initialize(array(
    				'table_name' => 'mass_mailing',
    				'primary_key' => 'id'
    			));

    			// Insert the original message
    			$data_to_store = array(
    				'subject' => $subject,
    				'message' => $body,
    				'notification' => ($email == "Y")?1:0,
    				'create_date' => date('Y-m-d H:i:s')
    			);
    			$mass_mailing_id = $this->my_model_v2->insert($data_to_store);

    			// Search the users
    			$this->my_model_v2->initialize(array(
    				'table_name' => 'user',
    				'primary_key' => 'id'
    			));
    			$user_data = $this->my_model_v2->query($where);

    			$mail_counter = 0;

    			foreach ($user_data as $user_obj) {
    				//echo $user_obj->email."<br>";

    				$this->my_model_v2->initialize(array(
    					'table_name' => 'mass_mailing_log',
    					'primary_key' => 'id'
    				));

    				$data_to_store = array(
	    				'user_id' => $user_obj->id,
	    				'mass_mailing_id' => $mass_mailing_id
	    			);

    				if ($this->my_model_v2->insert($data_to_store)) {
    					$mail_counter++;

    					// If email need to be sent
    					if ($email == "Y") {
    						$this->load->library('email_function');
    						$this->email_function->email_to_user($user_obj->email, $user_obj->full_name, $subject, $body);
    					}
    				}
    			}

    			if ($mail_counter > 0) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Message sent to '.$mail_counter.' user(s).');
    			} else {
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Can\'t send message. Change something and try again.');
    			}
    			redirect('/admin/massmail/');
    		}
    	}
    }



}

/* End of file flag.php */
/* Location: ./application/controllers/admin/package.php */