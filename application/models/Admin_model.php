<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 2/22/2018
 * Time: 10:00 PM
 */
class Admin_model extends CI_Model
{
    ///////////////////////////////////////
    ///                                 ///
    ///     Admin Menu Section Starts   ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== GET MENU PARENTS ====*/
    public function getMenuParents($table)
    {
        return $this->db->select('*')->from($table)->where('parent', 0)->get()->result_array();
    }

    /*==== ADD ADMIN MENU ITEM ====*/
    public function addMenuItem($data,$table)
    {
        $item = array(
            'parent' => $data['parent'],
            'name' => $data['name'],
            'class' => $data['class'],
            'url' => $data['url']
        );

        $this->db->insert($table, $item);
    }

    /*==== UPDATE ADMIN MENU ITEM =====*/
    public function updateMenuItem($data, $menuId, $table)
    {
        $item = array(
            'parent' => $data['parent'],
            'name' => $data['name'],
            'class' => $data['class'],
            'url' => $data['url']
        );

        $this->db->WHERE('id', $menuId)->update($table, $item);
    }

    /*==== GET ADMIN MENU ITEMS =====*/
    public function getMenuItems($table)
    {
        $st = $this->db->select('*')->from($table)->where('parent', 0)->get()->result_array();
        if (count($st) > 0) {
            for ($i = 0; $i < count($st); $i++) {
                $st[$i]['child'] = $this->db->select('*')->from($table)->where('parent', $st[$i]['id'])->get()->result_array();
            }
        } else {
            return false;
        }

        return $st;
    }

    /*==== GET ALL ADMIN MENU ITEMS ====*/
    public function getAllMenuItems($table)
    {
        return $this->db->query("SELECT ".$table.".*, a.name as parent from ".$table." left join ".$table." a on a.id=$table.parent")->result_array();
    }

    /*==== GET MENU ITEM DETAIL ====*/
    public function getMenuItemDetail($table, $menuId)
    {
        $st = $this->db->select('*')->from($table)->WHERE('id', $menuId)->get()->result_array();
        return $st[0];
    }

    /*===== DEL ADMIN MENU =====*/
    public function delAdminMenu($id)
    {
        $this->db->query('DELETE from admin_menu WHERE id=' . $id);
    }

    public function delete_menu($table,$id)
    {
        $this->db->query("DELETE from $table WHERE id='$id'");
    }

    ///////////////////////////////////////
    ///                                 ///
    ///     Admin Menu Section Ends     ///
    ///                                 ///
    ///////////////////////////////////////

    /*==== FUNCTION GET ALL DATA ====*/
    public function getAll($table)
    {
        return $this->db->select('*')->from($table)->get()->result_array();
    }

    /*==== FUNCTION GET ACTIVE THEME ====*/
    public function getActiveTheme()
    {
        $st=$this->db->select('name')->from('theme')->where('status','Active')->get()->result_array();
        return $st[0]['name'];
    }

    /*==== FUNCTION GET ACTIVE THEME ID ====*/
    public function getActiveThemeId()
    {
        $st=$this->db->select('*')->from('theme')->where('status','Active')->get()->result_array();
        return $st[0]['id'];
    }

    /*==== FUNCTION ACTIVATE THEME ====*/
    public function activateTheme($id)
    {
        $theme=$this->getActiveThemeId();
        $data=array(
            'status'=> 'Inactive'
        );
        $this->db->WHERE('id',$theme)->update('theme',$data);

        $data=array(
            'status'=> 'Active'
        );
        $this->db->WHERE('id',$id)->update('theme',$data);
    }

    /*==== CHECK OLD PASSWORD ====*/
    public function checkOldPass($email, $oldPass)
    {
        $array = array(
            'email' => $email,
            'password' => $oldPass
        );
        $st = $this->db->select('id')->from('users')->WHERE($array)->get()->result_array();
        return $this->db->affected_rows();
    }

    /*==== UPDATE PASSWORD ====*/
    public function updatePass($id, $pass)
    {
        $update = array(
            'password' => $pass
        );
        $this->db->WHERE('id', $id)->update('users', $update);
    }

    /*==== GET USER ID ====*/
    public function getUserId($email)
    {
        $st = $this->db->select('id')->from('users')->WHERE('email', $email)->get()->result_array();
        return $st[0];
    }

    /*==== GET EMAIL SETTINGS ====*/
    public function getEmailSettings()
    {
        return $this->db->select('*')->from('email_settings')->WHERE('id', 1)->get()->row();
    }

    public function getConfig_Byid($id)
    {
        $st = $this->db->query('SELECT * from email_settings where id=' . $id)->result_array();
        return $st[0];
    }


    /*===== UPDATE SOCIAL LINKS =====*/
    public function update_social_links($data, $id)
    {
        $item = array(
            'facebook'   => $data['facebook'],
            'twitter'    => $data['twitter'],
            'google_plus' => $data['google'],
            'linkedin'   => $data['linkedin']
        );
        $this->db->WHERE('id', $id)->update('social_links', $item);
    }

    /*==== UPDATE SMTP CONFIG ====*/
    public function update_smtp_config($data, $menuId)
    {
        $item = array(
            'host' => $data['host'],
            'port' => $data['port'],
            'email' => $data['email'],
            'password' => $data['password'],
            'sent_email' => $data['sent_email'],
            'sent_title' => $data['sent_title'],
            'reply_email' => $data['reply_email'],
            'reply_title' => $data['reply_title']
        );
        $this->db->WHERE('id', $menuId)->update('email_settings', $item);
    }

    /*===== UPDATE COMPANY INFO =====*/
    public function update_company($data, $id)
    {
        $item = array(
            'name'      => $data['name'],
            'email'     => $data['email'],
            'contact'   => $data['contact'],
            'address'   => $data['address'],
            'website'   => $data['website'],
        );
        $this->db->WHERE('id', $id)->update('company_information', $item);
    }

    public function update_logo($row_id)
    {
        $configUpload['upload_path'] = './uploads/';
        $configUpload['allowed_types'] = 'jpg|png|jpeg';
        $configUpload['max_size'] = '0';
        $configUpload['max_width'] = '0';
        $configUpload['max_height'] = '0';
        $configUpload['encrypt_name'] = true;
        $this->load->library('upload', $configUpload);
        $this->upload->initialize($configUpload);
        if (!$this->upload->do_upload('image')) {
            $uploaddetails = $this->upload->display_errors();
            print_r($uploaddetails);
            exit;
        } else {
            $image_name = $this->upload->data('file_name');
            $this->db->update('company_information', ['logo' => $image_name], ['id' => $row_id]);

        }
    }

    public function get_company_info()
    {
        $st = $this->db->query('SELECT * from company_information where id= 1')->result_array();
        return $st[0];
    }

    /*==== DELETE SINGLE DATA =====*/
    public function delete($table,$id)
    {
        $this->db->query("DELETE from $table WHERE id='$id'");
    }

    /*===== GET RECORD BY ID =====*/
    public function getById($table, $id)
    {
        $st = $this->db->select('*')->from($table)->WHERE('id', $id)->get()->result_array();
        return $st[0];
    }

    ///////////////////////////////////////
    ///                                 ///
    ///     Product Section Start       ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD CATEGORY =====*/
    public function add_category($data)
    {
        $item = array(
            'name' => $data['name'],
            'icon' => $data['icon']
        );
        $this->db->insert('category', $item);
    }

    /*===== UPDATE CATEGORY =====*/
    public function update_category($data, $id)
    {
        $item = array(
            'name' => $data['name'],
            'icon' => $data['icon']
        );
        $this->db->WHERE('id', $id)->update('category', $item);
    }

    public function register_user($data)
    {
        $item = array(
            'f_name'   => $data['f_name'],

        );
    }

    public function upload_brand_logo($row_id)
    {
        $configUpload['upload_path'] = './uploads/brands_logo';
        $configUpload['allowed_types'] = 'jpg|png|jpeg|gif';
        $configUpload['max_size'] = '0';
        $configUpload['max_width'] = '0';
        $configUpload['max_height'] = '0';
        $configUpload['encrypt_name'] = true;
        $this->load->library('upload', $configUpload);
        $this->upload->initialize($configUpload);
        if (!$this->upload->do_upload('image')) {
            $uploaddetails = $this->upload->display_errors();
            print_r($uploaddetails);
            exit;
        } else {
            $image_name = $this->upload->data('file_name');
            $this->db->update('brands', ['image' => $image_name], ['id' => $row_id]);
        }
    }

    /*===== ADD BRAND =====*/
    public function add_brand($data)
    {
        $item = array(
            'name'  =>  $data['name']
        );
        $this->db->insert('brands',$item);
        $row_id = $this->db->insert_id();
        $this->upload_brand_logo($row_id);
        return $row_id;
    }

    /*===== UPDATE BRAND =====*/
    public function update_brand($data, $id)
    {
        $item = array(
            'name' => $data['name']
        );
        $this->db->WHERE('id', $id)->update('brands', $item);
    }

    /*===== GET BRANDS =====*/
    public function get_brands($id = null)
    {
        $this->db->select("b.name, b.id", false);
        if($id){
            $this->db->select("if(bg.cat_id=$id, 1, 0) as is_selected");
        }
        $this->db->join("brand_groups bg", "bg.brand_id=b.id", "left");
        $this->db->group_by("b.id");
        $res = $this->db->get("brands b")->result();
        // exit($this->db->last_query());
        return $res;
    }

    public function get_brands_where($id = null)
    {
        $this->db->select("b.name, b.id, bg.cat_id");
        if($id){
            $this->db->where("bg.cat_id", $id);
        }
        $this->db->join("brand_groups bg", "bg.brand_id=b.id", "left");
        $res = $this->db->get("brands b")->result();
        return $res;
    }

    public function get_brands_with_selection($id){
        $brands = $this->get_brands();
        $selected = $this->get_brands_where($id);

        foreach ($selected as $key => $brand) {
            foreach ($selected as $sel){
                if($brand->cat_id == $sel->cat_id){
                    $brands[$key]->is_selected = 1;
                } else{
                    $brands[$key]->is_selected = 0;
                }
            }            
        }
        return $brands;
    }

    public function get_sub_cats($id = null)
    {
        if($id){
            $this->db->where("cat_id", $id);
        }
        $res = $this->db->get("sub_category")->result();
        return $res;
    }
   
    /*===== ADD SUB CATEGORY =====*/
    public function add_sub_category($data)
    {
        $item = array(
            'name'      => $data['name'],
            'cat_id'    => $data['cat_id']
        );
        $this->db->insert('sub_category', $item);
    }

    /*==== UPDATE SUB CATEGORY =====*/
    public function update_sub_category($data, $id)
    {
        $item = array(
            'name'      => $data['name'],
            'cat_id'    => $data['cat_id']
        );
        $this->db->WHERE('id', $id)->update('sub_category', $item);
    }

    /*===== ADD PRODUCT =====*/
    public function add_product($data)
    {
        $discount_per = $data['discount'] / 100;
        $discount_price = $data['sale_price'] * $discount_per;
        $discounted_amount = $data['sale_price'] - $discount_price;
        $item = array(
            'name'            => $data['name'],
            'part_no'         => $data['part_no'],
            'cat_id'          => $data['cat_id'],
            'sub_cat_id'      => $data['sub_cat_id'],
            'brand_id'        => $data['brand_id'],
            'purchase_price'  => $data['purchase_price'],
            'sale_price'      => $data['sale_price'],
            'qty'             => $data['qty'],
            'discount'        => $discounted_amount,
            'tags'            => $data['tags'],
            'details'         => $data['detail'],
        );
        $this->db->insert('products', $item);
        $row_id = $this->db->insert_id();
        $this->upload_product_img('products',$row_id);
        return $row_id;
    }

    /*====== UPLOAD PRODUCT IMAGE ======*/
    public function upload_product_img($table, $row_id)
    {
        $configUpload['upload_path'] = './uploads/products';
        $configUpload['allowed_types'] = 'jpg|png|jpeg|gif';
        $configUpload['max_size'] = '0';
        $configUpload['max_width'] = '500px';
        $configUpload['max_height'] = '500px';
        $configUpload['encrypt_name'] = true;
        $this->load->library('upload', $configUpload);
        $this->upload->initialize($configUpload);
        if (!$this->upload->do_upload('image')) {
            $uploaddetails = $this->upload->display_errors();
            print_r($uploaddetails);
            exit;
        } else {
            $image_name = $this->upload->data('file_name');
            $this->db->update($table, ['image' => $image_name], ['id' => $row_id]);
        }
    }

    /*===== UPDATE PRODUCT =====*/
    public function update_product($data, $id)
    {
        $item = array(
            'name'            => $data['name'],
            'part_no'         => $data['part_no'],
            'cat_id'          => $data['cat_id'],
            'sub_cat_id'      => $data['sub_cat_id'],
            'brand_id'        => $data['brand_id'],
            'purchase_price'  => $data['purchase_price'],
            'sale_price'      => $data['sale_price'],
            'qty'             => $data['qty'],
            'tags'            => $data['tags'],
            'details'         => $data['details'],
        );
        $this->db->WHERE('id', $id)->update('products', $item);
    }

    /*===== ADD PRODUCT IN BULK =====*/
    public function add_bulk_product($array)
    {
        $this->db->insert('products',$array);
    }

    /*==== ENABLE FEATURE PRODUCT ====*/
    public function enable_feature($id)
    {
        $item = array(
            'p_feature' => 'YES'
        );
        $this->db->WHERE('id',$id)->update('products',$item);
    }

    /*==== DISABLE FEATURE PRODUCT ====*/
    public function disable_feature($id)
    {
        $item = array(
            'p_feature' => "NO"
        );
        $this->db->WHERE('id',$id)->update('products',$item);
    }

    ///////////////////////////////////////
    ///                                 ///
    ///      Product Section Ends       ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///       Upload section start      ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== IMAGE UPLOAD =====*/
    public function upload_img($table, $row_id)
    {
        $configUpload['upload_path'] = './uploads/';
        $configUpload['allowed_types'] = 'jpg|png|jpeg|gif';
        $configUpload['max_size'] = '0';
        $configUpload['max_width'] = '0';
        $configUpload['max_height'] = '0';
        $configUpload['encrypt_name'] = true;
        $this->load->library('upload', $configUpload);
        $this->upload->initialize($configUpload);
        if (!$this->upload->do_upload('image')) {
            $uploaddetails = $this->upload->display_errors();
            print_r($uploaddetails);
            exit;
        } else {
            $image_name = $this->upload->data('file_name');
            $this->db->update($table, ['image' => $image_name], ['id' => $row_id]);
        }
    }

    ///////////////////////////////////////
    ///                                 ///
    ///       Upload section End        ///
    ///                                 ///
    ///////////////////////////////////////

    ///////////////////////////////////////
    ///                                 ///
    ///      Frontend Section Start     ///
    ///                                 ///
    ///////////////////////////////////////

    /*===== ADD SLIDE =====*/
    public function add_slide($data)
    {
       $item = array(
           'title'      => $data['title'],
           'sub_title'  => $data['sub_title'],
           'quote'      => $data['quote'],
           'link'       => $data['link']
       );
       $this->db->insert('slider', $item);
       $row_id = $this->db->insert_id();
       $this->upload_img('slider',$row_id);
       return $row_id;
    }

    /*===== UPDATE SLIDE =====*/
    public function update_slide($data, $id)
    {
        $item = array(
            'title'      => $data['title'],
            'sub_title'  => $data['sub_title'],
            'quote'      => $data['quote'],
            'link'       => $data['link']
        );
        $this->db->WHERE('id', $id)->update('slider', $item);
    }

    /*==== ENABLE SLIDER IMAGE ====*/
    public function enable_slider($id)
    {
        $item = array(
            'status' => 'Enable'
        );
        $this->db->WHERE('id',$id)->update('slider',$item);
    }

    /*==== DISABLE SLIDER IMAGE ====*/
    public function disable_slider($id)
    {
        $item = array(
            'status' => "Disable"
        );
        $this->db->WHERE('id',$id)->update('slider',$item);
    }

    ///////////////////////////////////////
    ///                                 ///
    ///      Frontend section End       ///
    ///                                 ///
    ///////////////////////////////////////

    /*====== COUNTER SECTION START ======*/
    public function get_counters()
    {
        $st = $this->db->query('SELECT COUNT(*) as count from products')->result_array();
        $data['products'] = $st[0]['count'];
        $st = $this->db->query('SELECT COUNT(*) as count from customer WHERE status=\'approved\'')->result_array();
        $data['customers'] = $st[0]['count'];
        return $data;
    }

    /*====== COUNTER SECTION END ======*/


    /*===== ADD ADMIN =====*/
    public function add_admin($data)
    {
        $item = array(
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => md5(sha1($data['password'])),
            'hash'     => md5(sha1($data['email'])),
            'role'     => $data['role'],
            'status'   => 'approved'
        );
        $this->db->insert('users', $item);
        $row_id = $this->db->insert_id();
        $this->upload_img('users', $row_id);
        return $row_id;
    }
}