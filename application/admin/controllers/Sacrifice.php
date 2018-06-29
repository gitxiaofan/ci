<?php
include 'Common.php';

class Sacrifice extends Common
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sacrifice_model');
    }

    public function index()
    {
        $data = array(
            'title' => '纪念馆列表',
        );
        $per_page = 20;
        $limit = (intval(isset($_GET['per_page']) ? $_GET['per_page'] : 1) - 1) * $per_page;
        $sql = 'SELECT * FROM sacrifice WHERE 1 '. $this->condition(). ' ORDER BY id DESC LIMIT '. $limit. ','. $per_page;
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $sacrifices = array();
        foreach ($res as $row){
            $row['pic'] = base_url().$row['pic'];
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $sacrifices[] = $row;
        }
        $data['sacrifices'] = $sacrifices;
        $data['pagination'] = $this->page(site_url('sacrifice/index'),$this->count(),$per_page);
        $this->load->view('sacrifice_index',$data);
    }

    public function condition()
    {
        $condition = '';
        if(!empty($_GET['k'])){
            $condition .= 'AND name LIKE "%'.$_GET['k'].'%" ';
        }
        return $condition;
    }

    public function count()
    {
        $sql = 'SELECT count(*) count FROM sacrifice WHERE 1 '. $this->condition();
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res[0]['count'];
    }

    public function add()
    {
        $data = array(
            'title' => '添加祭品',
            'action' => 'add',
        );
        if (isset($_POST)&&$_POST){
            if(!$_POST['name']){
                show_error('祭品名称不能为空','-1');
            }

            if($_FILES['pic'] && $_FILES["pic"]["size"] > 1024 * 1024 * 2){
                show_error('图片大小超过2M，无法上传','-2');
            }
            $params = array();
            $params['name'] = htmlspecialchars($_POST['name']);
            $params['sort'] = intval($_POST['sort']);
            $file = $this->do_upload('pic',sacrifice);
            $params['pic'] = 'uploads/sacrifice/'. $file['file_name'];
            $this->sacrifice_model->add($params);
            redirect(site_url('sacrifice/index'));
        }
        $this->load->view('sacrifice_form', $data);
    }

    public function mod()
    {
        $data = array(
            'title' => '添加祭品',
            'action' => 'mod',
        );
        $id = intval($_GET['id']);
        if(!$id){
            show_error('ID不能为空','-1');
        }
        $data['id'] = $id;
        if(isset($_POST) && $_POST){
            $params = array();
            $params['name'] = $_POST['name'];
            $params['sort'] = $_POST['sort'];
            if(!empty($_FILES['pic']['tmp_name'])){
                $file = $this->do_upload('pic','sacrifice');
                $params['pic'] = 'uploads/sacrifice/'. $file['file_name'];
            }
            $this->sacrifice_model->mod($id,$params);
            redirect(site_url('sacrifice/index'));
        }
        $data['sacrifice'] = $this->sacrifice_model->detail($id);
        $this->load->view('sacrifice_form', $data);
    }

    public function del()
    {
        $id = intval($_GET['id']);
        if(!$id){
            show_error('ID不能为空','-1');
        }
        $this->sacrifice_model->del($id);
        redirect(site_url('sacrifice/index'));
    }

}