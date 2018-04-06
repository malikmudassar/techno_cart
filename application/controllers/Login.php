<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 11/30/2017
 * Time: 4:39 AM
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('Admin_model');
        $this->load->library('My_PHPMailer');
    }

    /*====FUNCTION LOGIN =====*/
    public function index()
    {
        if(!$this->isLoggedIn())
        {
            $data['theme']=$this->Admin_model->getActiveTheme();
            $data['title']='Technology Revolution | Login';
            if($_POST)
            {
                $config = array(
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email',
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required',
                    ),
                );
                $this->form_validation->set_rules($config);
                if($this->form_validation->run()==false)
                {
                    $json = ["type" => "error", "response" => validation_errors()];
                    header("application/json");
                    echo json_encode($json);
                }
                else
                {
                    $user=$this->login_model->do_login($_POST);
                    if(!empty($user))
                    {
                        if($user['role']==1)
                        {
                            $user['type']='Admin';
                        }
                        $this->session->set_userdata($user);
                        require(APPPATH.'user_info.php');
                        $c_info =new Users_info;
                        $ip = $c_info->c_ip();
                        $os = $c_info->c_OS();
                        $b = $c_info->c_Browser();
                        $d = $c_info->c_Device();
                        $data=array('ip' => $ip,'browser' => $b, 'operating_system' => $os, 'device' => $d);
                        $id=$this->session->userdata('id');
                        $where=array('id' => $id);
                        $this->db->WHERE($where);
                        $this->db->update('users',$data);
                        $redirect_link = base_url().$user['type'];
                        $json = [
                            "type" => "success",
                            "response" => "Login successful Redirecting...",
                            "redirect_link" => $redirect_link
                        ];
                        header("application/json");
                        echo json_encode($json);
                    }
                    else
                    {
                        $json = [ "type" => "error", "response" => "Wrong username or password!" ];
                        header("application/json");
                        echo json_encode($json);
                    }
                }
            }
            else
            {
                $data['theme']=$this->Admin_model->getActiveTheme();
                $this->load->view('backend/static/head', $data);
                $this->load->view('backend/static/login');
            }
        }
        else
        {
            redirect(base_url().$this->session->userdata['type']);
        }
    }

    /*==== FUNCTION CHECK USER SESSION ====*/
    public function isLoggedIn()
    {
        if(!empty($this->session->userdata['id'])&& !empty($this->session->userdata['type']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /*==== FORGOT PASSWORD SECTION ====*/
    public function mail_change_password_Link($user)
    {
        // Sending User a URL in the Email to Active his account by verifying his email address
        $settings=$this->Admin_model->getEmailSettings();
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = $settings->host;                    // setting GMail as our SMTP server
        $mail->Port       = $settings->port;                    // SMTP port to connect to GMail
        $mail->Username   = $settings->email;                   // user email address
        $mail->Password   = $settings->password;                // password in GMail
        $mail->SetFrom($settings->sent_email, $settings->sent_title);       //Who is sending the email
        $mail->AddReplyTo($settings->reply_email,$settings->reply_email);   //email address that receives the response
        $mail->Subject    = "Please reset your password";
        $mail->IsHTML(true);
        $body = $this->load->view('emails/mailChangePasswordLink', $user, true);
        $mail->MsgHTML($body);
        $destination = $user['email']; // Who is addressed the email to
        $mail->AddAddress($destination);
        if(!$mail->Send()) {
            $data['code']=300;
            $data["message"] = "Error: " . $mail->ErrorInfo;
        }
    }
    public function mailPasswordChanged($user)
    {
        // Sending User a URL in the Email to Active his account by verifying his email address
        $settings=$this->Admin_model->getEmailSettings();
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = $settings->host;                    // setting GMail as our SMTP server
        $mail->Port       = $settings->port;                    // SMTP port to connect to GMail
        $mail->Username   = $settings->email;                   // user email address
        $mail->Password   = $settings->password;                // password in GMail
        $mail->SetFrom($settings->sent_email, $settings->sent_title);       //Who is sending the email
        $mail->AddReplyTo($settings->reply_email,$settings->reply_email);   //email address that receives the response
        $mail->Subject    = "Congratulations! You password has been reset.";
        $mail->IsHTML(true);
        $body = $this->load->view('emails/mailPasswordChanged', $user, true);
        $mail->MsgHTML($body);
        $destination = $user['email']; // Who is addressed the email to
        $mail->AddAddress($destination);
        if(!$mail->Send()) {
            $data['code']=300;
            $data["message"] = "Error: " . $mail->ErrorInfo;
        }
    }

    public function forgot_password()
    {
        $data['theme']=$this->Admin_model->getActiveTheme();
        $data['title'] = 'Technology Revolution | Forget Password';
        if($_POST)
        {
            $check=$this->login_model->checkEmail($_POST);
            //print_r($check);exit;
            if(empty($check))
            {
                /*$data['errors']='Sorry! The Email address you have provided is not registered in our database!';
                $data['title'] = 'Technology Revolution | Forget Password';

                $this->load->view('backend/static/head', $data);
                $this->load->view('backend/static/forgot_password');*/
                $json = ["type" => "error", "response" => "Email Not exist in Database"];
                header("application/json");
                echo json_encode($json);
            }
            else
            {
                $user=$this->login_model->getUserByEmail($_POST['email']);
                $this->mail_change_password_Link($user);
                /*$data['success']='An Email has been sent to you on your email address with the password reset link. Please click on that link to reset your password.';
                $data['title'] = 'Technology Revolution | Forget Password';
                $data['theme']=$this->Admin_model->getActiveTheme();
                $this->load->view('backend/static/head', $data);
                $this->load->view('backend/static/forgot_password');*/
                $json = [
                    "type" => "success",
                    "response" => "Reset Password Link Sent"
                ];
                echo json_encode($json);
            }
        }
        else
        {

            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/forgot_password');
        }
    }
    public function change_password()
    {
        $id=$this->uri->segment(3);
        $hash=$this->uri->segment(4);
        $data['theme']=$this->Admin_model->getActiveTheme();
        $data['title'] = 'Technology Revolution | Reset Password';
        if($_POST)
        {
            $config=array(
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'c_password',
                    'label' => 'Confirm Password',
                    'rules' => 'trim|required|matches[password]'
                ),
            );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==false)
            {
                $data['errors']=validation_errors();
                $data['title'] = 'Technology Revolution | Reset Password';
                $this->load->view('backend/static/head', $data);
                $this->load->view('backend/static/reset_password');
            }
            else
            {
                $check=$this->login_model->updatePassword($id,$hash,$_POST['password']);
                if($check)
                {
                    $user=$this->Admin_model->getById('users',$id);
                    $this->mailPasswordChanged($user);
                    $data['theme']=$this->Admin_model->getActiveTheme();
                    $data['success']='Congratulations! Your password has been changed.';
                    $data['title'] = 'Technology Revolution | Forget Password';

                    $this->load->view('backend/static/head', $data);
                    $this->load->view('backend/static/reset_password');
                }
                else
                {
                    $data['errors']='The link is expired. Try Again';
                    $data['title'] = 'Technology Revolution | Reset Password';
                    $this->load->view('backend/static/head', $data);
                    $this->load->view('backend/static/reset_password');
                }
            }
        }
        else
        {
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/reset_password');
        }

    }
}