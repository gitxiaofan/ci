<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    /**
     * 管理员管理
     */
    public function index()
    {
        $sql = 'SELECT * FROM admin';
        if ($query = $this->db->query($sql)){
            $data = array(
                'admins' => $query->result_array(),
                'title' => '管理员管理',
            );
        }
        $this->load->view('admin_index',$data);
    }
}
