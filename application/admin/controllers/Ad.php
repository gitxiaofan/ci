<?php
include 'Common.php';

class Ad extends Common
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ad_model');
    }

    public function index()
    {
        $data = array(
            'title' => '广告列表',
        );
        $sql = 'SELECT * FROM ad';
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $ads = array();
        foreach ($res as $row){
            $row['pic'] = base_url().$row['pic'];
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $ads[] = $row;
        }
        $data['ads'] = $ads;
        $data['adcats'] = $this->ad_model->adcat();
        $this->load->view('ad_index',$data);
    }

    public function add()
    {
        $data = array(
            'title' => '添加广告',
            'action' => 'add',
        );
        if (isset($_POST)&&$_POST){
            if(!$_POST['title']){
                show_error('广告名称不能为空','-1');
            }
            $params = array();
            $params['title'] = htmlspecialchars($_POST['title']);
            $params['cat_id'] = intval($_POST['cat_id']);
            $params['sort'] = intval($_POST['sort']);
            $file = $this->do_upload('pic','ad');
            $params['pic'] = 'uploads/ad/'. $file['file_name'];
            $this->ad_model->add($params);
            redirect(site_url('ad/index'));
        }
        $data['adcats'] = $this->ad_model->adcat();
        $this->load->view('ad_form', $data);
    }

    public function mod()
    {
        $id = intval($_GET['id']);
        if(!$id){
            show_error('ID不能为空','-1');
        }
        if(isset($_POST) && $_POST){
            $params = array();
            $params['title'] = htmlspecialchars($_POST['title']);
            $params['cat_id'] = intval($_POST['cat_id']);
            $params['sort'] = intval($_POST['sort']);
            if($_FILES){
                $file = $this->do_upload('pic','ad');
                $params['pic'] = 'uploads/ad/'. $file['file_name'];
            }
            $this->ad_model->mod($id,$params);
            redirect(site_url('ad/index'));
        }
        $data = array(
            'title' => '修改广告',
            'action' => 'mod',
        );
        $data['ad'] = $this->ad_model->detail($id);
        $data['adcats'] = $this->ad_model->adcat();
        $this->load->view('ad_form', $data);
    }

    public function del()
    {
        $id = intval($_GET['id']);
        if(!$id){
            show_error('ID不能为空','-1');
        }
        $this->ad_model->del($id);
        redirect(site_url('ad/index'));
    }

    public function cat()
    {
        $data = array(
            'title' => '广告分类',
        );
        $sql = 'SELECT * FROM ad_cat';
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $adcats = array();
        foreach ($res as $row){
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $adcats[] = $row;
        }
        $data['adcats'] = $adcats;
        $this->load->view('ad_cat_index',$data);
    }

}