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

            	$data_to_store = array(
            		'title' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8'),
            		'description' => $this->input->post('description'),
            		'status' => htmlspecialchars($this->input->post('status'), ENT_QUOTES, 'utf-8')
            	);

                // UPLOAD VIDEO HERE STARTS
            	if (is_uploaded_file($_FILES['video']['tmp_name'])) {

                    $config['upload_path'] = UPLOAD_VIDEO_DIR;
                    //$config['max_size'] = '10240';
                    //$config['allowed_types'] = 'avi|flv|wmv|mp3';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['overwrite'] = FALSE;
                    $config['remove_spaces'] = TRUE;
                    //$video_name = date("ymdhis");
                    $config['file_name'] = $video_name;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('video')) {
                        $this->session->set_flashdata('message_type', 'danger');
                        $this->session->set_flashdata('message', '<strong>Oh snap!</strong> '.$this->upload->display_errors());

                        redirect('/admin/advertisement/');

                    } else {
                    	$upload_data =  $this->upload->data();
                    	$data_to_store['video'] = $upload_data['file_name'];
                    }
                }

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
        $data['page_title'] = 'DateClip Admin Panel :: Advertisement Management &raquo; Add Advertisement';

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

                $data_to_store = array(
                    'title' => htmlspecialchars($this->input->post('title'), ENT_QUOTES, 'utf-8'),
                    'description' => $this->input->post('description'),
                    'status' => htmlspecialchars($this->input->post('status'), ENT_QUOTES, 'utf-8')
                );

                // UPLOAD VIDEO HERE STARTS
                if (is_uploaded_file($_FILES['video']['tmp_name'])) {

                    $config['upload_path'] = UPLOAD_VIDEO_DIR;
                    //$config['max_size'] = '10240';
                    //$config['allowed_types'] = 'avi|flv|wmv|mp3';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['overwrite'] = FALSE;
                    $config['remove_spaces'] = TRUE;
                    //$video_name = date("ymdhis");
                    $config['file_name'] = $video_name;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('video')) {
                        $this->session->set_flashdata('message_type', 'danger');
                        $this->session->set_flashdata('message', '<strong>Oh snap!</strong> '.$this->upload->display_errors());

                        redirect('/admin/advertisement/');

                    } else {
                    	$upload_data =  $this->upload->data();
                    	$data_to_store['video'] = $upload_data['file_name'];
                    }
                }

    			// if the insert has returned true then we show the flash message
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

    	$data['data_info'] = $this->my_model_v2->get(1, NULL, NULL, array('id' => $id));

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

    	$ad_info = $this->my_model_v2->get(1, NULL, NULL, array('id' => $id));

        if (!is_numeric($id) || $id == 0 || empty($ad_info)) {
    		redirect('/admin/advertisement/');
    	}

    	// Try to delete the file first
    	if ($ad_info->video <> "") {
    		if(!unlink(UPLOAD_VIDEO_DIR.$ad_info->video)) {
    			$this->session->set_flashdata('message_type', 'danger');
    			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> Can\'t delete the file.');
        		redirect('/admin/advertisement/');
    		}
    	}

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