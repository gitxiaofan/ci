<?php
include 'Common.php';

class Memorial extends Common
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('memorial_model');
        $this->load->model('user_model');
    }

    /*
     * 纪念馆管理
     */
    public function index()
    {
        $data = array(
            'title' => '纪念馆列表',
        );
        $per_page = 20;
        $limit = (intval(isset($_GET['per_page']) ? $_GET['per_page'] : 1) - 1) * $per_page;
        $sql = 'SELECT * FROM memorial WHERE 1 '. $this->condition(). ' ORDER BY id DESC LIMIT '. $limit. ','. $per_page;
        $query = $this->db->query($sql);
        $memorials = array();
        foreach($query->result_array() as $row){
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $user = $this->user_model->detail($row['user_id']);
            if($user){
                $row['author'] = $user['nickname'];
            }else{
                $row['author'] = '';
            }
            $images = $this->memorial_model->images($row['id']);
            if($images){
                $row['images'] = $images;
            }
            $memorials[] = $row;
        }
        $data['memorials'] = $memorials;
        $data['pagination'] = $this->page(site_url('memorial/index'),$this->count(),$per_page);
        $this->load->view('memorial_index',$data);
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
        $sql = 'SELECT count(*) count FROM memorial WHERE 1 '. $this->condition();
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res[0]['count'];
    }

    public function add()
    {
        $data = array(
            'title' => '添加纪念馆',
            'action' => 'add',
        );
        if (isset($_POST)&&$_POST){
            if (empty($_POST['name'])){
                show_error('姓名不能为空！','-1');
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
            $this->memorial_model->add($params);
            redirect(site_url('memorial/index'));
        }
        $this->load->view('memorial_form', $data);
    }

    public function mod()
    {
        $data = array(
            'title' => '编辑纪念馆',
            'action' => 'mod',
        );
        if (!$_GET['id']){
            show_error('ID不能为空','-1');
        }
        $id = intval($_GET['id']);
        $data['id'] = $id;
        if (isset($_POST)&&$_POST){
            if (empty($_POST['name'])){
                show_error('姓名不能为空！','-2');
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

    public function avater()
    {
        $data = array(
            'title' => '添加照片',
        );
        if(isset($_POST) && $_POST){
            if(!$id = $_POST['id']){
                show_error('id不能为空','-1');
            }
            if(!$img = $_POST['img']){
                show_error('图片不能为空','-2');
            }
            if(!$pic = $this->upload_img64($img,'memorial')){
                show_error('上传失败','-3');
            }
            $sql = 'INSERT INTO memorial_image SET pic="'. $pic. '", memorial_id='. $id. ', ctime='. time();
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
        $data['module'] = 'memorial';
        $data['ratio'] = 1.618;
        $this->load->view('avater', $data);
    }

    public function avater_delete()
    {
        if (!$id = intval($_GET['image_id'])){
            show_error('ID不能为空','-1');
        }
        $this->memorial_model->image_delete($id);
        redirect(site_url('memorial/index'));

    }

    public function upload_img()
    {
        if($_FILES){
            $file = $this->do_upload('file','memorial_content');
            $pic = '/uploads/memorial_content/'. $file['file_name'];
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
}