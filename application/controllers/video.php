<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends MY_Controller {


    public function __construct() {

        parent::__construct();

        if (!$this->session->userdata('LOGGED_IN')) {
            redirect('welcome/login');
        }

        //$this->load->library('form_validation');
        $this->load->model('my_model_v2');
        $this->my_model_v2->initialize(array(
            'table_name' => 'dateclip',
            'primary_key' => 'id'
        ));
    }

    public function index(){

        $this->load->view("video");
    }

    public function add_video(){

        if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {

            unset($config);
            $date = date("ymd");
            $configVideo['upload_path'] = './uploads/video';
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
                //echo 1; exit;
                echo $this->upload->display_errors();
            } else {
                $videoDetails = $this->upload->data();
                echo "Successfully Uploaded"."<br/>";
                //echo $video_name; exit();
                $data['img_name'] = $video_name;
            }

            // GET USER ID OF LOGGED IN USER
            $user_id = $this->session->userdata('session_user_id');

            $data['dateclip'] = $this->my_model_v2->get_user_dateclip($user_id);


            if(count($data['dateclip'])) {
                
                $data_to_store = array(
                    'deleted' => date('Y-m-d H:i:s')
                );

                //unlink('uploads/'.$data['dateclip']['dateclip']);
                //if the insert has returned true then we show the flash message
                if ($this->my_model_v2->update_dateclip($user_id, $data_to_store)) {

                    $data_to_reset = array(
                        'user_id' => $user_id,
                        'dateclip' => htmlspecialchars($video_name, ENT_QUOTES, 'utf-8')
                    );

                    // print"<pre>";
                    // print_r($data_to_reset);
                    // exit();


                    $this->my_model_v2->insert($data_to_reset);

                    $this->session->set_flashdata('message_type', 'success');
                    $this->session->set_flashdata('message', '<strong>Well done!</strong> Dateclip updated successfully.');

                } else {

                    echo 2; exit;
                    $this->session->set_flashdata('message_type', 'danger');
                    $this->session->set_flashdata('message', '<strong>Oh snap!</strong> Dateclip already exists.');
                }
            } else {

                $data_to_store = array(
                    'user_id' => $user_id,
                    'dateclip' => htmlspecialchars($video_name, ENT_QUOTES, 'utf-8')
                );

                if ($this->my_model_v2->insert($data_to_store)) {
                    $this->session->set_flashdata('message_type', 'success');
                    $this->session->set_flashdata('message', '<strong>Well done!</strong> Dateclip added successfully.');

                } else {
                    $this->session->set_flashdata('message_type', 'danger');
                    $this->session->set_flashdata('message', '<strong>Oh snap!</strong> Dateclip already exists.');
                }
            }
        }

        $user_id = $this->session->userdata('session_user_id');

        $data['record'] = $this->my_model_v2->get_user_dateclip($user_id);

        $this->load->view("video",$data);
    }







}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */