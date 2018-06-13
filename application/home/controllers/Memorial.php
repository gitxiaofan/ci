<?php
include 'Common.php';

class memorial extends Common {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('memorial_model');
        $this->load->model('user_model');
    }

    public function index()
    {

    }

    public function condition()
    {

    }

    public function detail()
    {
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        if (!empty($_SESSION['user']['user_id'])){
            $data['follow_status'] = $this->memorial_model->follow($id,$_SESSION['user']['user_id']);
        }
        $sql = 'SELECT * FROM memorial WHERE id = '. $id;
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        $data['memorial'] = $ret[0];
        $birthday = explode('-',$data['memorial']['birthday']);
        $data['memorial']['birthday'] = $birthday[0].'年'.$birthday[1].'月'.$birthday[2].'日';
        $death = explode('-',$data['memorial']['death']);
        $data['memorial']['death'] = $death[0].'年'.$death[1].'月'.$death[2].'日';
        $data['memorial']['name'] = htmlspecialchars_decode($data['memorial']['name']);
        $data['memorial']['brief'] = htmlspecialchars_decode($data['memorial']['brief']);
        $data['memorial']['epitaph'] = htmlspecialchars_decode($data['memorial']['epitaph']);
        $data['images'] = $this->memorial_model->images($id);
        $this->view('memorial_detail',$data);
    }

    public function content()
    {
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        if (!empty($_SESSION['user']['user_id'])){
            $data['follow_status'] = $this->memorial_model->follow($id,$_SESSION['user']['user_id']);
        }
        $data['memorial'] = $this->memorial_model->detail($id);
        $birthday = explode('-',$data['memorial']['birthday']);
        $data['memorial']['birthday'] = $birthday[0].'年'.$birthday[1].'月'.$birthday[2].'日';
        $death = explode('-',$data['memorial']['death']);
        $data['memorial']['death'] = $death[0].'年'.$death[1].'月'.$death[2].'日';
        $data['memorial']['name'] = htmlspecialchars_decode($data['memorial']['name']);
        $data['memorial']['brief'] = htmlspecialchars_decode($data['memorial']['brief']);
        $data['memorial']['epitaph'] = htmlspecialchars_decode($data['memorial']['epitaph']);
        $data['memorial']['content'] = htmlspecialchars_decode($data['memorial']['content']);
        $data['images'] = $this->memorial_model->images($id);
        $this->view('memorial_content',$data);
    }

    public function sacrifice()
    {
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        if(isset($_POST) && !empty($_POST['sacrifice'])){
            $this->checklogin();
            $memorial_id = intval($_POST['id']);
            $user_id = $_SESSION['user']['user_id'];
            $time = time();
            $sql = 'INSERT INTO sacrifice_info(user_id,sacrifice_id,memorial_id,ctime) VALUES';
            foreach($_POST['sacrifice'] as $sacrifice){
                $sql .= "($user_id,$sacrifice,$memorial_id,$time),";
            }
            $sql = rtrim($sql,',');
            $this->db->query($sql);
        }
        if (!empty($_SESSION['user']['user_id'])){
            $data['follow_status'] = $this->memorial_model->follow($id,$_SESSION['user']['user_id']);
        }
        $data['memorial'] = $this->memorial_model->detail($id);
        $data['images'] = $this->memorial_model->images($id);
        $sql = 'SELECT * FROM sacrifice WHERE status = 1 ORDER BY sort ASC';
        $query = $this->db->query($sql);
        $data['sacrifices'] = $query->result_array();
        $sql = 'SELECT si.*,u.nickname,s.name as sacrifice_name FROM sacrifice_info si LEFT JOIN user u ON si.user_id = u.user_id LEFT JOIN sacrifice s ON si.sacrifice_id = s.id WHERE memorial_id = '.$id. ' ORDER BY ctime DESC';
        $query = $this->db->query($sql);
        $data['gifts'] = $query->result_array();
        $this->view('memorial_sacrifice',$data);
    }

    public function comment()
    {
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        if (isset($_POST) && !empty($_POST)){
            $this->checklogin();
            $memorial_id = intval($_POST['id']);
            $user_id = $_SESSION['user']['user_id'];
            $content = htmlspecialchars($_POST['content']);
            $ctime = time();
            $sql = 'INSERT INTO comment SET memorial_id='.$memorial_id. ',user_id='.$user_id. ',content="'. $content. '", ctime='. $ctime;
            $this->db->query($sql);
        }
        if (!empty($_SESSION['user']['user_id'])){
            $data['follow_status'] = $this->memorial_model->follow($id,$_SESSION['user']['user_id']);
        }
        $sql = 'SELECT c.*,u.nickname FROM comment c LEFT JOIN user u ON c.user_id = u.user_id WHERE c.memorial_id='.$id. ' ORDER BY id DESC';
        $query = $this->db->query($sql);
        $data['comments'] = $query->result_array();
        $data['memorial'] = $this->memorial_model->detail($id);
        $data['images'] = $this->memorial_model->images($id);
        $this->view('memorial_comment',$data);
    }

    public function follow()
    {
        $return = array('status' => 0);
        $id = intval($_GET['id']);
        if (!$id){
            $return['status'] = -1;
            $return['message'] = 'ID不能为空';
            $this->output($return);
        }
        if (empty($_SESSION['user']['user_id'])){
            $return['status'] = -2;
            $return['message'] = '用户未登录';
            $this->output($return);
        }
        $user_id = $_SESSION['user']['user_id'];
        $status = intval($_GET['status']);
        if($return['status'] == 0){
            $sql = 'INSERT INTO memorial_follow SET memorial_id='. $id. ', user_id='. $user_id. ', status='. $status. ' ON duplicate key update status='.$status;
            if($this->db->query($sql)){
                $return['status'] = 1;
                $return['message'] = '修改成功';
            }else{
                $return['status'] = 0;
                $return['message'] = '修改失败';
            }
        }

        $this->output($return);
    }

    public function add()
    {
        $this->checklogin();
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
            $id = $this->memorial_model->add($params);
            redirect(site_url('memorial/avaterlist'). '?id='. $id);
        }
        $this->view('memorial_form', $data);
    }

    public function avaterlist()
    {
        $data = array(
            'title' => '添加图片',
        );
        $this->view('memorial_avater', $data);
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
