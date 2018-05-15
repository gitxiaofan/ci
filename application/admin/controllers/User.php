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
            'title' => '用户列表',
        );
        $sql = 'SELECT * FROM user';
        if ($query = $this->db->query($sql)){
            $data['users'] = $query->result_array();
        }
        $this->load->view('user_index', $data);
    }

    public function add()
    {
        $data = array(
            'title' => '添加用户',
            'action' => 'mod',
        );
        if (isset($_POST)&&$_POST){
            $ret = $this->doadd();
            if ($ret > 0){
                redirect(site_url('user/index'));
            }
            $data['error'] = $ret;
        }
        $this->load->view('user_form', $data);
    }

    private function doadd()
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
        file_put_contents('');

    }

    public function del()
    {

    }

    public function checkMobile()
    {
        if ($_REQUEST['mobile'] == '123456'){
            exit('false');
        }else{
            exit('true');
        }
    }
}
