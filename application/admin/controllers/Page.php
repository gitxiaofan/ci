<?php
include 'Common.php';

class Page extends Common
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('page_model');
    }

    /*
     * 页面
     */
    public function index()
    {
        $data = array(
            'title' => '页面',
        );
        $per_page = 20;
        $limit = (intval(isset($_GET['per_page']) ? $_GET['per_page'] : 1) - 1) * $per_page;
        $sql = 'SELECT * FROM page WHERE 1 '. $this->condition(). ' ORDER BY id DESC LIMIT '. $limit. ','. $per_page;
        $query = $this->db->query($sql);
        $pages = array();
        foreach($query->result_array() as $row){
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $pages[] = $row;
        }
        $data['pages'] = $pages;
        $data['pagination'] = $this->page(site_url('page/index'),$this->count(),$per_page);
        $this->load->view('page_index',$data);
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
        $sql = 'SELECT count(*) count FROM page WHERE 1 '. $this->condition();
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res[0]['count'];
    }

    public function add()
    {
        $data = array(
            'title' => '添加页面'
        );
        if (isset($_POST) && $_POST){
            if(!$title = $_POST['title']){
                show_error('页面标题不能为空');
            }
            $params = array();
            $params['title'] = htmlspecialchars($title);
            $params['content'] = htmlspecialchars($_POST['content']);
            $params['ctime'] = time();
            $this->page_model->add($params);
            redirect('page/index');
        }

        $this->load->view('page_form',$data);
    }

    public function mod()
    {
        $data = array(
            'title' => '编辑页面',
            'action' => 'mod',
        );
        if (!$_GET['id']){
            show_error('ID不能为空','-1');
        }
        $id = intval($_GET['id']);
        $data['id'] = $id;
        if(isset($_POST) && $_POST){
            if(!$title = $_POST['title']){
                show_error('页面标题不能为空');
            }
            $params = array();
            $params['title'] = htmlspecialchars($title);
            $params['content'] = htmlspecialchars($_POST['content']);
            $this->page_model->mod($id,$params);
            redirect('page/index');
        }
        $page = $this->page_model->detail($id);
        $page['title'] = htmlspecialchars_decode($page['title']);
        $page['content'] = htmlspecialchars_decode($page['content']);
        $data['page'] = $page;
        $this->load->view('page_form',$data);
    }

    public function upload_img()
    {
        if($_FILES){
            $file = $this->do_upload('file','page');
            $pic = '/uploads/page/'. $file['file_name'];
            $return = array(
                'success' => true,
                'file_path' => $pic,
            );
            echo json_encode($return);
            exit;
        }
        $return = array(
            'success' => false
        );
        echo json_encode($return);
        exit;
    }

    public function del()
    {
        $data = array(
            'title' => '删除页面',
            'action' => 'del',
        );
        if (!$_GET['id']){
            show_error('ID不能为空','-1');
        }
        $id = intval($_GET['id']);
        $sql = 'DELETE FROM page WHERE id='.$id;
        $this->db->query($sql);
        redirect('page/index');
    }
}