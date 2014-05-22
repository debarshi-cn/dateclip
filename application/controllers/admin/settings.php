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

        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
            'table_name' => 'site_settings',
            'primary_key' => 'id'
        ));

    }

    /**
     * Default admin method
     */
    public function index() {

        $data_settings = $this->my_model_v2->get();

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form validation
            // $this->form_validation->set_rules('name', 'Full Name', 'required');

            // if ($this->input->post('password') != "") {
            //     //echo 1;exit();
            //     $this->form_validation->set_rules('new_pwd', 'New Password', 'trim|required|matches[re_pwd]');
            //     $this->form_validation->set_rules('re_pwd', 'Retype Password', 'trim|required');
            // }


            // $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
            //if the form has passed through the validation

            //if ($this->form_validation->run()) {
            // $data = array();
            // foreach ($_POST['settings'] as $key => $value) {
            //     //$data = $key[$value];
            //     print"<pre>";
            //     print_r($value);
            // }
            // $data_to_store['token'] = $key;
            // $data_to_store['value'] = $value;

         //    $data_settings = $this->my_model_v2->get();
         //    print"<pre>";
         // print_r($data_settings);
         // exit();

            if (!count($data_settings)) {
            
                foreach ($_POST['settings'] as $key => $value) {
                    //$data_to_store[$key] = $value;
                    if($value != "") {
                        $data_to_store = array(
                            'token' => htmlspecialchars($key, ENT_QUOTES, 'utf-8'),
                            'value' => htmlspecialchars($value, ENT_QUOTES, 'utf-8')
                        );

                        $this->my_model_v2->insert($data_to_store);
                    }
                }

                //if ($this->my_model_v2->insert($data_to_store)) {
                    $this->session->set_flashdata('message_type', 'success');
                    $this->session->set_flashdata('message', '<strong>Well done!</strong> Settings successfully inserted.');
                // } else {
                //     $this->session->set_flashdata('message_type', 'danger');
                //     $this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
                // }

                redirect('admin/settings');      
            } else {

                foreach ($_POST['settings'] as $key => $value) {
                    //$data_to_store[$key] = $value;
                    if($value != "") {
                        $data_to_store = array(
                            'token' => htmlspecialchars($key, ENT_QUOTES, 'utf-8'),
                            'value' => htmlspecialchars($value, ENT_QUOTES, 'utf-8')
                        );
                    }

                    $this->my_model_v2->update_setting($key,$data_to_store);
                }

                $this->session->set_flashdata('message_type', 'success');
                $this->session->set_flashdata('message', '<strong>Well done!</strong> Settings successfully updated.');

                redirect('admin/settings');
            }

            //} //validation run
    	}

        
         // print"<pre>";
         // print_r($data_settings);
         // exit();
        $settings = array();
        foreach ($data_settings as $key => $obj) {
            $settings[$obj->token] = $obj->value;
        }

        $data['settings'] = $settings;

        $data['page'] = 'settings';
        $data['page_title'] = 'DateClip Admin Panel :: Manage Settings';

        $data['main_content'] = 'admin/settings';
        $this->load->view('admin/includes/template', $data);
    }
}

/* End of file settings.php */
/* Location: ./application/controllers/admin/settings.php */