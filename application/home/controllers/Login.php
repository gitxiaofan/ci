<?php
include 'Common.php';

class Login extends Common {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $data['error'] = array();
        if (isset($_POST) && $_POST){
            $ret = $this->dologin();
            if ($ret['status'] > 0){
                redirect(site_url('index/index'));
            }
            $data['error'] = $ret;
        }
        $this->view('login');
    }

    private function dologin()
    {
        if (!$_POST['mobile'] || !$_POST['password']){
            return array('message'=>'手机号或密码不能为空', 'status' => '-1');
        }
        $mobile = $_POST['mobile'];
        $password = md5($_POST['password']);
        $sql = 'SELECT * FROM user WHERE mobile = "'. $mobile. '" AND password = "'. $password. '"';
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        if (!$ret){
            return array('message' => '手机号或密码错误', 'status' => '-2');
        }
        $_SESSION['user'] = $ret[0];

        return array('message'=>'登陆成功！','status'=>'1');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        redirect(site_url('login/index'));
    }
}