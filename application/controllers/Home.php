<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/23/2018
 * Time: 12:11 AM
 */
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Admin_model');
        $this->load->library('My_PHPMailer');
        $this->load->library('cart');
        $this->load->library('form_validation');
    }

    /*===== HOME PAGE ======*/
    public function index()
    {
        $data['get_fet'] = $this->Home_model->get_featured_products();
        //echo '<pre>'; print_r($data['get_fet']); exit;
        $data['cats'] = $this->Home_model->get_all_categories();
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['all_products'] = $this->Home_model->get_new_products();
        $data['new_arrv'] = $this->Home_model->get_new_arrivals();
        $data['title'] = $data['company_info']['name']." | Home";
        $data['slides'] = $this->Home_model->getAll('slider');
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/home');
        $this->load->view('frontend/static/footer');
    }

    /*===== ABOUT US =====*/
    public function About_us()
    {
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | About Us";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/about_us');
        $this->load->view('frontend/static/footer');
    }

    /*===== Contact Us =====*/
    public function Contact_us()
    {
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Contact Us";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/contact_us');
        $this->load->view('frontend/static/footer');
    }

    /*====== GET SINGLE PRODUCT DETAIL PAGE ======*/
    public function get_product_detail()
    {
        $id = $this->uri->segment(3);
        $page_views=intval($this->Home_model->get_page_views($id));
        $this->Home_model->increment_page_view($id,$page_views+1);
        $data['page_views']=$page_views+1;
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['product_detail'] = $this->Home_model->getById('products',$id);
        $data['related_product'] = $this->Home_model->related_products($data['product_detail']['sub_cat_id']);
        //echo '<pre>'; print_r($data['related_product']); exit;
        $data['category']  = $this->Admin_model->getAll('category');
        $data['sub_category']  = $this->Admin_model->getAll('sub_category');
        $data['brands']  = $this->Admin_model->getAll('brands');
        //echo "<pre>";print_r($data['product_detail']);exit;
        if($this->input->get('id')!=''){
            $this->cart->insert($data['product_detail']['id']);
        }
        $data['title'] = $data['company_info']['name']." | Contact Us";

        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/product_detail');
        $this->load->view('frontend/static/footer');
    }
    /**
        Add to Cart
     */
    public function a2c()
    {
        $id=$this->uri->segment(3);
        $data['product'] = $this->Home_model->getById('products',$id);
        $product=array(
            'id'    =>  $data['product']['id'],
            'name'  =>  $data['product']['name'],
            'price' =>  $data['product']['sale_price'],
            'qty'   =>  1
        );
        $this->cart->insert($product);
        redirect(base_url());
    }

    /*===== REGISTER =====*/
    public function Customer_sign_up()
    {
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Sign In / Register";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/Sign_up');
        $this->load->view('frontend/static/footer');
    }

    /*===== SIGN IN ======*/
    public function Customer_sign_in()
    {
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | Sign In";
        if($_POST){
            $config=array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==false)
            {
                $data['errors']=validation_errors();
                $data['category'] = $this->Home_model->getAll('category');
                $data['brands'] = $this->Home_model->getAll('brands');
                $data['social_links'] = $this->Home_model->get_social_links();
                $data['company_info'] = $this->Admin_model->get_company_info();
                $data['title'] = $data['company_info']['name']." | Sign In";
                $this->load->view('frontend/static/head',$data);
                $this->load->view('frontend/static/header');
                $this->load->view('frontend/customer_sign');
                $this->load->view('frontend/static/footer');
            }
            else
            {
                $user=$this->Home_model->do_login($_POST);
                if($user)
                {
                    $this->session->set_userdata($user);
                    redirect(base_url());
                }
                else
                {
                    $data['errors']='Sorry, Wrong Credentials, Try Again!';
                }
            }
        }
        else
        {
            $this->load->view('frontend/static/head',$data);
            $this->load->view('frontend/static/header');
            $this->load->view('frontend/customer_sign');
            $this->load->view('frontend/static/footer');
        }
    }

    /*====== CUSTOMER DASHBOARD  ======*/
    public function Customer_dashboard()
    {
        if($this->isLoggedIn())
        {
            $data['social_links'] = $this->Home_model->get_social_links();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['category']  = $this->Admin_model->getAll('category');
            $data['sub_category']  = $this->Admin_model->getAll('sub_category');
            $data['brands']  = $this->Admin_model->getAll('brands');
            //echo "<pre>";print_r($data['product_detail']);exit;
            $data['title'] = $data['company_info']['name']." | Dashboard";
            $this->load->view('frontend/static/head',$data);
            $this->load->view('frontend/static/header');
            $this->load->view('frontend/dashboard');
            $this->load->view('frontend/static/footer');
        }
        else {
            redirect(base_url());
        }
    }

    /*===== EDIT PROFILE =====*/
    public function Edit_profile()
    {
        if($this->isLoggedIn())
        {
            $data['social_links'] = $this->Home_model->get_social_links();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['category']  = $this->Admin_model->getAll('category');
            $data['sub_category']  = $this->Admin_model->getAll('sub_category');
            $data['brands']  = $this->Admin_model->getAll('brands');
            $id = $this->uri->segment(3);
            $data['detail'] = $this->Admin_model->getById('customer', $id);
            $data['title'] = $data['company_info']['name']." | Edit Profile";
            $this->load->view('frontend/static/head',$data);
            $this->load->view('frontend/static/header');
            $this->load->view('frontend/edit_profile');
            $this->load->view('frontend/static/footer');
        }
        else {
            redirect(base_url());
        }
    }

    /*===== UPDATE PROFILE AJAX CALL ======*/
    public function update_profile()
    {
        if($this->isLoggedIn())
        {
            if($_POST) {
                $config = array(
                    array(
                        'field' => 'first_name',
                        'label' => 'First Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'last_name',
                        'label' => 'Last Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'contact_no',
                        'label' => 'Contact No',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'address_1',
                        'label' => 'Address 1',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'address_2',
                        'label' => 'Address 2',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'country',
                        'label' => 'Country',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'city',
                        'label' => 'City',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'state',
                        'label' => 'State',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'zip_code',
                        'label' => 'Zip Code',
                        'rules' => 'trim|required'
                    ),
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "errors", "message" => validation_errors()]));
                } else {

                    $id = $this->input->post('id');
                    $this->Home_model->update_profile($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Profile Updated Successfully"]));

                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ORDER HISTORY =====*/
    public function order_history()
    {
        if($this->isLoggedIn())
        {
            $data['social_links'] = $this->Home_model->get_social_links();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['category']  = $this->Admin_model->getAll('category');
            $data['sub_category']  = $this->Admin_model->getAll('sub_category');
            $data['brands']  = $this->Admin_model->getAll('brands');
            $data['title'] = $data['company_info']['name']." | Order History Profile";
            $this->load->view('frontend/static/head',$data);
            $this->load->view('frontend/static/header');
            $this->load->view('frontend/order_history');
            $this->load->view('frontend/static/footer');
        }
        else {
            redirect(base_url());
        }
    }

    /*===== CHANGE PASSWORD =======*/
    public function Change_password()
    {
        if($this->isLoggedIn())
        {
            $data['social_links'] = $this->Home_model->get_social_links();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['category']  = $this->Admin_model->getAll('category');
            $data['brands']  = $this->Admin_model->getAll('brands');
            /*$id = $this->uri->segment(3);
            $data['detail'] = $this->Admin_model->getById('customer', $id);*/
            $data['title'] = $data['company_info']['name']." | Change Password";
            $this->load->view('frontend/static/head',$data);
            $this->load->view('frontend/static/header');
            $this->load->view('frontend/change_password');
            $this->load->view('frontend/static/footer');
        }
        else {
            redirect(base_url());
        }
    }

    /*===== CHANGE PASSWORD AJAX ACTION ======*/
    public function change_password_ajax_action()
    {
        if($this->isLoggedIn())
        {
            if($_POST)
            {
                $config = array(
                    array(
                        'field' => 'old_pass',
                        'label' => 'Current Password',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'new_pass',
                        'label' => 'New Password',
                        'rules' => 'required|matches[confirm_pass]'
                    ),
                    array(
                        'field' => 'confirm_pass',
                        'label' => 'Confirm Password',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if($this->form_validation->run() == false)
                {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                }
                else
                {
                    $data['email'] = $this->session->userdata['email'];
                    $encrpTPass = md5(sha1($_POST['old_pass']));
                    $data['oldPass'] = $this->Home_model->checkOldPass($data['email'], $encrpTPass);
                    if ($data['oldPass'] > 0) {
                        $confirmPass = md5(sha1($_POST['confirm_pass']));
                        $data['user_Id'] = $this->Home_model->getUserId($data['email']);
                        $this->Home_model->updatePass($data['user_Id']['id'], $confirmPass);
                        echo json_encode((["msg_type" => "success", "message" => "Password Updated Successfully" ]));
                    }
                    else
                    {
                        echo json_encode((["msg_type" => "error", "message" => "Old Password Not Match" ]));
                    }
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== REGISTER USER AJAX CALL ======*/
    public function register_user()
    {
        if($_POST)
        {
            $config = array(
                array(
                    'field' => 'first_name',
                    'label' => 'First Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'last_name',
                    'label' => 'Last Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'phone',
                    'label' => 'Phone',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'confirm_pass',
                    'label' => 'Conform Password',
                    'rules' => 'trim|required|matches[password]'
                ),
                array(
                    'field' => 'address1',
                    'label' => 'Address Line 1',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'address2',
                    'label' => 'Address Line 2',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'city',
                    'label' => 'City',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'state',
                    'label' => 'State',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'country',
                    'label' => 'Country',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'zip',
                    'label' => 'Zip',
                    'rules' => 'trim|required'
                ),
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false){
                echo json_encode((["msg_type" => "errors" , "message" => validation_errors()]));
            }else{

                $check = $this->Home_model->register_customer($_POST);
                if($check)
                {
                    echo json_encode((["msg_type" => "success" , "message" => "Register successfully Kindly check your Email"]));
                }
                else
                {
                    echo json_encode((["msg_type" => "errors" , "message" => "Email Already Exist"]));
                }
            }
        }
    }

    /*====== SENDING VERIFICATION LINK =======*/
    public function thank($id)
    {
        $data['user']=$this->Admin_model->getById('customer',$id);
        $settings=$this->Admin_model->getEmailSettings();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = $settings->host;
        $mail->Port       = $settings->port;
        $mail->Username   = $settings->email;
        $mail->Password   = $settings->password;
        $mail->SetFrom($settings->sent_email, $settings->sent_title);
        $mail->AddReplyTo($settings->reply_email,$settings->reply_email);
        $mail->Subject    = "Please verify your email address to Activate your Account";
        $mail->IsHTML(true);
        $body = $this->load->view('backend/emails/thanks_email', $data, true);
        $mail->MsgHTML($body);
        $destination = $data['user']['email'];
        $mail->AddAddress($destination);
        if(!$mail->Send()) {
            $data['code']=300;
            $data["message"] = "Error: " . $mail->ErrorInfo;
        }
    }

    /*====== ACTIVATE USER =======*/
    public function activate()
    {
        $id=$this->uri->segment(3);
        $hash=$this->uri->segment(4);
        $this->Home_model->activateUser($id,$hash);
        $user=$this->Home_model->getById($id);
        $this->success($user);
        redirect(base_url().'Home/login');
    }

    /*===== SEND SUCCESSFUL REGISTRATION MESSAGE ======*/
    public function success($reply)
    {
        $settings=$this->Admin_model->getEmailSettings();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = $settings->host;
        $mail->Port       = $settings->port;
        $mail->Username   = $settings->email;
        $mail->Password   = $settings->password;
        $mail->SetFrom($settings->sent_email, $settings->sent_title);
        $mail->AddReplyTo($settings->reply_email,$settings->reply_email);
        $mail->Subject    = "Congratulations! Your account is active now";
        $mail->IsHTML(true);
        $body = $this->load->view('backend/emails/success_email', $reply, true);
        $mail->MsgHTML($body);
        $destination = $reply['email'];
        $mail->AddAddress($destination);
        if(!$mail->Send()) {
            $data['code']=300;
            $data["message"] = "Error: " . $mail->ErrorInfo;
        }
    }


    /*===== CART SECTION START ======*/
    function add_to_cart($para1 = '', $para2 = '', $para3 = '', $para4 = '')
    {
        $this->load->library('cart');
        $data = array(
            'id'    => $_POST['id'],
            'name'  => $_POST['name'],
            'price' => $_POST['sale_price'],
            'qty'   => $_POST['qty']
        );
        $this->cart->insert($data);
        echo $this->view();
    }

    function view(){
        $this->load->library('cart');
        $output = '';
        $output .= '
        <h3>Shopping Cart</h3>
        <div class="table-responsive">
        <div align="right">
        <button type="button" id="clear_cart" class="btn btn-warning">Clear Cart</button>
        <br/>
        <table class="table table-bordered">
        <tr>
        <th width="40%">Name</th>
        <th width="15%">Quantity</th>
        <th width="15%">Price</th>
        <th width="15%">Total</th>
        <th width="15%">Action</th>
</tr>  ';
        $count=0;
        foreach($this->cart->contents() as $items){
            $count ++;
            $output .='
    <tr>
    <td>'.$items['name'].'</td>
    <td>'.$items['qty'].'</td>
    <td>'.$items['price'].'</td>
    <td>'.$items['subtotal'].'</td>
    <td><button type="button" name="remove" class="btn btn-warning btn-xs remove_inventory" id="'.$items['rowid'].'">Remove</button></td>   
</tr>';
        }
        $output .='
<tr><td colspan="4" align="right">Total</td>
<td>'.$this->cart->total().'</td>
</tr>
</table>
</div>
</div>';
        if($count == 0){
            $output .='<h3 align="center">Cart is Empty</h3>';
        }
        return $output;
    }

    function load(){
        echo $this->view();
    }
    function remove(){
        $this->load->library('cart');
        $row_id = $_POST['row_id'];
        $data = array(
            'rowid'=>$row_id,
            'qty'=>0
        );
        $this->cart->update($data);
        echo $this->view();
    }

    function clear(){
        $this->load->library('cart');
        $this->cart->destroy();
        echo $this->view();
    }

    public function Checkout()
    {
        if($this->isLoggedIn())
        {
            $data['category'] = $this->Home_model->getAll('category');
            $data['brands'] = $this->Home_model->getAll('brands');
            $data['social_links'] = $this->Home_model->get_social_links();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Checkout";
            $this->load->view('frontend/static/head',$data);
            $this->load->view('frontend/static/header');
            $this->load->view('frontend/checkout');
            $this->load->view('frontend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== CART SECTION END =====*/

    /*==== FUNCTION CHECK USER SESSION =====*/
    public function isLoggedIn()
    {
        if (!empty($this->session->userdata['id'])){ //&& $this->session->userdata['type'] == 'Customer') {
            return true;
        } else {
            return false;
        }
    }

    /*====== LOGOUT FUNCTION ======*/
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function customer_login()
    {
        if(!$this->isLoggedIn())
        {
            $data['title']='Technology Revolution | Customer Login';
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
                    $user=$this->Home_model->do_login($_POST);
                    if(!empty($user))
                    {
                        $this->session->set_userdata($user);
                        $redirect_link = base_url().'Home/Customer_dashboard';
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
                        $json = [ "type" => "error", "response" => "Invalid Login Credential" ];
                        header("application/json");
                        echo json_encode($json);
                    }
                }
            }
            else
            {
                $data['category'] = $this->Home_model->getAll('category');
                $data['brands'] = $this->Home_model->getAll('brands');
                $data['social_links'] = $this->Home_model->get_social_links();
                $data['company_info'] = $this->Admin_model->get_company_info();
                $data['title'] = $data['company_info']['name']." | Sign In";
                $this->load->view('frontend/static/head',$data);
                $this->load->view('frontend/static/header');
                $this->load->view('frontend/customer_sign');
                $this->load->view('frontend/static/footer');
            }
        }
        else
        {
            redirect(base_url().$this->session->userdata['type']);
        }
    }

    /*======= ALL CATEGORIES ======*/
    public function all_categories()
    {
        $data['category'] = $this->Home_model->getAll('category');
        $data['brands'] = $this->Home_model->getAll('brands');
        //$data['products'] = $this->Home_model->getAllProducts();
        //echo '<pre>'; print_r($data['products']); exit;
        $data['social_links'] = $this->Home_model->get_social_links();
        $data['company_info'] = $this->Admin_model->get_company_info();
        $data['title'] = $data['company_info']['name']." | All Categories";
        $this->load->view('frontend/static/head',$data);
        $this->load->view('frontend/static/header');
        $this->load->view('frontend/all_categories');
        $this->load->view('frontend/static/footer');
    }

}