<?php
include 'Common.php';

class User extends Common
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->checklogin();
        $user_id = $_SESSION['user']['user_id'];
        if (isset($_POST) && $_POST){
            $mobile = $_POST['mobile'];
            if (!$mobile){
                $this->output(array('status'=>'-1','message'=>'手机号不能为空！'));
            }
            if($this->user_model->mobile_unique($mobile,$user_id)){
                $this->output(array('status'=>'-2','message'=>'手机号已存在'));
            }
            $params = array();
            $params['mobile'] = $mobile;
            if($_POST['password']){
                $params['password'] = md5($_POST['password']);
            }
            $params['email'] = $_POST['email'];
            $params['nickname'] = $_POST['nickname'];
            $params['avater'] = $_POST['avater'];
            $this->user_model->mod($user_id,$params);
            $sql = 'SELECT * FROM user WHERE user_id='. $user_id;
            $query = $this->db->query($sql);
            $ret = $query->result_array();
            $_SESSION['user'] = $ret[0];
        }
        $user = $this->user_model->detail($user_id);
        $data['user'] = $user;
        $this->view('user_index',$data);
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

    public function avater()
    {
        $return = array();
        if(isset($_POST) && $_POST){
            if(!$img = $_POST['img']){
                $this->output(array(status=>-1, 'message'=>'图片不能为空'));
            }
            if($pic = $this->upload_img64($img,'memorial')){
                $return = array('status'=>1,'message'=>'上传成功','pic'=>$pic);
            }else{
                $return = array('status'=>0,'message'=>'上传失败');
            }
            $this->output($return);
        }
        $this->output($return);
    }
}