<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class IOFactory extends PHPExcel_IOFactory
{
    public function IOFactory()
    {
        require_once("PHPExcel/IOFactory.php");
    }
}
?>

