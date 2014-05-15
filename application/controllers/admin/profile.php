<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

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
        	'table_name' => 'admin',
        	'primary_key' => 'id'
        ));
    }

    /**
     *
     */
    public function index() {

    	$data['page'] = 'profile';
        $data['page_title'] = 'DateClip Admin Panel :: Update Profile';

        $data['admin'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $this->session->userdata('id')));

        $data['main_content'] = 'admin/profile/edit';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     */
    public function update() {

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
    		$this->form_validation->set_rules('body', 'Message', 'trim|required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			//print "<pre>"; print_r($_POST); print "</pre>";



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