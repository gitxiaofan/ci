<?php
include 'Common.php';

class Memorial extends Common
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('memorial_model');
    }

    /*
     * 纪念馆管理
     */
    public function index()
    {
        $data = array(
            'title' => '纪念馆列表',
        );
        $sql = 'SELECT * FROM memorial';
        $query = $this->db->query($sql);
        $data['memorials'] = $query->result_array();
        $this->load->view('memorial_index',$data);
    }

    public function add()
    {
        $data = array(
            'title' => '添加纪念馆',
            'action' => 'add',
        );
        if (isset($_POST)&&$_POST){
            $ret = $this->doadd();
            if ($ret['status'] > 0){
                redirect(site_url('memorial/index'));
            }
            $data['error'] = $ret;
        }
        $this->load->view('memorial_form', $data);
    }

    public function doadd()
    {
        if (empty($_POST['name'])){
            return  array('message' => '姓名不能为空！','status'=>'-1');
        }
        $params = array();
        $params['name'] = htmlspecialchars($_POST['name']);
        $params['brief'] = $_POST['brief'] ? htmlspecialchars($_POST['brief']) : '';
        $params['birthday'] = $_POST['birthday'] ? $_POST['birthday'] : '';
        $params['death'] = $_POST['death'] ? $_POST['death'] : '';
        $params['epitaph'] = $_POST['epitaph'] ? htmlspecialchars($_POST['epitaph']) : '';
        $params['is_strong'] = intval($_POST['is_strong']) == 1 ? 1 : 0;
        $params['stick'] = intval($_POST['stick']) == 1 ? 1 : 0;
        $params['content'] = $_POST['content'] ? htmlspecialchars($_POST['content']) : '';
        $params['ctime'] = time();
        if($this->memorial_model->add($params)){
            return array('message'=>'添加成功！','status'=> '1');
        }
        return array('message' => '添加失败！','status' => '-2');
    }

    public function mod()
    {
        if (!$_GET['id']){
            show_error('ID不能为空','-1');
        }
        $id = intval($_GET['id']);
        if (isset($_POST)&&$_POST){
            if (empty($_POST['name'])){
                return  array('message' => '姓名不能为空！','status'=>'-1');
            }
            $params = array();
            $params['name'] = htmlspecialchars($_POST['name']);
            $params['brief'] = $_POST['brief'] ? htmlspecialchars($_POST['brief']) : '';
            $params['birthday'] = $_POST['birthday'] ? $_POST['birthday'] : '';
            $params['death'] = $_POST['death'] ? $_POST['death'] : '';
            $params['epitaph'] = $_POST['epitaph'] ? htmlspecialchars($_POST['epitaph']) : '';
            $params['is_strong'] = intval($_POST['is_strong']) == 1 ? 1 : 0;
            $params['stick'] = intval($_POST['stick']) == 1 ? 1 : 0;
            $params['content'] = $_POST['content'] ? htmlspecialchars($_POST['content']) : '';
            $params['update_time'] = time();
            $this->memorial_model->mod($id,$params);
            redirect(site_url('memorial/index'));
        }
        $data = array(
            'title' => '编辑管理员',
            'action' => 'mod',
        );
        $data['memorial'] = $this->memorial_model->detail($id);
        $this->load->view('memorial_form',$data);
    }

    public function del()
    {
        if (!$_GET['id']){
            show_error('ID不能为空','-1');
        }
        $id = intval($_GET['id']);
        $this->memorial_model->del($id);
        redirect(site_url('memorial/index'));
    }
}