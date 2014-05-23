<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement extends MY_Controller {

	/**
	 *
	 */
    public function __construct() {

        parent::__construct();

        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }

        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
        	'table_name' => 'advertisement',
        	'primary_key' => 'id'
        ));
    }

    /**
     *
     */
    public function index() {

    	$data['page'] = 'advertisement';
        $data['page_title'] = 'DateClip Admin Panel :: Advertisement Management';

        $data['list'] = $this->my_model_v2->get();

        $data['main_content'] = 'admin/advertisement/list';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     */
    public function add() {

    	//if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
    		$this->form_validation->set_rules('title', 'Title', 'required');
    		$this->form_validation->set_rules('description', 'Description', 'required');
    		//$this->form_validation->set_rules('video', 'Video', 'required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation
    		
            if ($this->form_validation->run()) {

                // UPLOAD VIDEO HERE STARTS
                if (is_uploaded_file($_FILES['video']['tmp_name'])) {
                    unset($config);
                    $date = date("ymd");
                    $configVideo['upload_path'] = './assets/ad';
                    //$configVideo['max_size'] = '10240';
                    //$configVideo['allowed_types'] = 'avi|flv|wmv|mp3';
                    $configVideo['allowed_types'] = 'jpg|png|jpeg';
                    //$configVideo['overwrite'] = FALSE;
                    //$configVideo['remove_spaces'] = TRUE;
                    $video_name = $date.$_FILES['video']['name'];
                    $configVideo['file_name'] = $video_name;
         
                    $this->load->library('upload', $configVideo);
                    $this->upload->initialize($configVideo);
                    if (!$this->upload->do_upload('video')) {
                        echo $this->upload->display_errors();
                    } else {
                        $videoDetails = $this->upload->data();
                        //echo $video_name; exit();
                        $data['img_name'] = $video_name;
                    }
                } else {

                    $video_name = "";
                }
                // UPLOAD VIDEO HERE ENDS

    			$data_to_store = array(

    				'title' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8'),
    				'description' => $this->input->post('description'),
                    'video' => htmlspecialchars($video_name, ENT_QUOTES, 'utf-8'),
                    'status' => htmlspecialchars($this->input->post('status'), ENT_QUOTES, 'utf-8')
    			);

    			if ($this->my_model_v2->insert($data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Advertisement have been added successfully.');
    			} else {
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
    			}
    			redirect('/admin/advertisement/');
    		}
    	}

        $data['page'] = 'advertisement';
        $data['page_title'] = 'DateClip Admin Panel :: Advertisement Management &raquo; Add advertisement';

        $data['main_content'] = 'admin/advertisement/add';
        $this->load->view('admin/includes/template', $data);
    }


    /**
     *
     * @param int $id
     */
    public function edit ($id = null) {

    	// if save button was clicked, get the data sent via post
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {

    		//form validation
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            //$this->form_validation->set_rules('video', 'Video', 'required');

    		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
    		//if the form has passed through the validation

    		if ($this->form_validation->run()) {

                $video = $this->my_model_v2->get_advertisement($id);


                // UPLOAD VIDEO HERE STARTS
                if (is_uploaded_file($_FILES['video']['tmp_name'])) {
                    
                    unset($config);
                    $date = date("ymd");
                    $configVideo['upload_path'] = './assets/ad';
                    //$configVideo['max_size'] = '10240';
                    //$configVideo['allowed_types'] = 'avi|flv|wmv|mp3';
                    $configVideo['allowed_types'] = 'jpg|png|jpeg';
                    //$configVideo['overwrite'] = FALSE;
                    //$configVideo['remove_spaces'] = TRUE;
                    $video_name = $date.$_FILES['video']['name'];
                    $configVideo['file_name'] = $video_name;
         
                    $this->load->library('upload', $configVideo);
                    $this->upload->initialize($configVideo);
                    if (!$this->upload->do_upload('video')) {
                        echo $this->upload->display_errors();
                    } else {
                        $videoDetails = $this->upload->data();
                        $data['img_name'] = $video_name;
                    }

                } else {

                    $video_name = $video->video;
                }

    			$data_to_store = array(
                    'title' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8'),
                    'description' => $this->input->post('description'),
                    'video' => htmlspecialchars($video_name, ENT_QUOTES, 'utf-8'),
                    'status' => htmlspecialchars($this->input->post('status'), ENT_QUOTES, 'utf-8')
                );

    			//if the insert has returned true then we show the flash message
    			if ($this->my_model_v2->update($id, $data_to_store)) {
    				$this->session->set_flashdata('message_type', 'success');
    				$this->session->set_flashdata('message', '<strong>Well done!</strong> Advertisement successfully updated.');
    			} else{
    				$this->session->set_flashdata('message_type', 'danger');
    				$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
    			}
    			redirect('/admin/advertisement/');
    		}
    	}

    	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

    	if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/advertisement/');
    	}


     	$data['page'] = 'advertisement';
        $data['page_title'] = 'DateClip Admin Panel :: Advertisement Management &raquo; Edit Advertisement';

        $data['main_content'] = 'admin/advertisement/edit';
        $this->load->view('admin/includes/template', $data);
    }

    /**
     *
     * @param int $id
     */
    public function delete($id = null) {

    	$data['data_info'] = $this->my_model_v2->get(NULL, NULL, NULL, array('id' => $id));

        if (!is_numeric($id) || $id == 0 || empty($data['data_info'])) {
    		redirect('/admin/advertisement/');
    	}

        // if (!$this->my_model_v2->is_valid_data('user_package_log', array('package_id' => $id))) {

            if ($this->my_model_v2->delete($id)) {
                $this->session->set_flashdata('message_type', 'success');
    			$this->session->set_flashdata('message', '<strong>Well done!</strong> package successfully deleted.');
            } else {
            	$this->session->set_flashdata('message_type', 'danger');
            	$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Change something and try again.');
            }
            redirect('/admin/advertisement/');

    }
}

/* End of file flag.php */
/* Location: ./application/controllers/admin/package.php */