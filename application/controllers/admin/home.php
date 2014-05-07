<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
    }


    public function index() {

        if ($this->session->userdata('is_admin_login')) {
        	redirect('admin/dashboard');
        } else {
        	$this->load->view('admin/vwLogin');
        }
    }


    public function do_login() {

    	if ($this->session->userdata('is_admin_login')) {
            redirect('admin/home/dashboard');
        } else {

        	$email = $this->input->post('email');
        	$password = $this->input->post('password');

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {

            	$data['error'] = '<strong>Oh snap!!</strong> Please enter something';
                $this->load->view('admin/vwLogin', $data);

            } else {

            	$this->load->model('Admin_model');
            	$this->load->helper('date');

            	if($is_valid_details = $this->Admin_model->validate($email, $this->_encrip_password($password)))
            	{
            		$data = array(
            			'id' => $is_valid_details[0]['id'],
            			'name' => $is_valid_details[0]['name'],
            			'email' => $is_valid_details[0]['email'],
            			'last_login' => mdate("%m/%d/%Y - %h:%i %a", strtotime($is_valid_details[0]['last_login'])),
            			'is_admin_login' => true
            		);
            		$this->session->set_userdata($data);

            		$this->Admin_model->update('id', $is_valid_details[0]['id'], array('last_login'=>date('Y-m-d H:i:s')));

            		redirect('admin/dashboard');
            	}
                else {

                	$data['error'] = '<strong>Grr!!</strong> Email or Password incorrect';
                    $this->load->view('admin/vwLogin', $data);
                }
            }
        }
    }

    /**
     * encript the password
     * @return mixed
     */
    function _encrip_password($password) {
    	return md5($password);
    }

    public function logout() {

        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('admin', 'refresh');
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */