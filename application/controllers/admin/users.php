<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

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
        //$this->load->model('user_model');
        $this->load->library('form_validation');

        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }

        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
        	'table_name' => 'user',
        	'primary_key' => 'id'
        ));
    }

    /**
     *
     */
    public function index() {

    	//echo $this->router->class."/".$this->router->method;die;
    	$page = $this->uri->segment(4);

    	// Search values
    	$searchName = $this->input->post('name');
    	$searchEmail = $this->input->post('email');
    	$searchLocation = $this->input->post('location');
    	$searchStatus = $this->input->post('status');

    	$sort = $this->input->get('sort');
    	$sort_dir = $this->input->get('sort_dir');

    	if ($searchName !== false) {
    		$filter_session_data['name_selected'] = $searchName;
    	} else {
    		$searchName = $this->session->userdata('name_selected');
    	}

    	if ($searchEmail !== false) {
    		$filter_session_data['email_selected'] = $searchEmail;
    	} else {
    		$searchEmail = $this->session->userdata('email_selected');
    	}

    	if ($searchLocation !== false) {
    		$filter_session_data['location_selected'] = $searchLocation;
    	} else {
    		$searchLocation = $this->session->userdata('location_selected');
    	}

    	if ($searchStatus !== false) {
    		$filter_session_data['status_selected'] = $searchStatus;
    	} else {
    		$searchStatus = $this->session->userdata('status_selected');
    	}

    	// If sorting type was changed
    	if ($sort_dir !== false) {
    		$filter_session_data['sort_dir_selected'] = $sort_dir;
    	} else {
    		//we have something stored in the session?
    		if ($this->session->userdata('sort_dir_selected')) {
    			$sort_dir = $this->session->userdata('sort_dir_selected');
    		} else {
    			$sort_dir = 'asc';
    		}
    	}

    	if ($sort) {
    		$filter_session_data['sort_selected'] = $sort;
    	} else {
    		//we have something stored in the session?
    		if ($this->session->userdata('sort_selected')) {
    			$sort = $this->session->userdata('sort_selected');
    		} else {
    			$sort = 'full_name';
    		}
    	}

    	//make the data type var avaible to our view
    	$data['search']['full_name'] = $searchName;
    	$data['search']['email'] = $searchEmail;
    	$data['search']['location'] = $searchLocation;
    	$data['search']['status'] = $searchStatus;

    	// Save session data in the session
    	if (isset($filter_session_data)) {
    		$this->session->set_userdata($filter_session_data);
    	}

    	if ($page == "reset") {
    		$filter = array('name_selected' => '',
    						'email_selected' => '',
    						'location_selected' => '',
    						'status_selected' => '',
    						'sort_dir_selected' => '',
    						'sort_selected' => '');

    		$this->session->set_userdata($filter);
    		redirect('/admin/users/');
    	}

    	$this->load->library('pagination');

    	//pagination settings
    	$config['per_page'] = 2;
    	$config['base_url'] = base_url().'admin/users/index';
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
    	$config['uri_segment'] = 4;

    	//math to get the initial record to be select in the database
    	$limit_end = ($page * $config['per_page']) - $config['per_page'];
    	if ($limit_end < 0){
    		$limit_end = 0;
    	}

    	//fetch sql data into arrays
    	$data['count_users'] = count($this->my_model_v2->get(null, null, null, $data['search']));
    	$data['list'] = $this->my_model_v2->get($config['per_page'], $limit_end, array($sort => $sort_dir), $data['search']);
    	$config['total_rows'] = $data['count_users'];


    	//initializate the panination helper
    	$this->pagination->initialize($config);

    	$data['page'] = 'user';
    	$data['page_title'] = 'DateClip Admin Panel :: User Management ';
    	$data['sort_fields'] = $this->sorting_format($sort, $sort_dir);
    	$data['main_content'] = 'admin/user/list';
    	$this->load->view('admin/includes/template', $data);
    }

    /**
     *
     */
    public function add() {

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		//form validation
    		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
    		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
    		$this->form_validation->set_rules('last_name', 'Last Name', 'required|required');
    		$this->form_validation->set_rules('email', 'Email address', 'required|email');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run())
    		{
    			$data_to_store = array(
    				'full_name' => htmlspecialchars($this->input->post('full_name'), ENT_QUOTES, 'utf-8'),
    				'first_name' => htmlspecialchars($this->input->post('first_name'), ENT_QUOTES, 'utf-8'),
    				'last_name' => htmlspecialchars($this->input->post('last_name'), ENT_QUOTES, 'utf-8'),
    				'email' => htmlspecialchars($this->input->post('email'), ENT_QUOTES, 'utf-8'),
    				'gender' => htmlspecialchars($this->input->post('gender'), ENT_QUOTES, 'utf-8'),
    				'date_of_birth' => htmlspecialchars($this->input->post('date_of_birth'), ENT_QUOTES, 'utf-8'),
    				'location' => htmlspecialchars($this->input->post('location'), ENT_QUOTES, 'utf-8'),
    				'status' => htmlspecialchars($this->input->post('status'), ENT_QUOTES, 'utf-8')
    			);

    			//if the insert has returned true then we show the flash message
    			if ($this->my_model_v2->insert($data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> User have been added successfully.');
    			} else {
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> User already exists.');
    			}
    			redirect('/admin/users/');
    		} //validation run
    	}

    	$data['page'] = 'user';
    	$data['page_title'] = 'DateClip Admin Panel :: User Management &raquo; Add User';

    	$data['main_content'] = 'admin/user/add';
    	$this->load->view('admin/includes/template', $data);
    }

     public function edit($id = 0) {

     	//if save button was clicked, get the data sent via post
     	if ($this->input->server('REQUEST_METHOD') === 'POST')
     	{
     		//form validation
     		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
     		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
     		$this->form_validation->set_rules('last_name', 'Last Name', 'required|required');
     		$this->form_validation->set_rules('email', 'Email address', 'required|email');

     		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
     		//if the form has passed through the validation

     		if ($this->form_validation->run())
     		{
     			$data_to_store = array(
     					'full_name' => $this->input->post('full_name'),
     					'first_name' => $this->input->post('first_name'),
     					'last_name' => $this->input->post('last_name'),
     					'email' => $this->input->post('email'),
     					'gender' => $this->input->post('gender'),
     					'date_of_birth' => $this->input->post('date_of_birth'),
     					'location' => $this->input->post('location'),
     					'status' => $this->input->post('status')
     			);

     			//if the insert has returned true then we show the flash message
     			if ($this->my_model_v2->update($id, $data_to_store)) {
     				$this->session->set_flashdata('message_type', 'success');
     				$this->session->set_flashdata('message', '<strong>Well done!</strong> User successfully updated.');
     			} else{
     				$this->session->set_flashdata('message_type', 'danger');
     				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
     			}
     			redirect('/admin/users/');
     		} //validation run
     	}

     	$data['user'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

     	if (!is_numeric($id) || $id == 0 || empty($data['user'])) {
     		redirect('/admin/users/');
     	}


     	$data['page'] = 'user';
    	$data['page_title'] = 'DateClip Admin Panel :: User Management &raquo; Edit User';

    	$data['main_content'] = 'admin/user/edit';
    	$this->load->view('admin/includes/template', $data);
    }

    /**
     *
     */
    public function update_status() {

    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		//form validation
    		$this->form_validation->set_rules('operation', 'Operation', 'required');
    		$this->form_validation->set_rules('item_id[]', 'User', 'trim|required');

    		$this->form_validation->set_error_delimiters('', '');

    		//if the form has passed through the validation
    		if ($this->form_validation->run())
    		{
    			$count = 0;
    			$items = $this->input->post('item_id');
    			$operation = $this->input->post('operation');

    			$data_to_store = array(
    				'status' => ($operation == "active")?1:0
    			);

    			foreach ($items as $id=>$value) {

    				if ($this->my_model_v2->update($id, $data_to_store)) {
    					$count++;
    				}
    			}
    			$this->session->set_flashdata('message_type', 'success');
    			$this->session->set_flashdata('message', '<strong>Well done!</strong> '.$count.' user(s) successfully updated.');

    		} else {
    			$this->session->set_flashdata('message_type', 'danger');
    			$this->session->set_flashdata('message', validation_errors());
    		}
    		redirect('/admin/users/');
    	}
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


    /**
     *
     * @param unknown_type $search
     */
    public function sorting_format($sort, $order) {

    	$result['full_name'] = '<a href="?sort=full_name&sort_dir=asc">Full name</a>';
    	$result['email'] = '<a href="?sort=email&sort_dir=asc">Email address</a>';
    	$result['location'] = '<a href="?sort=location&sort_dir=asc">Location</a>';

    	if ($order == 'asc') {
    		$dirc = "desc";
    		$icon = '<span class="glyphicon glyphicon-sort-by-alphabet"></span>';
    	} else {
    		$dirc = "asc";
    		$icon = '<span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>';
    	}

    	if ($sort == 'full_name') {
    		$result['full_name'] = 'Full name <a href="?sort=full_name&sort_dir='.$dirc.'">'.$icon.'</a>';
    	}

    	if ($sort == 'email') {
    		$result['email'] = 'Email address <a href="?sort=email&sort_dir='.$dirc.'">'.$icon.'</a>';
    	}

    	if ($sort == 'location') {
    		$result['location'] = 'Location <a href="?sort=location&sort_dir='.$dirc.'">'.$icon.'</a>';
    	}
    	return $result;
    }
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */