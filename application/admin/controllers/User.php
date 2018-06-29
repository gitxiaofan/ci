<?php
include 'Common.php';

class User extends Common
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    /**
     * 用户管理
     */
    public function index()
    {
        $data = array(
            'title' => '用户',
        );
        $per_page = 20;
        $limit = (intval(isset($_GET['per_page']) ? $_GET['per_page'] : 1) - 1) * $per_page;
        $sql = 'SELECT * FROM user WHERE 1 '. $this->condition(). ' ORDER BY user_id DESC LIMIT '. $limit. ','. $per_page;
        $query = $this->db->query($sql);
        $users = array();
        foreach($query->result_array() as $row){
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $users[] = $row;
        }
        $data['users'] = $users;
        $data['pagination'] = $this->page(site_url('user/index'),$this->count(),$per_page);
        $this->load->view('user_index', $data);
    }

    public function condition()
    {
        $condition = '';
        if(!empty($_GET['k'])){
            $condition .= 'AND nickname LIKE "%'.$_GET['k'].'%" OR mobile LIKE "%'.$_GET['k'].'%" ';
        }
        return $condition;
    }

    public function count()
    {
        $sql = 'SELECT count(*) count FROM user WHERE 1 '. $this->condition();
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res[0]['count'];
    }

    public function add()
    {
        $data = array(
            'title' => '添加用户',
            'action' => 'add',
        );
        if (isset($_POST)&&$_POST){
            $mobile = $_POST['mobile'];
            if (!$mobile){
                show_error('手机号不能为空！','-1');
            }
            if (empty($_POST['password'])){
                show_error('密码不能为空','-2');
            }
            if($this->user_model->mobile_unique($mobile)){
                show_error('手机号已存在','-3');
            }
            $params = array();
            $params['mobile'] = $mobile;
            $params['password'] = md5($_POST['password']);
            $params['email'] = $_POST['email'];
            $params['nickname'] = $_POST['nickname'];
            $params['ctime'] = time();
            $this->user_model->add($params);
            redirect(site_url('user/index'));
        }
        $this->load->view('user_form', $data);
    }

    public function mod()
    {
        $data = array(
            'title' => '修改用户',
            'action' => 'mod',
        );
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        $data['id'] = $id;
        if(isset($_POST) && $_POST){
            $mobile = $_POST['mobile'];
            if (!$mobile){
                show_error('手机号不能为空！','-1');
            }
            if($this->user_model->mobile_unique($mobile,$id)){
                show_error('手机号已存在','-3');
            }
            $params = array();
            $params['mobile'] = $mobile;
            if($_POST['password']){
                $params['password'] = md5($_POST['password']);
            }
            $params['email'] = $_POST['email'];
            $params['nickname'] = $_POST['nickname'];
            $this->user_model->mod($id,$params);
            redirect(site_url('user/index'));
        }
        $data['user'] = $this->user_model->detail($id);
        $this->load->view('user_form', $data);
    }

    public function del()
    {
        $data = array(
            'title' => '修改用户',
            'action' => 'mod',
        );
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        $sql = 'DELETE FROM user WHERE user_id='.$id;
        $this->db->query($sql);
        redirect('user/index');
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
        $data = array(
            'title' => '修改用户头像',
        );
        if(isset($_POST) && $_POST){
            if(!$id = $_POST['id']){
                show_error('id不能为空','-1');
            }
            if(!$img = $_POST['img']){
                show_error('图片不能为空','-2');
            }
            if(!$avater = $this->upload_img64($img,'avater')){
                show_error('上传失败','-3');
            }
            $sql = 'UPDATE user SET avater="'. $avater. '" WHERE user_id='. $id;
            if($this->db->query($sql)){
                $res = array('status'=>1,'message'=>'上传成功');
            }else{
                $res = array('status'=>0,'message'=>'上传失败');
            }
            echo json_encode($res);
            exit;
        }
        if(!$id = $_GET['id']){
            show_error('id不能为空','0');
        }
        $data['id'] = $id;
        $data['module'] = 'user';
        $this->load->view('avater', $data);
    }
}
