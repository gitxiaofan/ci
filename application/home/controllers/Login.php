<?php
include 'Common.php';

class Login extends Common {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
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
        $this->view('login',$data);
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

    public function reg()
    {
        $error = array();
        if(isset($_POST) && $_POST){
            if(!$mobile =$_POST['mobile']){
                $error['status'] = 101;
                $error['message'] = '手机号不能为空';
            }
            if(!$nickname = $_POST['nickname']){
                $error['status'] = 102;
                $error['message'] = '昵称不能为空';
            }
            if(!$password = $_POST['password']){
                $error['status'] = 103;
                $error['message'] = '密码不能为空';
            }
            if($this->user_model->mobile_unique($mobile)){
                $error['status'] = 104;
                $error['message'] = '此手机号已被注册';
            }
            if(!$error['status']){
                $params = array();
                $params['mobile'] = $mobile;
                $params['password'] = md5($password);
                $params['nickname'] = $nickname;
                $params['ctime'] = time();
                $this->user_model->add($params);
                redirect(site_url('login/index'));
            }
        }
        $data['error'] = $error;
        $this->view('reg',$data);
    }

    public function checkMobile()
    {
        $mobile = $_POST['mobile'];
        if(!empty($_POST['id'])){
            $id = intval($_POST['id']);
        }else{
            $id = 0;
        }
        if($mobile && $this->user_model->mobile_unique($mobile,$id)){
            echo 'false';
        }else{
            echo 'true';
        }
    }
}