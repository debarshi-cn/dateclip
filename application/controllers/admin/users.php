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

        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    public function index() {

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