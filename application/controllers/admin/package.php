<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends MY_Controller {

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

    	$data['page'] = 'package';
        $data['page_title'] = 'DateClip Admin Panel :: Package Management';

        $data['list'] = $this->my_model_v2->get();

        $data['main_content'] = 'admin/package/list';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     */
    public function add() {

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('name', 'Name', 'required');
    		$this->form_validation->set_rules('type', 'Type', 'required');
    		$this->form_validation->set_rules('description', 'Description', 'required');
    		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
    		$this->form_validation->set_rules('credit', 'Credit', 'required|integer');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			$data_to_store = array(
    				'name' => htmlspecialchars($this->input->post('name'), ENT_QUOTES, 'utf-8'),
    				'type' => htmlspecialchars($this->input->post('type'), ENT_QUOTES, 'utf-8'),
    				'description' => $this->input->post('description'),
    				'price' => htmlspecialchars($this->input->post('price'), ENT_QUOTES, 'utf-8'),
    				'credit' => htmlspecialchars($this->input->post('credit'), ENT_QUOTES, 'utf-8')
    			);

    			if ($this->my_model_v2->insert($data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Package have been added successfully.');
    			} else {
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
    			}
    			redirect('/admin/package/');
    		}
    	}

        $data['page'] = 'package';
        $data['page_title'] = 'DateClip Admin Panel :: Package Management &raquo; Add Package';

        $data['main_content'] = 'admin/package/add';
        $this->load->view('admin/includes/template', $data);
    }


    /**
     *
     * @param int $id
     */
    public function edit ($id = null) {

    	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

    	if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/package/');
    	}

    	// if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('name', 'Name', 'required');
    		$this->form_validation->set_rules('type', 'Type', 'required');
    		$this->form_validation->set_rules('description', 'Description', 'required');
    		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
    		$this->form_validation->set_rules('credit', 'Credit', 'required|integer');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			$data_to_store = array(
    				'name' => htmlspecialchars($this->input->post('name'), ENT_QUOTES, 'utf-8'),
    				'type' => htmlspecialchars($this->input->post('type'), ENT_QUOTES, 'utf-8'),
    				'description' => $this->input->post('description'),
    				'price' => htmlspecialchars($this->input->post('price'), ENT_QUOTES, 'utf-8'),
    				'credit' => htmlspecialchars($this->input->post('credit'), ENT_QUOTES, 'utf-8')
    			);

    			//if the insert has returned true then we show the flash message
    			if ($this->my_model_v2->update($this->input->post('id'), $data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Package successfully updated.');
    			} else{
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
    			}
    			redirect('/admin/package/');
    		}
    	}

     	$data['page'] = 'package';
        $data['page_title'] = 'DateClip Admin Panel :: Package Management &raquo; Edit Package';

        $data['main_content'] = 'admin/package/edit';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     * @param int $id
     */
    public function delete($id = null) {

    	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

        if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/package/');
    	}

        if (!$this->my_model_v2->is_valid_data('user_package_log', array('package_id' => $id))) {

            if ($this->my_model_v2->delete($id)) {
                $this->session->set_flashdata('message_type', 'success');
    			$this->session->set_flashdata('message', '<strong>Well done!</strong> Package successfully deleted.');
            } else {
            	$this->session->set_flashdata('message_type', 'danger');
            	$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
            }
            redirect('/admin/package/');

        } else {
        	$this->session->set_flashdata('message_type', 'warning');
        	$this->session->set_flashdata('message', '<strong>Wait!</strong> This package is already in use.');
            redirect('/admin/package/');
        }

    }
}

/* End of file flag.php */
/* Location: ./application/controllers/admin/package.php */