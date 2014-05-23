<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Front_Controller {

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
        $this->load->model('front_model');
    }

    public function index() {

        $data['page'] = 'home';

        // Automatically picks appId and secret from config
        $this->load->library('facebook');
        $data['login_url'] = $this->facebook->getLoginUrl(array(
        		'redirect_uri' => site_url('home/login'),
        		'scope' => array("email, user_birthday, user_photos, friends_hometown") // permissions here
        ));
        $data['logout_url'] = site_url('home/logout');

        $data['list'] = $this->front_model->get_dateclip();

        print_r($this->data['config']);

        $data['main_content'] = 'home';
        $this->load->view('includes/template', $data);
    }



    public function login() {

    	// Automatically picks appId and secret from config
    	$this->load->library('facebook');
    	$user = $this->facebook->getUser();

    	if ($user) {

    		try {
    			$data['user_profile'] = $this->facebook->api('/me');

    			//print "<pre>"; print_r($data['user_profile']); print "</pre>"; die;

    			// Get the user data from facebook
    			$fb_user_id = $data['user_profile']['id'];
    			$email = $data['user_profile']['email'];
    			$gender = $data['user_profile']['gender'];
    			$first_name = $data['user_profile']['first_name'];
    			$last_name = $data['user_profile']['last_name'];
    			$full_name = $data['user_profile']['name'];
    			$location = $data['user_profile']['location']['name'];
    			$birthday = $data['user_profile']['birthday'];

    			if ($gender == "male") {
    				$user_gender = "M";
    			} elseif ($gender == "female") {
    				$user_gender = "F";
    			}

    			// Check if the user exists or not
    			if ($this->front_model->check_fb_user($fb_user_id, $email) == TRUE) {

    				$data_to_store = array(
    						'fb_user_id' => htmlspecialchars($fb_user_id, ENT_QUOTES, 'utf-8'),
    						'full_name' => htmlspecialchars($full_name, ENT_QUOTES, 'utf-8'),
    						'first_name' => htmlspecialchars($first_name, ENT_QUOTES, 'utf-8'),
    						'last_name' => htmlspecialchars($last_name, ENT_QUOTES, 'utf-8'),
    						'gender' => htmlspecialchars($user_gender, ENT_QUOTES, 'utf-8'),
    						'date_of_birth' => htmlspecialchars(date('Y-m-d', strtotime($birthday)), ENT_QUOTES, 'utf-8'),
    						'email' => htmlspecialchars($email, ENT_QUOTES, 'utf-8'),
    						'location' => htmlspecialchars($location, ENT_QUOTES, 'utf-8')
    				);

    				// Initialize the model
    				$this->load->model('my_model_v2');
    				$this->my_model_v2->initialize(array(
    					'table_name' => 'user',
    					'primary_key' => 'id'
    				));

    				// If the user don't exits, insert data
    				if ($this->my_model_v2->insert($data_to_store)) {
    					$redirect_to_search = true;
    					$this->session->set_flashdata('message_type', 'success');
    					$this->session->set_flashdata('message', '<strong>Well done!</strong> User have been added successfully.');
    				} else {
    					$redirect_to_search = false;
    					$this->session->set_flashdata('message_type', 'danger');
    					$this->session->set_flashdata('message', '<strong>Oh snap!</strong> User already exists.');
    				}

    			}

    			// Login the user
    			$user_data = $this->front_model->get_user('fb_user_id', $fb_user_id);

    			$user_session_data = array(
    				'fb_user_id' => $fb_user_id,
    				'user_id' => $user_data['id'],
    				'LOGGED_IN' => true
    			);

    			$this->session->set_userdata($user_session_data);

    		} catch (FacebookApiException $e) {

    			$this->session->set_flashdata('message_type', 'danger');
    			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> '.$e->getMessage());
    		}
    	} else {
    		$this->facebook->destroySession();
    	}

    	if ($redirect_to_search) {
    		redirect('search');
    	}

    	redirect('/');
    }

    public function logout() {

    	$this->load->library('facebook');

    	$session_data = array (
    							'fb_user_id' => '',
    							'user_id' => '',
    							'LOGGED_IN' => true
    						);

    	$this->session->unset_userdata($session_data);

    	// Logs off session from website
    	$this->facebook->destroySession();

    	redirect('/');
    }

    public function flag() {

    	$this->load->model('my_model_v2');
    	$this->my_model_v2->initialize(array(
    		'table_name' => 'flag',
    		'primary_key' => 'id'
    	));

    	$data['flag_list'] = $this->my_model_v2->get();

    	$this->load->view("flag", $data);
    }

    public function coach() {

    	$this->load->model('my_model_v2');
    	$this->my_model_v2->initialize(array(
    		'table_name' => 'coach',
    		'primary_key' => 'id'
    	));

    	$data['coach_list'] = $this->my_model_v2->get();

    	$this->load->view("coach", $data);
    }

    public function add_user_flag_coach() {

    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		$data['type'] = $_POST['type'];

    		// THIS BLOCK IS FOR FLAG
    		if ($this->input->post('type') == "FLAG") {

    			$data_to_store = array(
    				'user_id' => $this->session->userdata('user_id'),
    				'dateclip_id' => htmlspecialchars($this->input->post('dateclip_id'), ENT_QUOTES, 'utf-8'),
    				'flag_id' => htmlspecialchars($this->input->post('flag_id'), ENT_QUOTES, 'utf-8'),
    				'other' => htmlspecialchars($this->input->post('other_reason'), ENT_QUOTES, 'utf-8')
    			);

    			$this->flag_date_clip($data_to_store);
    		}

    		// THIS BLOCK IS FOR COACH
    		if ($this->input->post('type') == "COACH") {

    			$data_to_store = array(
    				'user_id' =>  $this->session->userdata('user_id'),
    				'dateclip_id' => htmlspecialchars($this->input->post('dateclip_id'), ENT_QUOTES, 'utf-8'),
    				'coach_id' => htmlspecialchars($this->input->post('coach_id'), ENT_QUOTES, 'utf-8'),
    				'other' => htmlspecialchars($this->input->post('other_reason'), ENT_QUOTES, 'utf-8')
    			);

    			$this->coach_date_clip($data_to_store);
    		}

    		$this->load->view("ajax_message",$data);
    	}
    }


    function flag_date_clip($data_to_store) {

    	$this->load->model('my_model_v2');
    	$this->my_model_v2->initialize(array(
    		'table_name' => 'user_flag_dateclip',
    		'primary_key' => 'id'
    	));

    	$this->my_model_v2->insert($data_to_store);

    	// Log activity
    	$this->front_model->insert_activity('dateclip_flagged', $data_to_store['dateclip_id'], $data_to_store['user_id'], 0);
    }

    function coach_date_clip($data_to_store) {

    	$this->load->model('my_model_v2');
    	$this->my_model_v2->initialize(array(
    		'table_name' => 'user_coach_dateclip',
    		'primary_key' => 'id'
    	));

    	$this->my_model_v2->insert($data_to_store);

    	// Log activity
    	$this->front_model->insert_activity('dateclip_coached', $data_to_store['dateclip_id'], $data_to_store['user_id'], 0);
    }


    public function add_user_like_dislike(){


    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		$data['type'] = $_POST['type'];

    		// THIS BLOCK IS FOR LIKES
    		if ($this->input->post('type') == "LIKE") {

    			$data_to_store = array(
    				'user_id' =>  $this->session->userdata('user_id'),
    				'dateclip_id' => htmlspecialchars($this->input->post('dateclip_id'), ENT_QUOTES, 'utf-8')
    			);

    			$this->like_date_clip($data_to_store);
    		}

    		// THIS BLOCK IS FOR DISLIKES
    		if ($this->input->post('type') == "DISLIKE") {

    			$data_to_store = array(
    				'user_id' =>  $this->session->userdata('user_id'),
    				'dateclip_id' => htmlspecialchars($this->input->post('dateclip_id'), ENT_QUOTES, 'utf-8')
    			);

    			$this->dislike_date_clip($data_to_store);
    		}

    	}

    	$this->load->view("ajax_message",$data);
    }


    function like_date_clip($data) {

    	$this->load->model('my_model_v2');
    	$this->my_model_v2->initialize(array(
    		'table_name' => 'user_like_dateclip',
    		'primary_key' => 'id'
    	));

    	$this->my_model_v2->insert($data);

    	// Log activity
    	$this->front_model->insert_activity('dateclip_liked', $data['dateclip_id'], $data['user_id'], 5);
    }


    function dislike_date_clip($data) {

    	$this->load->model('my_model_v2');
    	$this->my_model_v2->initialize(array(
    		'table_name' => 'user_dislike_dateclip',
    		'primary_key' => 'id'
    	));

    	$this->my_model_v2->insert($data);

    	// Log activity
    	$this->front_model->insert_activity('dateclip_disliked', $data['dateclip_id'], $data['user_id'], 5);
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */