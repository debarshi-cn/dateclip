<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {


    public function __construct() {

        parent::__construct();

        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }

        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
        	'table_name' => 'cms',
        	'primary_key' => 'id'
        ));
    }

    public function index() {

    	$data['page'] = 'cms';
    	$data['page_title'] = 'DateClip Admin Panel :: CMS Management';

        $data['list'] = $this->my_model_v2->get();

        $data['main_content'] = 'admin/cms/list';
        $this->load->view('admin/includes/template', $data);
    }

    public function edit($id = null) {

    	// if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('name', 'Page name', 'trim|required');
    		$this->form_validation->set_rules('title', 'Title', 'trim|required');
    		$this->form_validation->set_rules('description', 'Content', 'trim|required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

    			$data_to_store = array(
    				'name' => htmlspecialchars($this->input->post('name'), ENT_QUOTES, 'utf-8'),
    				'title' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8'),
    				'description' => htmlspecialchars($this->input->post('description'), ENT_QUOTES, 'utf-8'),
    				'meta_keyword' => htmlspecialchars($this->input->post('meta_keyword'), ENT_QUOTES, 'utf-8'),
    				'meta_description' => htmlspecialchars($this->input->post('meta_description'), ENT_QUOTES, 'utf-8'),
    				'last_updated' => date('Y-m-d H:i:s')
    			);

    			//if the insert has returned true then we show the flash message
    			if ($this->my_model_v2->update($this->input->post('id'), $data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Coach successfully updated.');
    			} else{
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
    			}
    			redirect('/admin/cms/');
    		}
    	}

     	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

     	if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/cms/');
    	}

    	$data['page'] = 'cms';
    	$data['page_title'] = 'DateClip Admin Panel :: CMS Management &raquo; Edit CMS';

    	$data['main_content'] = 'admin/cms/edit';
    	$this->load->view('admin/includes/template', $data);
    }

}

/* End of file cms.php */
/* Location: ./application/controllers/admin/cms.php */