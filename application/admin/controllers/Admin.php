<?php
include 'Common.php';

class Admin extends Common {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    /**
     * 管理员管理
     */
    public function index()
    {
        $data = array(
            'title' => '管理员',
        );
        $per_page = 20;
        $limit = (intval(isset($_GET['per_page']) ? $_GET['per_page'] : 1) - 1) * $per_page;
        $sql = 'SELECT * FROM admin WHERE 1 '. $this->condition(). ' ORDER BY admin_id DESC LIMIT '. $limit. ','. $per_page;
        $query = $this->db->query($sql);
        $admins = array();
        foreach($query->result_array() as $row){
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $admins[] = $row;
        }
        $data['admins'] = $admins;
        $data['pagination'] = $this->page(site_url('admin/index'),$this->count(),$per_page);
        $this->load->view('admin_index',$data);
    }

    public function condition()
    {
        $condition = '';
        if(!empty($_GET['k'])){
            $condition .= 'AND username LIKE "%'.$_GET['k'].'%" ';
        }
        return $condition;
    }

    public function count()
    {
        $sql = 'SELECT count(*) count FROM admin WHERE 1 '. $this->condition();
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res[0]['count'];
    }

    public function add()
    {
        $data = array(
            'title' => '添加管理员',
            'action' => 'add',
        );
        if (isset($_POST)&&$_POST){
            if (empty($_POST['username']) || empty($_POST['password'])){
                $data['error'] = array('errorno' => '-1', 'errormessage' => '用户名或密码不能为空！');
                $this->load->view('admin_form',$data);
            }
            if($this->admin_model->username_unique($_POST['username'])){
                show_error('用户名已存在','-2');
            }
            $params = array();
            $params['username'] = $_POST['username'];
            $params['password'] = md5($_POST['password']);
            $params['email'] = empty($_POST['email']) ? '' : $_POST['email'];
            $params['mobile'] = empty($_POST['mobile']) ? '' : $_POST['mobile'];
            $params['ctime'] = time();
            $this->admin_model->add($params);
            redirect(site_url('admin/index'));
        }
        $this->load->view('admin_form',$data);
    }

    public function mod()
    {
        $data = array(
            'title' => '编辑管理员',
            'action' => 'mod',
        );
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        $data['id'] = $id;
        if (isset($_POST)&&$_POST){
            $params = array();
            $username = $_POST['username'];
            if(!$username){
                show_error('用户名不能为空','-2');
            }
            if($this->admin_model->username_unique($username,$id)){
                show_error('用户名已存在','-3');
            }
            $params['username'] = $username;
            if (!empty($_POST['password'])){
                $params['password'] = md5($_POST['password']);
            }
            $params['email'] = $_POST['email'];
            $params['mobile'] = $_POST['mobile'];
            $this->admin_model->mod($id,$params);
            redirect(site_url('admin/index'));
        }
        $data['admin'] = $this->admin_model->detail($id);
        $this->load->view('admin_form',$data);
    }

    public function del()
    {
        if (!$_GET['id']){
            show_error('ID不能为空','-1');
        }
        $id = intval($_GET['id']);
        $this->admin_model->del($id);
        redirect(site_url('admin/index'));
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
            $sql = 'UPDATE admin SET avater="'. $avater. '" WHERE admin_id='. $id;
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
        $data['module'] = 'admin';
        $this->load->view('avater', $data);
    }

    public function checkUsername()
    {
        $username = $_POST['username'];
        if(!empty($_POST['id'])){
            $id = intval($_POST['id']);
        }else{
            $id = 0;
        }
        if($username && $this->admin_model->username_unique($username,$id)){
            echo 'false';
        }else{
            echo 'true';
        }
    }
}
