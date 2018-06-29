<?php

class Login extends CI_Controller
{

    public function index()
    {
        $data = array();
        $data['error'] = array();
        if (isset($_POST) && $_POST){
            $ret = $this->dologin();
            if ($ret['status'] > 0){
                redirect(site_url('home/index'));
            }
            $data['error'] = $ret;
        }

        $this->load->view('login',$data);
    }

    private function dologin()
    {
        if (!$_POST['username'] || !$_POST['password']){
            return array('message'=>'用户名或密码不能为空', 'status' => '-1');
        }
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = 'SELECT * FROM admin WHERE username = "'. $username. '" AND password = "'. $password. '"';
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        if (!$ret){
            return array('message' => '用户名或密码错误', 'status' => '-2');
        }
        $_SESSION['admin'] = $ret[0];

        return array('message'=>'登陆成功！','status'=>'1');
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        session_destroy();
        redirect(site_url('login/index'));
    }
}