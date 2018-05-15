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
        $sql = 'SELECT * FROM admin';
        if ($query = $this->db->query($sql)){
            $data = array(
                'admins' => $query->result_array(),
                'title' => '管理员管理',
            );
        }
        $this->load->view('admin_index',$data);
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
        if (!$_GET['id']){
            show_error('ID不能为空','-1');
        }
        $id = intval($_GET['id']);
        if (isset($_POST)&&$_POST){
            $params = array();
            if (!empty($_POST['username'])){
                $params['username'] = $_POST['username'];
            }
            if (!empty($_POST['password'])){
                $params['password'] = md5($_POST['password']);
            }
            if (!empty($_POST['email'])){
                $params['email'] = $_POST['email'];
            }
            if (!empty($_POST['mobile'])){
                $params['mobile'] = $_POST['mobile'];
            }
            $this->admin_model->mod($id,$params);
            redirect(site_url('admin/index'));
        }
        $data = array(
            'title' => '编辑管理员',
            'action' => 'mod',
        );
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
        $this->load->view('avater', $data);
    }
}
