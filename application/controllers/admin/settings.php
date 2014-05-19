<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {

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

    /**
     * Default admin method
     */
    public function index() {

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {


    		print "<pre>"; print_r($_POST); print "</pre>";
    	}

        $data['page'] = 'settings';
        $data['page_title'] = 'DateClip Admin Panel :: Manage Settings';

        $data['main_content'] = 'admin/settings';
        $this->load->view('admin/includes/template', $data);
    }
}

/* End of file settings.php */
/* Location: ./application/controllers/admin/settings.php */