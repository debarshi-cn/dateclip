<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_Controller extends CI_Controller {

    protected $data;

    public function __construct() {

        parent::__construct();
        $this->load->model('front_model');

        // Get the config
        $this->data['config'] = $this->front_model->get_site_config();

        $fb_config['appId'] = $this->data['config']['fb_app_id'];
        $fb_config['secret'] = $this->data['config']['fb_app_key'];

        // Automatically picks appId and secret from config
        $this->load->library('facebook', $fb_config);
        $this->data['login_url'] = $this->facebook->getLoginUrl(array(
        	'redirect_uri' => site_url('home/login'),
        	'scope' => array("email, user_birthday, user_photos, friends_hometown") // permissions here
        ));
        $this->data['logout_url'] = site_url('home/logout');

        // Get logged in user details
        if ($this->session->userdata('LOGGED_IN')) {

        	$this->data['user_data'] = $this->front_model->get_user('id', $this->session->userdata('user_id'));
        	$this->data['user_data']['age'] = $this->getAge($this->data['user_data']['date_of_birth']);
        }

        $this->data['site_name'] = "DateClip.com";

        $this->load->vars($this->data);
    }

    private function getAge($dob = null) {

    	if ($dob) {
    		return date_diff(date_create($dob), date_create('today'))->y;
    	} else {
    		return "N.A";
    	}
    }
}
?>