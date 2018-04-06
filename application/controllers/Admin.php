<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/22/2018
 * Time: 9:53 PM
 *
 * @property  Admin_model Admin_model
 **/

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('My_PHPMailer');

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*===== DASHBOARD ======*/
    public function index()
    {
        if($this->isLoggedIn())
        {
            $data['counters'] = $this->Admin_model->get_counters();
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Dashboard";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/dashboard');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///     Admin Section Starts        ///
    ///                                 ///
    ///////////////////////////////////////

    /*====== ADD ADMIN USER LOAD FORM =====*/
    public function add_admin_user()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Admin";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_admin');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== ADD ADMIN USER AJAX CALL ======*/
    public function save_admin_user()
    {
        if($this->isLoggedIn())
        {
            if($_POST)
            {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'confirm_password',
                        'label' => 'Conform Password',
                        'rules' => 'trim|required|matches[password]'
                    ),
                );
                $this->form_validation->set_rules($config);
                if($this->form_validation->run() == false)
                {
                    echo json_encode((["msg_type" => "errors" , "message" => validation_errors()]));
                }
                else {
                    $this->Admin_model->add_admin($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Admin Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== MANAGE ADMIN USERS ======*/
    public function manage_admin_users()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['admins'] = $this->Admin_model->getAll('users');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Admin Users";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_users');
            $this->load->view('backend/static/footer');
        }
        else {
            redirect(base_url());
        }
    }

    /*===== DELETE USER =====*/
    public function delete_user()
    {
        if ($this->isLoggedIn()) {
            $menuId = $this->input->post('id');
            $this->Admin_model->delete('users', $menuId);
        } else {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///       Admin Section End         ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///      Menu Section Starts        ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== ADD ADMIN SIDEBAR MENU ====*/
    public function add_menu()
    {
        if ($this->isLoggedIn()) {
            $data['parents'] = $this->Admin_model->getMenuParents('admin_menu');
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Admin Menu";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_menu');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== SAVE MENU ITEM VIA AJAX CALL =====*/
    public function save_menu()
    {
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'parent',
                    'label' => 'Parent',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
            } else {
                $this->Admin_model->addMenuItem($_POST, 'admin_menu');
                echo json_encode((["msg_type" => "success", "message" => "Menu Added Successfully" ]));
            }
        }
    }

    /*==== EDIT ADMIN SIDEBAR MENU =====*/
    public function edit_admin_menu()
    {
        if ($this->isLoggedIn()) {
            $menuId = $this->uri->segment(3);
            $data['parents'] = $this->Admin_model->getMenuParents('admin_menu');
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['menu_item'] = $this->Admin_model->getMenuItemDetail('admin_menu', $menuId);
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit Admin Menu";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_admin_menu');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    /*===== SAVE EDIT ADMIN MENU VIA AJAX =====*/
    public function save_admin_edit_menu()
    {
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'parent',
                    'label' => 'Parent',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
            } else {
                $id = $this->input->post('id2');
                $this->Admin_model->updateMenuItem($_POST, $id, 'admin_menu');
                echo json_encode((["msg_type" => "success", "message" => "Menu Updated Successfully" ]));
            }
        }
    }

    /*==== DEL ADMIN SIDEBAR MENU ====*/
    public function del_admin_menu()
    {
        if ($this->isLoggedIn()) {
            $menuId = $this->input->post('id');
            $this->Admin_model->delete_menu('admin_menu', $menuId);
        } else {
            redirect(base_url());
        }
    }

    /*==== MANAGE ADMIN SIDEBAR MENU ====*/
    public function manage_admin_menu()
    {
        if ($this->isLoggedIn()) {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['menu_items'] = $this->Admin_model->getAllMenuItems('admin_menu');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Admin Menu";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_admin_menu');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///       Menu Section End          ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///       Menu Section Ends         ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== FUNCTION CHECK USER SESSION =====*/
    public function isLoggedIn()
    {
        if (!empty($this->session->userdata['id']) && $this->session->userdata['type'] == 'Admin') {
            return true;
        } else {
            return false;
        }
    }

    /*==== FUNCTION LOGOUT CURRENT USER =====*/
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    /*==== FUNCTION CHANGE CURRENT THEME ====*/
    public function changeTheme()
    {
        $id = $this->uri->segment(3);
        $path = $_SERVER['HTTP_REFERER'];
        $this->Admin_model->activateTheme($id);
        redirect($path);
    }


    ///////////////////////////////////////
    ///                                 ///
    ///     Product Section Start       ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD CATEGORY LOAD FORM =====*/
    public function add_category()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ADD CATEGORY VIA AJAX CALL =====*/
    public function save_category()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'icon',
                        'label' => 'Font Icon',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_category($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Category Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE CATEGORY LOAD FORM =====*/
    public function edit_category()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat_detail'] = $this->Admin_model->getById('category', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Update Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE CATEGORY AJAX CALL =====*/
    public function save_update_category()
    {
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'icon',
                    'label' => 'icon',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
            } else {
                $id = $this->input->post('id');
                $this->Admin_model->update_category($_POST, $id);
                echo json_encode((["msg_type" => "success", "message" => "Category Updated Successfully" ]));
            }
        }
    }

    /*===== DELETE CATEGORY ======*/
    public function del_category()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('category', $id);
        } else {
            redirect(base_url());
        }
    }

    /*===== MANAGE CATEGORY ======*/
    public function manage_categories()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['cat'] = $this->Admin_model->getAll('category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Categories";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_categories');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ADD BRAND =====*/
    public function add_brand()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Brand";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_brand');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE BRAND AJAX CALL =====*/
    public function save_brand()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_brand($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Brand added successfully!"]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE BRAND =====*/
    public function edit_brand()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['brand_detail'] = $this->Admin_model->getById('brands', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Update Brand";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_brand');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE BRAND AJAX CALL =====*/
    public function save_update_brand()
    {
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
            } else {
                $id = $this->input->post('id');
                $this->Admin_model->update_brand($_POST, $id);
                echo json_encode((["msg_type" => "success", "message" => "Brand Updated Successfully" ]));
            }
        }
    }

    /*===== DELETE BRAND =====*/
    public function delete_brand()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('brands', $id);
        } else {
            redirect(base_url());
        }
    }

    /*===== MANAGE BRANDS ======*/
    public function manage_brands()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['brands'] = $this->Admin_model->getAll('brands');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage brands";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_brands');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ADD SUB CATEGORY =====*/
    public function add_sub_category()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['category'] = $this->Admin_model->getAll('category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Sub Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_sub_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== ADD SUB CATEGORY AJAX CALL ====*/
    public function save_sub_category()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'cat_id',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_sub_category($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Sub-Category Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== MANAGE SUB CATEGORY ======*/
    public function manage_sub_category()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['sub_cats'] = $this->Admin_model->getAll('sub_category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Sub_Categories";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_sub_categories');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== EDIT SUB CATEGORY =====*/
    public function edit_sub_category()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['categories'] = $this->Admin_model->getAll('category');
            $data['brands'] = $this->Admin_model->getAll('brands');
            $data['sub_cat_detail'] = $this->Admin_model->getById('sub_category', $id);
            $data['brands'] = $this->Admin_model->get_brands_with_selection($id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit Sub Category";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_sub_category');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE EDIT CATEGORY AJAX CALL =====*/
    public function update_sub_cat()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'id',
                        'label' => 'Sub Category ID',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'cat_id',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $sub_cat_id = $this->input->post('id', true);
                    $post_data = $this->input->post(['name', 'cat_id'], true);
                    $brands = $this->input->post("brands", true);



                    $this->Admin_model->update_sub_category($post_data, $sub_cat_id);
                    if(!empty($brands)){
                        $this->db->where("cat_id", $sub_cat_id)->delete("brand_groups");
                        foreach ($brands as $key => $brand) {
                            $this->db->insert("brand_groups", ['cat_id' => $sub_cat_id, 'brand_id' => $brand]);
                        }
                    } else{
                        $this->db->where("cat_id", $sub_cat_id)->delete("brand_groups");
                    }
                    echo json_encode((["msg_type" => "success", "message" => "Sub-Category Updated Successfully"]));
                }
            }
        }
        else
        {
            echo json_encode((["msg_type" => "error", "message" => "Please login" ]));
        }
    }

    /*===== DELETE SUB CATEGORY =====*/
    public function delete_sub_cat()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('sub_category', $id);
        } else {
            redirect(base_url());
        }
    }

    /*===== ADD PRODUCT LOAD FORM =====*/
    public function add_product()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['categories'] = $this->Admin_model->getAll('category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Add Product";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_product');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    public function get_sub_cats(){
        $cat_id = $this->input->post("cat_id", true);
        $sub_cats = $this->Admin_model->get_sub_cats($cat_id);
        echo "<option value=''>Select Sub Category</opiton>";
        foreach ($sub_cats as $key => $cat) {
            echo "<option value='$cat->id'>$cat->name</opiton>";
        }
    }

    public function get_brands(){
        $sub_cat_id = $this->input->post("sub_cat_id", true);
        $brands = $this->Admin_model->get_brands_where($sub_cat_id);
        echo "<option value=''>Select Brand</opiton>";
        foreach ($brands as $key => $brand) {
            echo "<option value='$brand->id'>$brand->name</opiton>";
        }
    }

    /*===== SAVE PRODUCT VIA AJAX CALL =====*/
    public function save_product()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'part_no',
                        'label' => 'Product Code',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'cat_id',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sub_cat_id',
                        'label' => 'Sub Category',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'brand_id',
                        'label' => 'Brand',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'purchase_price',
                        'label' => 'Purchase Price',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sale_price',
                        'label' => 'Sale Price',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'discount',
                        'label' => 'Discount',
                    ),
                    array(
                        'field' => 'tags',
                        'label' => 'Tags',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'detail',
                        'label' => 'Details',
                        'rules' => 'trim|required'
                    ),
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_product($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Product Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== MANAGE PRODUCTS ======*/
    public function manage_products()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['products'] = $this->Admin_model->getAll('products');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Products";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_products');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== EDIT PRODUCT LOAD FORM ======*/
    public function edit_product()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['product_detail'] = $this->Admin_model->getById('products', $id);
            $data['category'] = $this->Admin_model->getAll('category');
            $data['sub_category'] = $this->Admin_model->getAll('sub_category');
            $data['brand'] = $this->Admin_model->getAll('brands');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit Product";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_product');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== EDIT PRODUCT AJAX CALL =====*/
    public function save_edit_product()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'part_no',
                        'label' => 'Product Code',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'cat_id',
                        'label' => 'Category',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sub_cat_id',
                        'label' => 'Sub Category',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'brand_id',
                        'label' => 'Brand',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'purchase_price',
                        'label' => 'Purchase Price',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sale_price',
                        'label' => 'Selling Price',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'tags',
                        'label' => 'Tags',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'details',
                        'label' => 'Details',
                        'rules' => 'trim|required'
                    ),
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_product($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Product Updated Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== VIEW PRODUCT DETAIL =====*/
    public function view_product_detail()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['product_detail'] = $this->Admin_model->getById('products', $id);
            $data['cat_name'] = $this->Admin_model->getAll('category');
            $data['brands'] = $this->Admin_model->getAll('brands');
            $data['sub_category'] = $this->Admin_model->getAll('sub_category');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Product Detail";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/view_product_detail');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== DELETE PRODUCT ======*/
    public function delete_product()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('products', $id);
        } else {
            redirect(base_url());
        }
    }

    /*===== ADD PRODUCT BULK =====*/
    public function add_product_bulk()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Import Product Bulk";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_product_bulk');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE PRODUCT BULK VIA AJAX CALL =====*/
    public function save_bulk_product()
    {
        if($this->isLoggedIn())
        {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                $array_data = array(
                    'name'           => $fileop[0],
                    'part_no'        => $fileop[1],
                    'cat_id'         => $fileop[2],
                    'sub_cat_id'     => $fileop[3],
                    'brand_id'       => $fileop[4],
                    'purchase_price' => $fileop[5],
                    'sale_price'     => $fileop[6],
                    'qty'            => $fileop[7],
                    'tags'           => $fileop[8],
                    'details'        => $fileop[9],
                    'image'          => $fileop[10]
                );
                //echo '<pre>'; print_r($array_data);
                $this->Admin_model->add_bulk_product($array_data);
                echo json_encode((["msg_type" => "success", "message" => "Data Imported Successfully" ]));
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE PRODUCT BULK =====*/
    public function update_product_bulk()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Import Product Bulk";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/update_bulk_product');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE PRODUCT BULK AJAX CALL =====*/
    public function save_update_bulk_product()
    {
        if($this->isLoggedIn())
        {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                $array_data = array(
                    'name'           => $fileop[1],
                    'part_no'        => $fileop[2],
                    'cat_id'         => $fileop[3],
                    'sub_cat_id'     => $fileop[4],
                    'brand_id'       => $fileop[5],
                    'purchase_price' => $fileop[6],
                    'sale_price'     => $fileop[7],
                    'qty'            => $fileop[8],
                    'tags'           => $fileop[9],
                    'details'        => $fileop[10],
                    'image'          => $fileop[11]
                );
                $this->db->update('products',$array_data,array('id'=>$fileop[11]));
                echo json_encode((["msg_type" => "success", "message" => "Data Updated Successfully" ]));
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*==== ENABLE FEATURE PRODUCT ====*/
    public function enable_feature_product()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->enable_feature($id);
        } else {
            redirect(base_url());
        }
    }

    /*===== DISABLE FEATURE PRODUCT ====*/
    public function disable_feature_product()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->disable_feature($id);
        } else {
            redirect(base_url());
        }
    }

    /*====== EXPORT PRODUCT ======*/
    public function export_product()
    {
        if($this->isLoggedIn())
        {
            $this->load->model("Admin_model");
            $this->load->library('Excel');
            $object = new PHPExcel();
            $object->setActiveSheetIndex(0);
            $table_columns = array("id", "name", "part_no", "cat_id", "sub_cat_id", "brand_id", "purchase_price", "sale_price", "qty", "tags", "details", "image");
            $columns = 0;
            foreach($table_columns as $field)
            {
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow($columns,1,$field);
                $columns++;
            }

            $products = $this->Admin_model->getAll('products');
            $excel_row = 2;
            for($i=0; $i<count($products); $i++)
            {
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(0,$excel_row,$products[$i]['id']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(1,$excel_row,$products[$i]['name']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(2,$excel_row,$products[$i]['part_no']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(3,$excel_row,$products[$i]['cat_id']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(4,$excel_row,$products[$i]['sub_cat_id']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(5,$excel_row,$products[$i]['brand_id']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(6,$excel_row,$products[$i]['purchase_price']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(7,$excel_row,$products[$i]['sale_price']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(8,$excel_row,$products[$i]['qty']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(9,$excel_row,$products[$i]['tags']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(10,$excel_row,$products[$i]['details']);
                $object->setActiveSheetIndex()->setCellValueByColumnAndRow(11,$excel_row,$products[$i]['image']);
                $excel_row++;
            }
            $object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="products.xls"');
            $object_writer->save('php://output');
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///      Product Section End        ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///  SMTP/SMS Api Settings  Start   ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== EDIT SMTP CONFIG ====*/
    public function edit_smtp_config()
    {
        if ($this->isLoggedIn()) {
            $menuId = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['smtp_config'] = $this->Admin_model->getConfig_Byid($menuId);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit SMTP Config";
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_smtp_config');
            $this->load->view('backend/static/footer');
        } else {
            redirect(base_url());
        }
    }

    public function save_smtp_setting()
    {
        if($this->isLoggedIn())
        {
            if($_POST)
            {
                $config = array(
                    array(
                        'field' => 'host',
                        'label' => 'Host',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'port',
                        'label' => 'Port',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sent_email',
                        'label' => 'Sent_Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'sent_title',
                        'label' => 'Sent_Title',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'reply_email',
                        'label' => 'Reply_Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'reply_title',
                        'label' => 'Reply_Title',
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
                    $id = $this->input->post('id');
                    $this->Admin_model->update_smtp_config($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "SMTP Updated Successfully" ]));
                }

            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== EDIT COMPANY INFO LOAD FORM ======*/
    public function edit_company_info(){
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['detail']= $this->Admin_model->getById('company_information', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Edit Company Info";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_company_info');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE EDIT COMPANY INFORMATION =====*/
    public function save_edit_info()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config = array(
                    array(
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'contact',
                        'label' => 'Contact No.',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'website',
                        'label' => 'Website url',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $id = $this->input->post('id2');
                    $this->Admin_model->update_company($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Info Updated Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== UPDATE LOGO ======*/
    public function change_logo()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/update_logo');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== UPDATE LOGO AJAX CALL =====*/
    public function update_logo()
    {
        if($this->isLoggedIn())
        {
            if($_FILES)
            {
                $id = 1;
                $this->Admin_model->update_logo($id);
                echo json_encode((["msg_type" => "success", "message" => "Logo Updated Successfully" ]));
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///       SMTP Settings End         ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///    Frontend Settings Start      ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD NEW SLIDE =====*/
    public function add_slide()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/add_slider_image');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== SAVE SLIDER IMAGE AJAX CALL =====*/
    public function save_slide()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config=array(
                    array(
                        'field' =>  'title',
                        'label' =>  'Title',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'sub_title',
                        'label' =>  'Sub Title',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'quote',
                        'label' =>  'Quote',
                        'rules' =>  'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $this->Admin_model->add_slide($_POST);
                    echo json_encode((["msg_type" => "success", "message" => "Slide Added Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== MANAGE SLIDES =====*/
    public function manage_slides()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['slider'] = $this->Admin_model->getAll('slider');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Slides";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_slider');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== EDIT SLIDE =====*/
    public function edit_slide()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['slide_detail'] = $this->Admin_model->getById('slider', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Change Logo";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/edit_slider_image');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== SAVE EDIT SLIDE ======*/
    public function save_edit_slide()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config=array(
                    array(
                        'field' =>  'title',
                        'label' =>  'Title',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'sub_title',
                        'label' =>  'Sub Title',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'quote',
                        'label' =>  'Quote',
                        'rules' =>  'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_slide($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Slide Updated Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    /*==== ENABLE SLIDER IMAGE ====*/
    public function enable_slider_image()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->enable_slider($id);
        } else {
            redirect(base_url());
        }
    }

    /*===== DISABLE SLIDER IMAGE ====*/
    public function disable_slider_image()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->disable_slider($id);
        } else {
            redirect(base_url());
        }
    }

    /*==== DELETE SLIDER IMAGE ====*/
    public function del_sliderImage()
    {
        if ($this->isLoggedIn()) {
            $id = $this->input->post('id');
            $this->Admin_model->delete('slider', $id);
        } else {
            redirect(base_url());
        }
    }

    /*===== UPDATE SOCIAL LINKS =====*/
    public function update_social_links()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['social_links'] = $this->Admin_model->getById('social_links', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Update Social Links";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/update_social_links');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*=====  UPDATE SOCIAL ICONS AJAX CALL =====*/
    public function save_update_social_link()
    {
        if($this->isLoggedIn())
        {
            if ($_POST) {
                $config=array(
                    array(
                        'field' =>  'facebook',
                        'label' =>  'Facebook Link',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'twitter',
                        'label' =>  'Twitter Link',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'google',
                        'label' =>  'GooglePlus+ Link',
                        'rules' =>  'trim|required'
                    ),
                    array(
                        'field' =>  'linkedin',
                        'label' =>  'LinkedIn Link',
                        'rules' =>  'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == false) {
                    echo json_encode((["msg_type" => "error", "message" => validation_errors() ]));
                } else {
                    $id = $this->input->post('id');
                    $this->Admin_model->update_social_links($_POST, $id);
                    echo json_encode((["msg_type" => "success", "message" => "Links Updated Successfully" ]));
                }
            }
        }
        else
        {
            redirect(base_url());
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///     Frontend Settings End       ///
    ///                                 ///
    ///////////////////////////////////////

    /*====== MANAGE CUSTOMERS ======*/
    public function manage_customers()
    {
        if($this->isLoggedIn())
        {
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['customers'] = $this->Admin_model->getAll('customer');
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Manage Customers";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/manage_customers');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*====== VIEW CUSTOMER DETAIL ======*/
    public function view_customer_detail()
    {
        if($this->isLoggedIn())
        {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->Admin_model->getMenuItems('admin_menu');
            $data['theme'] = $this->Admin_model->getActiveTheme();
            $data['customer_detail'] = $this->Admin_model->getById('customer', $id);
            $data['company_info'] = $this->Admin_model->get_company_info();
            $data['title'] = $data['company_info']['name']." | Customer Detail";
            $this->load->view('backend/static/head', $data);
            $this->load->view('backend/static/header');
            $this->load->view('backend/static/sidebar1');
            $this->load->view('backend/view_customer_detail');
            $this->load->view('backend/static/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    /*===== DELETE CUSTOMER =====*/
    public function delete_customer()
    {
        if($this->isLoggedIn())
        {
            $id = $this->input->post('id');
            $this->Admin_model->delete('customer', $id);
        }
        else {
            redirect(base_url());
        }
    }
}