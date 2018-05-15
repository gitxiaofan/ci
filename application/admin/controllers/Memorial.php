<?php
include 'Common.php';

class Memorial extends Common
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('memorail_model');
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
            if ($ret > 0){
                redirect(site_url('memorial/index'));
            }
            $data['error'] = $ret;
        }
        $this->load->view('memorial_form', $data);
    }

    public function doadd()
    {
        if (empty($_POST['mobile']) || empty($_POST['password'])){
            return  array('message' => '手机号或密码不能为空！','status'=>'-1');
        }
        $params = array();
        $params['mobile'] = empty($_POST['mobile']) ? '' : $_POST['mobile'];
        $params['password'] = md5($_POST['password']);
        $params['email'] = empty($_POST['email']) ? '' : $_POST['email'];
        $params['nickname'] = $_POST['nickname'];
        $params['ctime'] = time();
        if($this->user_model->add($params)){
            return array('message'=>'添加成功！','$status'=> '1');
        }
        return array('message' => '添加失败！','status' => '-2');
    }

    public function mod()
    {

    }

    public function del()
    {

    }
}