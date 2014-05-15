<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_function {

    private $CI;

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

        //parent::__construct();
        //$this->load->library('form_validation');
        $this->CI = &get_instance();
        $this->CI->load->library('email');
    }

    public function password_reset_email($activation_link = NULL, $to_email = NULL) {

        //echo $activation_link."---".$to_email;exit();

        $this->CI->email->from('your@example.com', 'Your Name');
        $this->CI->email->to($to_email);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->CI->email->subject('Account activation link');

        $message = "";
        $message .= "<p>Please click link to reset your password.</p>";
                
        $message .= "<a href='".$activation_link."' >test</a>";

        //echo $message;

        $this->CI->email->message($message);

        $this->CI->email->send();
        //echo $this->CI->email->print_debugger();exit();
        
    }

    public function email_to_user($to_email = NULL, $name = NULL, $subject = NULL, $message = NULL) {

        $this->CI->email->from('your@example.com', 'Your Name');
        $this->CI->email->to($to_email);

        $this->CI->email->subject($subject);

        $this->CI->email->message($message);

        $this->CI->email->send();
        
    }




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */