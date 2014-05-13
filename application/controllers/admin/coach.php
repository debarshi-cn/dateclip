<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coach extends MY_Controller {

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
        	'table_name' => 'coach',
        	'primary_key' => 'id'
        ));
    }

    /**
     *
     */
    public function index() {

    	$data['page'] = 'coach';
        $data['page_title'] = 'DateClip Admin Panel :: Coach Management';

        $data['list'] = $this->my_model_v2->get();

        $data['main_content'] = 'admin/coach/list';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     */
    public function add() {

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('title', 'Coach', 'required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			$data_to_store = array(
    				'coach' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8')
    			);

    			if ($this->my_model_v2->insert($data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Coach have been added successfully.');
    			} else {
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Error adding coach.');
    			}
    			redirect('/admin/coach/');
    		}
    	}

        $data['page'] = 'coach';
        $data['page_title'] = 'DateClip Admin Panel :: Coach Management &raquo; Add Coach';

        $data['main_content'] = 'admin/coach/add';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     * @param int $id
     */
    public function edit($id = null) {

    	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

    	if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/coach/');
    	}

    	// if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('title', 'Coach', 'required');
    		$this->form_validation->set_rules('id', 'Id', 'required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			$data_to_store = array(
    				'coach' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8')
    			);

    			//if the insert has returned true then we show the flash message
    			if ($this->my_model_v2->update($this->input->post('id'), $data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Coach successfully updated.');
    			} else{
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
    			}
    			redirect('/admin/coach/');
    		}
    	}
     	$data['page'] = 'coach';
        $data['page_title'] = 'DateClip Admin Panel :: Coach Management &raquo; Edit Coach';

        $data['main_content'] = 'admin/coach/edit';
        $this->load->view('admin/includes/template', $data);
    }


    /**
     *
     * @param int $id
     */
    public function delete($id = null) {

    	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

    	if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/coach/');
    	}

        if (!$this->my_model_v2->is_valid_data('user_coach_dateclip', array('coach_id' => $id))) {

            if ($this->my_model_v2->delete($id)) {
                $this->session->set_flashdata('message_type', 'success');
    			$this->session->set_flashdata('message', '<strong>Well done!</strong> Coach successfully deleted.');
            } else {
            	$this->session->set_flashdata('message_type', 'danger');
            	$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
            }
            redirect('/admin/coach/');

        } else {
        	$this->session->set_flashdata('message_type', 'warning');
        	$this->session->set_flashdata('message', '<strong>Wait!</strong> The coach is already in use.');
            redirect('/admin/coach/');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */