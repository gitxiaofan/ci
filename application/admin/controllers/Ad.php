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
        $per_page = 20;
        $limit = (intval(isset($_GET['per_page']) ? $_GET['per_page'] : 1) - 1) * $per_page;
        $sql = 'SELECT * FROM ad WHERE 1 '. $this->condition(). ' ORDER BY id DESC LIMIT '. $limit. ','. $per_page;
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
        $data['pagination'] = $this->page(site_url('ad/index'),$this->count(),$per_page);
        $this->load->view('ad_index',$data);
    }

    public function condition()
    {
        $condition = '';
        if(!empty($_GET['k'])){
            $condition .= 'AND title LIKE "%'.$_GET['k'].'%" ';
        }
        return $condition;
    }

    public function count()
    {
        $sql = 'SELECT count(*) count FROM ad WHERE 1 '. $this->condition();
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res[0]['count'];
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
            $params['link'] = htmlspecialchars($_POST['link']);
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
        $data = array(
            'title' => '修改广告',
            'action' => 'mod',
        );
        $id = intval($_GET['id']);
        if(!$id){
            show_error('ID不能为空','-1');
        }
        $data['id'] = $id;
        if(isset($_POST) && $_POST){
            $params = array();
            $params['title'] = htmlspecialchars($_POST['title']);
            $params['link'] = htmlspecialchars($_POST['link']);
            $params['cat_id'] = intval($_POST['cat_id']);
            $params['sort'] = intval($_POST['sort']);
            if(!empty($_FILES['pic']['tmp_name'])){
                $file = $this->do_upload('pic','ad');
                $params['pic'] = 'uploads/ad/'. $file['file_name'];
            }
            $this->ad_model->mod($id,$params);
            redirect(site_url('ad/index'));
        }
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
        $sql = 'SELECT * FROM ad_cat ORDER BY id DESC';
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

    public function addcat()
    {
        $data = array(
            'title' => '添加分类',
            'action' => 'add'
        );
        if(isset($_POST) && $_POST){
            if(!$name = $_POST['name']){
                show_error('分类标题不能为空');
            }
            $time = time();
            $sql = 'INSERT INTO ad_cat SET name="'. $name. '", ctime='.$time;
            $this->db->query($sql);
            redirect('ad/cat');
        }
        $this->load->view('ad_cat_form',$data);
    }

    public function modcat()
    {
        $data = array(
            'title' => '添加分类',
            'action' => 'mod'
        );
        if(!$_GET['id']){
            show_error('ID不能为空');
        }
        $id = intval($_GET['id']);
        if(isset($_POST) && $_POST){
            if(!$name = $_POST['name']){
                show_error('分类标题不能为空');
            }
            $sql = 'UPDATE ad_cat SET name="'. $name. '" WHERE id='.$id;
            $this->db->query($sql);
            redirect('ad/cat');
        }
        $sql = 'SELECT * FROM ad_cat WHERE id='.$id;
        $q = $this->db->query($sql);
        $res = $q->result_array();
        $data['adcat'] = $res[0];
        $this->load->view('ad_cat_form',$data);
    }

    public function delcat()
    {
        $data = array(
            'title' => '删除分类'
        );
        if(!$_GET['id']){
            show_error('ID不能为空');
        }
        $id = intval($_GET['id']);
        $sql = 'DELETE FROM ad_cat WHERE id='.$id;
        $this->db->query($sql);
        redirect('ad/cat');
    }


}