<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

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

    /**
     * Default admin method
     */
    public function index() {

        if ($this->session->userdata('is_admin_login')) {
        	redirect('admin/dashboard');
        } else {

        	$data['page_title'] = 'DateClip Admin Panel :: Login here ';
        	$this->load->view('admin/login', $data);
        }
    }

    /**
     * Login into account
     * Sets sesstion data
     */
    public function do_login() {

    	if ($this->session->userdata('is_admin_login')) {
            redirect('admin/home/dashboard');
        } else {

        	$email = $this->input->post('email');
        	$password = $this->input->post('password');

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {

            	$data['error'] = '<strong>Oh snap!!</strong> Please enter something.';
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

                	$data['error'] = '<strong>Oh snap!!</strong> Change a few things up and try submitting again.';
                    $this->load->view('admin/login', $data);
                }
            }
        }
    }

    /**
     *  Admin Forgot Password
     */
    function forgot_password() {

    	$this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
        	'table_name' => 'admin',
        	'primary_key' => 'id'
        ));

        $data['page_title'] = 'DateClip Admin Panel :: Forgot password? ';

    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('email', 'Email address', 'required|email');
    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');

    		//if the form has passed through the validation
    		if ($this->form_validation->run()) {

    			$email = $this->input->post('email');
    			$this->load->library('encrypt');

    			if ($this->my_model_v2->is_valid_data('admin', array('email' => $email))) {

    				$user_info = $this->my_model_v2->get(1, 0, '', array('email' => $email));

    				$this->my_model_v2->initialize(array(
    					'table_name' => 'admin_password_log',
    					'primary_key' => 'id'
    				));

    				$data_to_insert = array(
    					'admin_id' => $user_info->id,
    					'key' => md5(time()),
    					'create_date' => date('Y-m-d H:i:s')
    				);

    				$this->my_model_v2->insert($data_to_insert);

    				// Send Email to reset admin password starts
    				$activation_link = HTTP_ADMIN_PATH.'home/recover_password/'.$data_to_insert['key'];
    				$to_email = $email;

    				$this->load->library('email_function');
    				$this->email_function->password_reset_email($activation_link, $to_email);

    				//Send Email to reset admin password ends

    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Check your email to recover password.');
    			} else {
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Email address is incorrect.');
    			}
    		}
    		redirect(HTTP_ADMIN_PATH.'home/forgot_password/');
    	}

    	$this->load->view('admin/forgot_password', $data);
    }


   /**
    *
    * @param unknown_type $enc_str
    */
   function recover_password ($encrypted_string) {

    	$this->load->library('encrypt');
    	$this->load->model('my_model_v2');

        $data['page_title'] = 'DateClip Admin Panel :: Recover password ';

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

        	//form validation
        	$this->form_validation->set_rules('new_pwd', 'New Password', 'trim|required|matches[re_new_pwd]');
        	$this->form_validation->set_rules('re_new_pwd', 'Retype Password', 'trim|required');
        	$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');

        	//if the form has passed through the validation
        	if ($this->form_validation->run()) {

        		$key = $this->input->post('key');
        		$id = $this->encrypt->decode($key);
        		$pwd = $this->_encrip_password($this->input->post('new_pwd'));

        		$this->my_model_v2->initialize(array(
        			'table_name' => 'admin',
        			'primary_key' => 'id'
        		));

        		if ($this->my_model_v2->update($id, array('password' => $pwd))) {

        			// Update the link status
        			$this->my_model_v2->initialize(array(
        					'table_name' => 'admin_password_log',
        					'primary_key' => 'id'
        			));

        			$user_info = $this->my_model_v2->get(1, 0, '', array('key' => $encrypted_string, 'admin_id' => $id));
        			$this->my_model_v2->update($user_info->id, array('visited' => 1));

        			$this->session->set_flashdata('message_type', 'success');
        			$this->session->set_flashdata('message', '<strong>Well done!</strong> Password sucessfully updated.');
        		}
        		redirect(HTTP_ADMIN_PATH);
        	}
        }

    	if ($encrypted_string) {

    		$this->my_model_v2->initialize(array(
    			'table_name' => 'admin_password_log',
    			'primary_key' => 'id'
    		));

    		if ($this->my_model_v2->is_valid_data('admin_password_log', array('key' => $encrypted_string, 'visited' => 0))) {
    			$data['user_info'] = $this->my_model_v2->get(1, 0, '', array('key' => $encrypted_string));

    			if (empty($data['user_info'])) {
    				redirect(HTTP_ADMIN_PATH);
    			}

    			// Check for validity of the link (1 hr)
    			$time = strtotime($data['user_info']->create_date);
    			$now = time();
    			if ($now - $time > 3600) {
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Allowed timelimit exceed.');
    				redirect(HTTP_ADMIN_PATH);
    			}

    			$data['user_info']->enc_key = $this->encrypt->encode($data['user_info']->admin_id);
    			$this->load->view('admin/recover_password', $data);

    		} else {

    			$this->session->set_flashdata('message_type', 'danger');
    			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Not a valid link.');

    			redirect(HTTP_ADMIN_PATH);
    		}
    	} else {
    		redirect(HTTP_ADMIN_PATH);
    	}

    }


    /**
     * encript the password
     * @return mixed
     */
    function _encrip_password($password) {
    	return md5($password);
    }

    /**
     * Logout from account
     */
    public function logout() {

        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('admin', 'refresh');
    }

    public function profile() {

        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
            'table_name' => 'admin',
            'primary_key' => 'id'
        ));

        $data['page'] = 'profile';
        $data['page_title'] = 'DateClip Admin Panel :: Update Profile';

        $data['admin'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $this->session->userdata('id')));

        $data['main_content'] = 'admin/profile/edit';
        $this->load->view('admin/includes/template', $data);
    }

    public function update() {

        $this->load->model('admin_model');

        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
            'table_name' => 'admin',
            'primary_key' => 'id'
        ));

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'Full Name', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
            //if the form has passed through the validation

            if ($this->form_validation->run())
            {
                
                $id = $this->session->userdata('id');
                $old_password = $this->_encrip_password($this->input->post('password'));
                $new_password = $this->_encrip_password($this->input->post('re_pwd'));

                // CHECK IF RE PASSWORD FIELD IS NOT BLANK
                if($this->input->post('re_pwd') !=""){

                    if($this->admin_model->check_password($id, $old_password) == TRUE){
                        
                        $data_to_store = array(
                            'password' => $new_password,
                            'name' => $this->input->post('name')
                        );

                        if ($this->my_model_v2->update($id, $data_to_store)) {
                            $this->session->set_flashdata('message_type', 'success');
                            $this->session->set_flashdata('message', '<strong>Well done!</strong> User successfully updated.');
                        }

                    } else{
                        //echo 1; exit;
                        $this->session->set_flashdata('message_type', 'danger');
                        $this->session->set_flashdata('message', '<strong>Oh snap!</strong> Wrong old password provided.');
                    }
                } else{

                    $data_to_store = array(
                        'name' => $this->input->post('name')
                    );

                    if ($this->my_model_v2->update($id, $data_to_store)) {
                        $this->session->set_flashdata('message_type', 'success');
                        $this->session->set_flashdata('message', '<strong>Well done!</strong> Profile successfully updated.');
                    } else{
                        $this->session->set_flashdata('message_type', 'danger');
                        $this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
                    }
                }

                redirect('/admin/home/profile/');

            } //validation run
        }

    }
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */