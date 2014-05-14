<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flag extends MY_Controller {

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
        		'table_name' => 'flag',
        		'primary_key' => 'id'
        ));
    }

    /**
     *
     */
    public function index() {

    	$data['page'] = 'flag';
        $data['page_title'] = 'DateClip Admin Panel :: Flag Management';

        $data['list'] = $this->my_model_v2->get();

        $data['main_content'] = 'admin/flag/list';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     */
    public function add() {

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('title', 'Flag', 'required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			$data_to_store = array(
    				'flag' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8')
    			);

    			if ($this->my_model_v2->insert($data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Flag have been added successfully.');
    			} else {
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Error adding flag.');
    			}
    			redirect('/admin/flag/');
    		}
    	}

        $data['page'] = 'flag';
        $data['page_title'] = 'DateClip Admin Panel :: Flag Management &raquo; Add Flag';

        $data['main_content'] = 'admin/flag/add';
        $this->load->view('admin/includes/template', $data);
    }


    /**
     *
     * @param int $id
     */
    public function edit ($id = null) {

    	// if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('title', 'Flag', 'required');
    		$this->form_validation->set_rules('id', 'Id', 'required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			$data_to_store = array(
    					'flag' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8')
    			);

    			//if the insert has returned true then we show the flash message
    			if ($this->my_model_v2->update($this->input->post('id'), $data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Flag successfully updated.');
    			} else{
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
    			}
    			redirect('/admin/flag/');
    		}
    	}

    	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

    	if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/flag/');
    	}


     	$data['page'] = 'flag';
        $data['page_title'] = 'DateClip Admin Panel :: Flag Management &raquo; Edit Flag';

        $data['main_content'] = 'admin/flag/edit';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     * @param int $id
     */
    public function delete($id = null) {

    	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

        if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/flag/');
    	}

        if (!$this->my_model_v2->is_valid_data('user_flag_dateclip', array('flag_id' => $id))) {

            if ($this->my_model_v2->delete($id)) {
                $this->session->set_flashdata('message_type', 'success');
    			$this->session->set_flashdata('message', '<strong>Well done!</strong> Flag successfully deleted.');
            } else {
            	$this->session->set_flashdata('message_type', 'danger');
            	$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
            }
            redirect('/admin/flag/');

        } else {
        	$this->session->set_flashdata('message_type', 'warning');
        	$this->session->set_flashdata('message', '<strong>Wait!</strong> The flag is already in use.');
            redirect('/admin/flag/');
        }

    }
}

/* End of file flag.php */
/* Location: ./application/controllers/admin/flag.php */