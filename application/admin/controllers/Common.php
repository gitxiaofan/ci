<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->checklogin();
    }

    public function checklogin()
    {
        if ($_SESSION['admin'] && $_SESSION['admin']['admin_id']){
            return true;
        }
        redirect(site_url('login/index'));
    }

}