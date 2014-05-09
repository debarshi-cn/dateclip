<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

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
        $this->load->model('user_model');
        $this->load->library('form_validation');

        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

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
    	$data['search']['name_selected'] = $searchName;
    	$data['search']['email_selected'] = $searchEmail;
    	$data['search']['location_selected'] = $searchLocation;
    	$data['search']['status_selected'] = $searchStatus;

    	$data['search']['sort_dir_selected'] = $sort_dir;
    	$data['search']['sort_selected'] = $sort;

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
    		redirect('/admin/users/', 'refresh');
    	}

    	$this->load->library('pagination');

    	//pagination settings
    	$config['per_page'] = 10;
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
    	$data['count_users'] = $this->user_model->count_users($data['search']);
    	$data['users'] = $this->user_model->get_users($data['search'], $config['per_page'], $limit_end);

    	$config['total_rows'] = $data['count_users'];


    	//initializate the panination helper
    	$this->pagination->initialize($config);

    	$data['page'] = 'user';
    	$data['page_title'] = 'DateClip Admin Panel :: User Management ';
    	$data['sort_fields'] = $this->sorting_format($data['search']);
    	$data['main_content'] = 'admin/user/list';
    	$this->load->view('admin/includes/template', $data);
    }

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
    			if ($this->user_model->add($data_to_store) == TRUE) {
    				$this->session->set_flashdata('flash_message', 'updated');
    			} else {
    				$this->session->set_flashdata('flash_message', 'not_updated');
    			}
    			redirect('/admin/users/', 'refresh');
    		}//validation run

    	}

    	$data['page'] = 'user';
    	$data['page_title'] = 'DateClip Admin Panel :: User Management > Add User';

    	$data['main_content'] = 'admin/user/add';
    	$this->load->view('admin/includes/template', $data);
    }

     public function edit($id = 0) {

     	if (!is_numeric($id) || $id == 0) {
     		redirect('/admin/users/', 'refresh');
     	}

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
     			if ($this->user_model->update('id', $id, $data_to_store) == TRUE) {
     				$this->session->set_flashdata('flash_message', 'updated');
     			} else{
     				$this->session->set_flashdata('flash_message', 'not_updated');
     			}
     		}//validation run

     	}

     	$data['page'] = 'user';
    	$data['page_title'] = 'DateClip Admin Panel :: User Management > Edit User';

    	$data['user'] = $this->user_model->get_user_by_id($id);

    	$data['main_content'] = 'admin/user/edit';
    	$this->load->view('admin/includes/template', $data);
    }

    public function block_user() {
        // Code goes here
    }

    public function delete_user() {
        // Code goes here
    }


    public function sorting_format($search = array()) {

    	$result['full_name'] = '<a href="?sort=full_name&sort_dir=asc">Full name</a>';
    	$result['email'] = '<a href="?sort=email&sort_dir=asc">Email address</a>';
    	$result['location'] = '<a href="?sort=location&sort_dir=asc">Location</a>';

    	if ($search['sort_dir_selected'] == 'asc') {
    		$dirc = "desc";
    		$icon = '<span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>';
    	} else {
    		$dirc = "asc";
    		$icon = '<span class="glyphicon glyphicon-sort-by-alphabet"></span>';
    	}

    	if ($search['sort_selected'] == 'full_name') {
    		$result['full_name'] = 'Full name <a href="?sort=full_name&sort_dir='.$dirc.'">'.$icon.'</a>';
    	}

    	if ($search['sort_selected'] == 'email') {
    		$result['email'] = 'Email address <a href="?sort=email&sort_dir='.$dirc.'">'.$icon.'</a>';
    	}

    	if ($search['sort_selected'] == 'location') {
    		$result['location'] = 'Location <a href="?sort=location&sort_dir='.$dirc.'">'.$icon.'</a>';
    	}
    	return $result;
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */