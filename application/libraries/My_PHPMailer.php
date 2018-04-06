<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Malik Mudassar
 * Date: 4/17/15
 * Time: 10:02 AM
 */
    class My_PHPMailer {
        public function __construct() {
            require_once('PHPMailer/PHPMailerAutoload.php');
        }
    }

?>