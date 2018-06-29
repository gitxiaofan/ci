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
        $mobile = addslashes(trim($_POST['mobile']));
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
                $data['error'] = $error;
                $this->view('reg',$data);
            }
            if(!$nickname = $_POST['nickname']){
                $error['status'] = 102;
                $error['message'] = '昵称不能为空';
                $data['error'] = $error;
                $this->view('reg',$data);
            }
            if(!$password = $_POST['password']){
                $error['status'] = 103;
                $error['message'] = '密码不能为空';
                $data['error'] = $error;
                $this->view('reg',$data);
            }
            if($this->user_model->mobile_unique($mobile)){
                $error['status'] = 104;
                $error['message'] = '此手机号已被注册';
                $data['error'] = $error;
                $this->view('reg',$data);
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
            exit;
        }
        echo 'true';
        exit;
    }

    //忘记密码
    public function passwordForget()
    {
        if(isset($_POST) && $_POST){
            if(!$mobile = $_POST['mobile'])
            {
                $error = array(
                    'status' => -1,
                    'message' => '手机号不能为空'
                );
                $data['error'] = $error;
                $this->view('password_forget',$data);
            }
            if(!$verify = $_POST['verify']){
                $error = array(
                    'status' => -2,
                    'message' => '验证码不能为空'
                );
                $data['error'] = $error;
                $this->view('password_forget',$data);
            }
            $expire = time() - 60*10;
            $sql = 'SELECT * FROM code WHERE mobile='.$mobile.' AND code='.$verify.' AND ctime > '.$expire;
            $query = $this->db->query($sql);
            $res = $query->result_array();
            if($res){
                $sql = 'SELECT * FROM user WHERE mobile = "'. $mobile. '"';
                $query = $this->db->query($sql);
                $ret = $query->result_array();
                $_SESSION['user'] = $ret[0];
                redirect('user/index');
            }else{
                $error = array(
                    'status' => -3,
                    'message' => '验证码已失效，请重新获取验证码'
                );
                $data['error'] = $error;
                $this->view('password_forget',$data);
            }
        }
        $this->view('password_forget');
    }

    //发送验证码
    public function sendCode()
    {
        $mobile = $_POST['mobile'];
        $code = $this->randomKeys();
        $time = time();
        $sql = 'INSERT INTO code SET mobile="'.$mobile.'",code='.$code.',ctime='.$time.' ON duplicate key update code='.$code.',ctime='.$time;
        $this->db->query($sql);
        $res = $this->luosimao($mobile,$code);
        if($res){
            echo 'true';
            exit;
        }
        echo 'false';
        exit;
    }
}