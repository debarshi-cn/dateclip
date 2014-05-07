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

    	$this->load->library('pagination');

    	//pagination settings
    	$config['per_page'] = 1;
    	$config['base_url'] = base_url().'admin/users';
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
    	$config['cur_tag_open'] = '<li class="active"><a href="#">';
    	$config['cur_tag_close'] = '</a></li>';

    	//limit end
    	$page = $this->uri->segment(3);

    	//math to get the initial record to be select in the database
    	$limit_end = ($page * $config['per_page']) - $config['per_page'];
    	if ($limit_end < 0){
    		$limit_end = 0;
    	}

    	//pre selected options
    	$data['order'] = 'first_name';
    	$data['order_type'] = 'asc';

    	//fetch sql data into arrays
    	$data['count_users'] = $this->user_model->count_users();
    	$data['users'] = $this->user_model->get_users('', $data['order'], $data['order_type'], $config['per_page'], $limit_end);
    	$config['total_rows'] = $data['count_users'];


    	//initializate the panination helper
    	$this->pagination->initialize($config);

    	$data['page'] = 'user';
        $this->load->view('admin/vwManageUser', $data);
    }

    public function add_user() {

    	$data['page'] = 'user';
        $this->load->view('admin/vwAddUser', $data);
    }

     public function edit_user() {

     	$data['page'] = 'user';
        $this->load->view('admin/vwEditUser', $data);
    }

     public function block_user() {
        // Code goes here
    }

     public function delete_user() {
        // Code goes here
    }





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */