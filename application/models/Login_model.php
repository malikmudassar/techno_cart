<?php
/**
 * Created by PhpStorm.
 * User: saadi
 * Date: 11/30/2017
 * Time: 4:41 AM
 */
class Login_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function do_login($data)
    {
        $st=$this->db->select('*')->from('users')->WHERE('email',$data['email'])->WHERE('password',md5(sha1($data['password'])))->get()->result_array();

        if(count($st)>0)
        {
            if($st[0]['status']=='approved')
            {
                return $st[0];
            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }
    }

    /*---Forgot Password----*/

    public function checkEmail($data)
    {
        return $this->db->query("SELECT * from users WHERE email='?'", [$data['email']])->result_array();
    }

    public function getUserByEmail($email)
    {
        $st=$this->db->select('*')->from('users')->WHERE('email',$email)->get()->result_array();

        if(count($st)>0)
        {
            return $st[0];
        }
        else
        {
            return false;
        }
    }

    public function updatePassword($id,$hash,$password)
    {
        $st=$this->db->query("SELECT * from users WHERE id=? and hash='?'", [$id, $hash])->result_array();
        if(count($st)>0)
        {
            $newHash = md5(sha1($hash));
            $params = [md5(sha1($password)), $newHash, $id];
            $this->db->query("UPDATE users set password='?', hash='?' WHERE id=?", $params);
            return true;
        }
        else
        {
            return false;
        }

    }
}