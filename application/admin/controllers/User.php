<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    /**
     * 用户管理
     */
    public function index()
    {
        $this->load->database();
        $sql = 'SELECT * FROM user';
        if ($query = $this->db->query($sql)){
            foreach($query->result() as $user){
                echo $user->mobile,'<br>';
            }
        }
        $this->load->view('user_index');
    }
}
