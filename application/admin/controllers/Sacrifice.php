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
        $sql = 'SELECT * FROM sacrifice';
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $sacrifices = array();
        foreach ($res as $row){
            $row['pic'] = base_url().$row['pic'];
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $sacrifices[] = $row;
        }
        $data['sacrifices'] = $sacrifices;
        $this->load->view('sacrifice_index',$data);
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
            $params = array();
            $params['name'] = htmlspecialchars($_POST['name']);
            $params['sort'] = intval($_POST['sort']);
            $file = $this->do_upload('pic');
            $params['pic'] = 'uploads/sacrifice/'. $file['file_name'];
            $this->sacrifice_model->add($params);
            redirect(site_url('sacrifice/index'));
        }
        $this->load->view('sacrifice_form', $data);
    }

    public function mod()
    {
        $id = intval($_GET['id']);
        if(!$id){
            show_error('ID不能为空','-1');
        }
        if(isset($_POST) && $_POST){
            $params = array();
            $params['name'] = $_POST['name'];
            $params['sort'] = $_POST['sort'];
            if($_FILES){
                $file = $this->do_upload('pic','sacrifice');
                $params['pic'] = 'uploads/sacrifice/'. $file['file_name'];
            }
            $this->sacrifice_model->mod($id,$params);
            redirect(site_url('sacrifice/index'));
        }
        $data = array(
            'title' => '添加祭品',
            'action' => 'add',
        );
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