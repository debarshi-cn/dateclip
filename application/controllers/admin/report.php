<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 * 	- or -
	 * 		http://example.com/index.php/welcome/index
	 * 	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct() {

        parent::__construct();

        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }

        $this->load->model('report_model');
    }

    /**
     *
     */
    public function dateclip() {

    	$data = array();
    	$page = $this->uri->segment(5);

    	// Search values
    	$searchName = $this->input->post('name');
    	$searchReported = $this->input->post('reported');
    	$searchDateFrom = $this->input->post('date_from');
    	$searchDateTo = $this->input->post('date_to');

    	if ($searchName !== false) {
    		$filter_session_data['name_dc_report'] = $searchName;
    	} else {
    		$searchName = $this->session->userdata('name_dc_report');
    	}

    	if ($searchReported !== false) {
    		$filter_session_data['reported_dc_report'] = $searchReported;
    	} else {
    		$searchReported = $this->session->userdata('reported_dc_report');
    	}

    	if ($searchDateFrom !== false) {
    		$filter_session_data['date_from_dc_report'] = $searchDateFrom;
    	} else {
    		$searchDateFrom = $this->session->userdata('date_from_dc_report');
    	}

    	if ($searchDateTo !== false) {
    		$filter_session_data['date_to_dc_report'] = $searchDateTo;
    	} else {
    		$searchDateTo = $this->session->userdata('date_to_dc_report');
    	}

    	$data['search']['name'] = $searchName;
    	$data['search']['reported'] = $searchReported;
    	$data['search']['date_from'] = $searchDateFrom;
    	$data['search']['date_to'] = $searchDateTo;

    	// Save session data in the session
    	if (isset($filter_session_data)) {
    		$this->session->set_userdata($filter_session_data);
    	}

    	if ($this->uri->segment(4) == "reset") {
    		$filter = array('name_dc_report' => '',
    						'reported_dc_report' => '',
    						'date_from_dc_report' => '',
    						'date_to_dc_report' => ''
    					);

    		$this->session->set_userdata($filter);
    		redirect('/admin/report/dateclip/');
    	}

    	$this->load->library('pagination');

    	$config['per_page'] = 10;
    	$config['base_url'] = base_url().'admin/report/dateclip/index';
    	$config['use_page_numbers'] = TRUE;
    	$config['num_links'] = 20;
    	$config['full_tag_open'] = '<ul class="pagination">';
    	$config['full_tag_close'] = '</ul>';
    	$config['next_link'] = '&raquo;';
    	$config['prev_link'] = '&laquo;';
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';
    	$config['num_tag_open'] = '<li>';
    	$config['num_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a>';
    	$config['cur_tag_close'] = '</a></li>';
    	$config['uri_segment'] = 5;

    	//math to get the initial record to be select in the database
    	$limit_end = ($page * $config['per_page']) - $config['per_page'];
    	if ($limit_end < 0){
    		$limit_end = 0;
    	}

    	//fetch sql data into arrays
    	$config['total_rows'] = $data['count'] = $this->report_model->get_dateclip_flag_report($data['search'], null, null, 'count');
    	$data['list'] = $this->report_model->get_dateclip_flag_report($data['search'], $config['per_page'], $limit_end);

    	//initializate the panination helper
    	$this->pagination->initialize($config);

    	$data['page'] = 'report-dateclip';
    	$data['page_title'] = 'DateClip Admin Panel :: Reports &raquo; Flagged DateClip';

    	$data['main_content'] = 'admin/report/dateclip';
    	$this->load->view('admin/includes/template', $data);
    }


    /**
     *
     */
    public function dateclip_update_status() {

    	$this->load->library('form_validation');

    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		//form validation
    		$this->form_validation->set_rules('operation', 'Operation', 'required');
    		$this->form_validation->set_rules('item_id[]', 'Flagged DateClip', 'trim|required');

    		$this->form_validation->set_error_delimiters('', '');

    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    			$count = 0;
    			$items = $this->input->post('item_id');
    			$operation = $this->input->post('operation');

    			$data_to_store = array(
    				'status' => $operation,
    				'modified_date' => date('Y-m-d H:i:s')
    			);

    			$this->load->model('my_model_v2');
    			$this->my_model_v2->initialize(array(
    				'table_name' => 'user_flag_dateclip',
    				'primary_key' => 'id'
    			));

    			foreach ($items as $id=>$value) {

    				if ($this->my_model_v2->update($id, $data_to_store)) {
    					$count++;
    				}
    			}
    			$this->session->set_flashdata('message_type', 'success');
    			$this->session->set_flashdata('message', '<strong>Well done!</strong> '.$count.' record(s) successfully updated.');

    		} else {
    			$this->session->set_flashdata('message_type', 'danger');
    			$this->session->set_flashdata('message', validation_errors());
    		}

    		redirect('/admin/report/dateclip/');
    	}
    }



    /**
     *
     */
    public function message() {

    	$data = array();
    	$page = $this->uri->segment(5);
    	$this->load->helper('text');

    	// Search values
    	$searchName = $this->input->post('name');
    	$searchReported = $this->input->post('reported');
    	$searchDateFrom = $this->input->post('date_from');
    	$searchDateTo = $this->input->post('date_to');

    	if ($searchName !== false) {
    		$filter_session_data['name_m_report'] = $searchName;
    	} else {
    		$searchName = $this->session->userdata('name_m_report');
    	}

    	if ($searchReported !== false) {
    		$filter_session_data['reported_m_report'] = $searchReported;
    	} else {
    		$searchReported = $this->session->userdata('reported_m_report');
    	}

    	if ($searchDateFrom !== false) {
    		$filter_session_data['date_from_m_report'] = $searchDateFrom;
    	} else {
    		$searchDateFrom = $this->session->userdata('date_from_m_report');
    	}

    	if ($searchDateTo !== false) {
    		$filter_session_data['date_to_m_report'] = $searchDateTo;
    	} else {
    		$searchDateTo = $this->session->userdata('date_to_m_report');
    	}

    	$data['search']['name'] = $searchName;
    	$data['search']['reported'] = $searchReported;
    	$data['search']['date_from'] = $searchDateFrom;
    	$data['search']['date_to'] = $searchDateTo;

    	// Save session data in the session
    	if (isset($filter_session_data)) {
    		$this->session->set_userdata($filter_session_data);
    	}

    	if ($this->uri->segment(4) == "reset") {
    		$filter = array('name_m_report' => '',
    						'reported_m_report' => '',
    						'date_from_m_report' => '',
    						'date_to_m_report' => ''
    					);

    		$this->session->set_userdata($filter);
    		redirect('/admin/report/message/');
    	}

    	$this->load->library('pagination');

    	$config['per_page'] = 10;
    	$config['base_url'] = base_url().'admin/report/message/index';
    	$config['use_page_numbers'] = TRUE;
    	$config['num_links'] = 20;
    	$config['full_tag_open'] = '<ul class="pagination">';
    	$config['full_tag_close'] = '</ul>';
    	$config['next_link'] = '&raquo;';
    	$config['prev_link'] = '&laquo;';
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';
    	$config['num_tag_open'] = '<li>';
    	$config['num_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a>';
    	$config['cur_tag_close'] = '</a></li>';
    	$config['uri_segment'] = 5;

    	//math to get the initial record to be select in the database
    	$limit_end = ($page * $config['per_page']) - $config['per_page'];
    	if ($limit_end < 0){
    		$limit_end = 0;
    	}

    	//fetch sql data into arrays
    	$config['total_rows'] = $data['count'] = $this->report_model->get_message_flag_report($data['search'], null, null, 'count');
    	$data['list'] = $this->report_model->get_message_flag_report($data['search'], $config['per_page'], $limit_end);

    	//initializate the panination helper
    	$this->pagination->initialize($config);

    	$data['page'] = 'report-message';
    	$data['page_title'] = 'DateClip Admin Panel :: Reports &raquo; Flagged Messages';

    	$data['main_content'] = 'admin/report/message';
    	$this->load->view('admin/includes/template', $data);
    }



    /**
     *
     */
    public function message_update_status() {

    	$this->load->library('form_validation');

    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		//form validation
    		$this->form_validation->set_rules('operation', 'Operation', 'required');
    		$this->form_validation->set_rules('item_id[]', 'Flagged DateClip', 'trim|required');

    		$this->form_validation->set_error_delimiters('', '');

    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    			$count = 0;
    			$items = $this->input->post('item_id');
    			$operation = $this->input->post('operation');

    			$data_to_store = array(
    				'status' => $operation,
    				'modified_date' => date('Y-m-d H:i:s')
    			);

    			$this->load->model('my_model_v2');
    			$this->my_model_v2->initialize(array(
    				'table_name' => 'user_flag_message',
    				'primary_key' => 'id'
    			));

    			foreach ($items as $id=>$value) {

    				if ($this->my_model_v2->update($id, $data_to_store)) {
    					$count++;
    				}
    			}
    			$this->session->set_flashdata('message_type', 'success');
    			$this->session->set_flashdata('message', '<strong>Well done!</strong> '.$count.' record(s) successfully updated.');

    		} else {
    			$this->session->set_flashdata('message_type', 'danger');
    			$this->session->set_flashdata('message', validation_errors());
    		}

    		redirect('/admin/report/message/');
    	}
    }


    /**
     *
     */
    public function finance() {

    	$data = array();
    	$page = $this->uri->segment(5);

    	// Search values
    	$searchName = $this->input->post('name');
    	$searchReported = $this->input->post('reported');
    	$searchDateFrom = $this->input->post('date_from');
    	$searchDateTo = $this->input->post('date_to');

    	if ($searchName !== false) {
    		$filter_session_data['name_m_report'] = $searchName;
    	} else {
    		$searchName = $this->session->userdata('name_m_report');
    	}

    	if ($searchReported !== false) {
    		$filter_session_data['reported_m_report'] = $searchReported;
    	} else {
    		$searchReported = $this->session->userdata('reported_m_report');
    	}

    	if ($searchDateFrom !== false) {
    		$filter_session_data['date_from_m_report'] = $searchDateFrom;
    	} else {
    		$searchDateFrom = $this->session->userdata('date_from_m_report');
    	}

    	if ($searchDateTo !== false) {
    		$filter_session_data['date_to_m_report'] = $searchDateTo;
    	} else {
    		$searchDateTo = $this->session->userdata('date_to_m_report');
    	}

    	$data['search']['name'] = $searchName;
    	$data['search']['reported'] = $searchReported;
    	$data['search']['date_from'] = $searchDateFrom;
    	$data['search']['date_to'] = $searchDateTo;

    	// Save session data in the session
    	if (isset($filter_session_data)) {
    		$this->session->set_userdata($filter_session_data);
    	}

    	if ($this->uri->segment(4) == "reset") {
    		$filter = array('name_m_report' => '',
    				'reported_m_report' => '',
    				'date_from_m_report' => '',
    				'date_to_m_report' => ''
    		);

    		$this->session->set_userdata($filter);
    		redirect('/admin/report/finance/');
    	}

    	//fetch sql data into arrays
    	$data['list'] = $this->report_model->get_message_flag_report($data['search']);

    	$data['page'] = 'report-finance';
    	$data['page_title'] = 'DateClip Admin Panel :: Reports &raquo; Finance';

    	$data['main_content'] = 'admin/report/finance';
    	$this->load->view('admin/includes/template', $data);
    }

    /**
     *
     * @param unknown_type $id
     */
    public function details($id) {

    	$data['user'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

    	// Check for actual user
    	if (isset($data['user']) && empty($data['user'])) {
    		$data['error'] = "No data found";
    		$this->load->view('admin/user/details', $data);
    		return;
    	}

    	$this->load->view('admin/user/details', $data);
    }



}

/* End of file report.php */
/* Location: ./application/controllers/admin/report.php */