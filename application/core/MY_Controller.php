<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();

    public function __construct() {

        parent::__construct();

        $this->load_defaults();
        $this->add_css(array('bootstrap','dashboard','jquery-ui-1.10.4.min'));
        $this->add_js(array('jquery-1.10.2','jquery-ui-1.10.4.min','bootstrap.min'));
    }

    protected function load_defaults() {

        $this->data['css'] = '';
	    $this->data['js'] = '';
    }

    protected function add_css($filename) {

        $this->data['css'] .= $this->load->view("admin/includes/css", array('css_file' => $filename), true);
    }

    protected function add_js($filename) {

        $this->data['js'] .= $this->load->view("admin/includes/js", array('js_file' => $filename), true);
    }


}
?>