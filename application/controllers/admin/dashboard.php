<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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
            redirect('admin');
        }
    }

    public function index() {

    	$this->load->model('Admin_model');
    	$data['dashboard'] = $this->Admin_model->get_dashboard_data();


    	$data['page'] = 'dashboard';
        $data['page_title'] = 'DateClip Admin Panel :: Dashboard';

        $data['main_content'] = 'admin/dashboard';
        $this->load->view('admin/includes/template', $data);
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */