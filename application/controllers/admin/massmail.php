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



}

/* End of file flag.php */
/* Location: ./application/controllers/admin/package.php */