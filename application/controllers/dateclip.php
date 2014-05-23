<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dateclip extends Front_Controller {


    public function __construct() {

        parent::__construct();

        if (!$this->session->userdata('LOGGED_IN')) {
            redirect('welcome/login');
        }

        $this->load->library('form_validation');
        $this->load->model('front_model');
    }

    public function index() {

    	$user_id = $this->session->userdata('user_id');
    	$data['dateclip'] = $this->front_model->get_user_dateclip($user_id);

        $data['main_content'] = 'dateclip';
        $this->load->view('includes/template', $data);
    }

    public function upload() {

    	// GET USER ID OF LOGGED IN USER
    	$user_id = $this->session->userdata('user_id');

    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

	    	if (is_uploaded_file($_FILES['video']['tmp_name'])) {

	    		$config['upload_path'] = UPLOAD_DATECLIP_DIR;
	    		//$config['max_size'] = '10240';
	    		//$config['allowed_types'] = 'avi|flv|wmv|mp3';
	    		$config['allowed_types'] = 'jpg|png|jpeg';
	    		$config['overwrite'] = FALSE;
	    		$config['remove_spaces'] = TRUE;
	    		//$video_name = date("ymdhis");
	    		//$config['file_name'] = $video_name;

	    		$this->load->library('upload', $config);

	    		if (!$this->upload->do_upload('video')) {
	    			$this->session->set_flashdata('message_type', 'danger');
	    			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> '.$this->upload->display_errors());

	    			redirect('/dateclip/');

	    		} else {

	    			$upload_data =  $this->upload->data();
	    			$video_name = $upload_data['file_name'];

		    		$data['dateclip'] = $this->front_model->get_user_dateclip($user_id);

		    		// Update the existing DateClips
		    		if (count($data['dateclip'])) {

		    			$data_to_store = array('deleted' => date('Y-m-d H:i:s'));
		    			$this->front_model->update_dateclip($user_id, $data_to_store);
		    		}

		    		// Insert the dateclip
		    		$data_to_reset = array(
		    			'user_id' => $user_id,
		    			'dateclip' => htmlspecialchars($video_name, ENT_QUOTES, 'utf-8')
		    		);

		    		$this->load->model('my_model_v2');
		    		$this->my_model_v2->initialize(array(
		    			'table_name' => 'dateclip',
		    			'primary_key' => 'id'
		    		));
		    		$this->my_model_v2->insert($data_to_reset);

		    		$this->session->set_flashdata('message_type', 'success');
		    		$this->session->set_flashdata('message', '<strong>Well done!</strong> Dateclip updated successfully.');
	    		}

	    	} else {
	    		$this->session->set_flashdata('message_type', 'danger');
	    		$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Error while uploading dateclip.');
	    	}

    	}

        redirect('/dateclip/');
    }







}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */