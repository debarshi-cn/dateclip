<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_Controller extends CI_Controller {

    protected $data;

    public function __construct() {

        parent::__construct();
        $this->load->model('front_model');

        // Get logged in user details
        if ($this->session->userdata('LOGGED_IN')) {

        	$this->data['user_data'] = $this->front_model->get_user('id', $this->session->userdata('user_id'));
        	//echo $this->session->userdata('user_id')."--ddddd";
        	//print_r($this->data['user_data']);
        	$this->data['user_data']['age'] = $this->getAge($this->data['user_data']['date_of_birth']);
        }

        $this->data['site_name'] = "DateClip.com";

        // Get the config
        $this->data['config'] = $this->front_model->get_site_config();

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