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

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		$post_settings = $this->input->post('settings');

            if (count($post_settings)) {

                foreach ($post_settings as $key => $value) {

                	if ($value <> "") {
                        $data_to_store = array(
                            'value' => htmlspecialchars($value, ENT_QUOTES, 'utf-8')
                        );

                        $this->my_model_v2->update_by_field('token', $key, $data_to_store);
                    }
                }

                $this->session->set_flashdata('message_type', 'success');
                $this->session->set_flashdata('message', '<strong>Well done!</strong> Settings successfully updated.');

                redirect('admin/settings');
            }
    	}

    	$data_settings = $this->my_model_v2->get();

        $settings = array();
        foreach ($data_settings as $key => $obj) {
            $settings[$obj->token] = $obj->value;
        }

        $data['settings'] = $settings;

        /*if (count($settings)) {
            $data['settings'] = $settings;
        } else {
            $data['settings'] = "";
        }*/


        $data['page'] = 'settings';
        $data['page_title'] = 'DateClip Admin Panel :: Manage Settings';

        $data['main_content'] = 'admin/settings';
        $this->load->view('admin/includes/template', $data);
    }
}

/* End of file settings.php */
/* Location: ./application/controllers/admin/settings.php */