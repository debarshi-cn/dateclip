<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Front_Controller {


    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');

        if (!$this->session->userdata('LOGGED_IN')) {
            redirect('/');
        }

        $this->load->model('front_model');
    }

    public function index() {

    	$this->load->model('my_model_v2');
    	$this->my_model_v2->initialize(array(
    		'table_name' => 'user_search_settings',
    		'primary_key' => 'id'
    	));

    	$user_id = $this->session->userdata('user_id');

    	//print "<pre>"; print_r($_POST); print "</pre>";die;
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{

    		$this->form_validation->set_rules('gender', 'Gender', 'required');
    		$this->form_validation->set_rules('looking_for', 'Looking for', 'required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');

    		$age = $this->input->post('age');
    		$distance = $this->input->post('distance');

    		if ($this->form_validation->run()) {

    			$data_to_store = array(
    				'gender' => htmlspecialchars($this->input->post('gender'), ENT_QUOTES, 'utf-8'),
    				'looking_for' => htmlspecialchars($this->input->post('looking_for'), ENT_QUOTES, 'utf-8'),
    				'age_from' => htmlspecialchars($age['min'], ENT_QUOTES, 'utf-8'),
    				'age_to' => htmlspecialchars($age['max'], ENT_QUOTES, 'utf-8'),
    				'location_from' => htmlspecialchars($distance['min'], ENT_QUOTES, 'utf-8'),
    				'location_to' => htmlspecialchars($distance['max'], ENT_QUOTES, 'utf-8')
    			);

	    		//CHECK FOR SAME USER ID
	    		if ($this->front_model->check_user($user_id)) {

	    			$data_to_store['user_id'] = $user_id;

	    			//if the insert has returned true then we show the flash message
	    			if ($this->my_model_v2->insert($data_to_store)) {
	    				$this->session->set_flashdata('message_type', 'success');
	    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Search settings added successfully.');
	    			} else {
	    				$this->session->set_flashdata('message_type', 'danger');
	    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Error adding search settings.');
	    			}

	    		} else {

	    			//if the insert has returned true then we show the flash message
	    			if ($this->front_model->update_user_search_settings($user_id, $data_to_store)) {
	    				$this->session->set_flashdata('message_type', 'success');
	    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Search settings updated successfully.');
	    			} else {
	    				$this->session->set_flashdata('message_type', 'danger');
	    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Error updating search settings.');
	    			}
	    		}
	    		redirect('');
    		}
    	}

    	$search = $this->my_model_v2->get(1, NULL, NULL, array('user_id' => $user_id));

    	if (!is_object($search)) {
    		// Initialize it
    		$search = new stdClass;
    		$search->gender = '';
    		$search->looking_for = '';
    		$search->age_from = 18;
    		$search->age_to = 99;
    		$search->location_from = 0;
    		$search->location_to = 250;
    	}

    	$data['search'] = $search;
    	$data['main_content'] = 'search';
        $this->load->view('includes/template', $data);
    }

}

/* End of file search.php */
/* Location: ./application/controllers/search.php */