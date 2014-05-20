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

    	$config['mailtype'] = 'html';
    	$this->CI->email->initialize($config);

        $this->CI->email->from('no-reply@dateclip.com', 'DateClip.com');
        $this->CI->email->to($to_email);

        $this->CI->email->subject('DateClip - Password Reset');

        $message = "<p>Hello, </p>";
        $message .= "<p>A password reset request has been submitted on your behalf.</p>";
        $message .= "<p>If you feel that this has been done in error, delete and disregard this email.
        				Your account is still secure and no one has been given access to it.
        				It is not locked and your password has not been reset.
        				Someone could have mistakenly entered your email address. </p>";
        $message .= "<p>Follow the link below to login and change your password. </p>";

        $message .= "<a href='".$activation_link."' >".$activation_link."</a>";
        $message .= "<p><i>DateClip.com Team</i></p>";
        //echo $message;

        $this->CI->email->message($message);
        $this->CI->email->send();
        //echo $this->CI->email->print_debugger();exit();
    }

    public function email_to_user($to_email = NULL, $name = NULL, $subject = NULL, $message = NULL) {

    	$config['mailtype'] = 'html';
    	$this->CI->email->initialize($config);

        $this->CI->email->from('no-reply@dateclip.com', 'DateClip.com');
        $this->CI->email->to($to_email);

        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        $this->CI->email->send();
    }




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */