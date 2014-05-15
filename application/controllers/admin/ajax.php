<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {

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

        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }

        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
        	'table_name' => 'user',
        	'primary_key' => 'id'
        ));
    }

    /**
     *
     */
    public function get_user_list($string = "") {

    	//echo $this->router->class."/".$this->router->method;die;

    	// Search values
    	$search['full_name'] = $string;
    	//$search['email'] = $string;

    	$data = $this->my_model_v2->get(null, null, null, $search);

    	$users = array();
    	foreach ($data as $key => $obj) {
    		$users[] = $obj->full_name." (".$obj->id.")";
    	}

    	echo json_encode($users);
    }

}
/* End of file ajax.php */
/* Location: ./application/controllers/admin/ajax.php */