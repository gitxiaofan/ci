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
        $data['memorial']['birthday'] = empty($data['memorial']['birthday']) ? '':date('Y年m月d日',strtotime($data['memorial']['birthday']));
        $data['memorial']['death'] = empty($data['memorial']['death']) ? '':date('Y年m月d日',strtotime($data['memorial']['death']));
        $data['memorial']['name'] = htmlspecialchars_decode($data['memorial']['name']);
        $data['memorial']['brief'] = htmlspecialchars_decode($data['memorial']['brief']);
        $data['memorial']['epitaph'] = htmlspecialchars_decode($data['memorial']['epitaph']);
        $data['images'] = $this->memorial_model->images($id);
        $sql = 'SELECT * FROM sacrifice ORDER BY sort ASC';
        $query = $this->db->query($sql);
        $gifts = array();
        foreach ($query->result_array() as $row){
            $sql = 'SELECT sum(`number`) as total FROM sacrifice_info WHERE memorial_id='.$id. ' AND sacrifice_id='.$row['id'];
            $query = $this->db->query($sql);
            $res = $query->result_array();
            if(!$res){
                continue;
            }
            $row['total'] = $res[0]['total'];
            $gifts[] = $row;
        }
        $data['gifts'] = $gifts;
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
        $data['memorial']['birthday'] = empty($data['memorial']['birthday']) ? '':date('Y年m月d日',strtotime($data['memorial']['birthday']));
        $data['memorial']['death'] = empty($data['memorial']['death']) ? '':date('Y年m月d日',strtotime($data['memorial']['death']));
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
            $sql = 'SELECT * FROM sacrifice_info WHERE memorial_id='.$memorial_id. ' AND user_id='.$user_id. ' LIMIT 1';
            $query = $this->db->query($sql);
            if(!$query->result_array()){
                $sql = 'UPDATE memorial SET sacrifice_num = sacrifice_num + 1 WHERE id='.$memorial_id;
                $this->db->query($sql);
            }
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
        $data['memorial']['birthday'] = empty($data['memorial']['birthday']) ? '':date('Y年m月d日',strtotime($data['memorial']['birthday']));
        $data['memorial']['death'] = empty($data['memorial']['death']) ? '':date('Y年m月d日',strtotime($data['memorial']['death']));
        $data['images'] = $this->memorial_model->images($id);
        $sql = 'SELECT * FROM sacrifice WHERE status = 1 ORDER BY sort ASC';
        $query = $this->db->query($sql);
        $data['sacrifices'] = $query->result_array();
        $sql = 'SELECT si.*,u.nickname,s.name as sacrifice_name FROM sacrifice_info si LEFT JOIN user u ON si.user_id = u.user_id LEFT JOIN sacrifice s ON si.sacrifice_id = s.id WHERE memorial_id = '.$id. ' ORDER BY id DESC LIMIT 20';
        $query = $this->db->query($sql);
        $data['gifts'] = $query->result_array();
        $this->view('memorial_sacrifice',$data);
    }

    public function gifts()
    {
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        $size = empty($_GET['size']) ? 20 : intval($_GET['size']);
        $page = empty($_GET['page']) ? 1 : intval($_GET['page']);
        $limit = ($page - 1) * $size;
        $sql = 'SELECT si.*,u.nickname,s.name as sacrifice_name FROM sacrifice_info si LEFT JOIN user u ON si.user_id = u.user_id LEFT JOIN sacrifice s ON si.sacrifice_id = s.id WHERE memorial_id = '.$id. ' ORDER BY id DESC LIMIT '. $limit. ','. $size;
        $query = $this->db->query($sql);
        $data = array();
        foreach ($query->result_array() as $row){
            $row['ctime'] = date('Y-m-d H:i:s', $row['ctime']);
            $data[] = $row;
        }
        $this->output($data);
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
        $size = empty($_GET['size']) ? 20 : intval($_GET['size']);
        $page = empty($_GET['page']) ? 1 : intval($_GET['page']);
        $limit = ($page - 1) * $size;
        $sql = 'SELECT c.*,u.nickname FROM comment c LEFT JOIN user u ON c.user_id = u.user_id WHERE c.memorial_id='.$id. ' ORDER BY id DESC LIMIT '. $limit. ','. $size;
        $query = $this->db->query($sql);
        $comments = array();
        foreach ($query->result_array() as $row){
            $row['ctime'] = date('Y-m-d', $row['ctime']);
            $comments[] = $row;
        }
        //判断ajax请求
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest"){
            $this->output($comments);
        }
        $data['comments'] = $comments;
        $data['memorial'] = $this->memorial_model->detail($id);
        $data['memorial']['birthday'] = empty($data['memorial']['birthday']) ? '':date('Y年m月d日',strtotime($data['memorial']['birthday']));
        $data['memorial']['death'] = empty($data['memorial']['death']) ? '':date('Y年m月d日',strtotime($data['memorial']['death']));
        $data['images'] = $this->memorial_model->images($id);
        if (!empty($_SESSION['user']['user_id'])){
            $data['follow_status'] = $this->memorial_model->follow($id,$_SESSION['user']['user_id']);
        }
        $this->view('memorial_comment',$data);
    }

    public function delComment()
    {
        $this->checklogin();
        $user_id = $_SESSION['user']['user_id'];
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空','-1');
        }
        $sql = 'DELETE FROM comment WHERE id='.$id.' AND user_id='.$user_id;
        if($this->db->query($sql)){
            echo 'true';
            exit;
        }
        echo 'false';
        exit;
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
            $params['user_id'] = $_SESSION['user']['user_id'];
            $params['brief'] = $_POST['brief'] ? htmlspecialchars($_POST['brief']) : '';
            $params['birthday'] = $_POST['birthday'] ? $_POST['birthday'] : '';
            $params['death'] = $_POST['death'] ? $_POST['death'] : '';
            $params['epitaph'] = $_POST['epitaph'] ? htmlspecialchars($_POST['epitaph']) : '';
            $params['is_strong'] = intval($_POST['is_strong']) == 1 ? 1 : 0;
            $params['stick'] = intval($_POST['stick']) == 1 ? 1 : 0;
            $params['content'] = $_POST['content'] ? htmlspecialchars($_POST['content']) : '';
            $params['ctime'] = time();
            $id = $this->memorial_model->add($params);
            if($id && $_POST['pic']){
                $time = time();
                $sql = 'INSERT INTO memorial_image(pic,memorial_id,ctime) VALUES';
                foreach($_POST['pic'] as $pic){
                    $sql .= "('$pic',$id,$time),";
                }
                $sql = rtrim($sql,',');
                $this->db->query($sql);
            }
            if($id){
                $sql = 'INSERT INTO memorial_follow SET memorial_id='. $id. ', user_id='. $params['user_id']. ', status=1';
                $this->db->query($sql);
            }
            redirect(site_url('memorial/detail'). '?id='.$id);
        }
        $this->view('memorial_form', $data);
    }

    public function avater()
    {
        $return = array();
        if(isset($_POST) && $_POST){
            if(!$img = $_POST['img']){
                $this->output(array(status=>-1, 'message'=>'图片不能为空'));
            }
            if($pic = $this->upload_img64($img,'memorial')){
                $return = array('status'=>1,'message'=>'上传成功','pic'=>$pic);
            }else{
                $return = array('status'=>0,'message'=>'上传失败');
            }
            $this->output($return);
        }
        $this->output($return);
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

    public function manage()
    {
        $this->checklogin();
        $user_id = $_SESSION['user']['user_id'];
        $size = empty($_GET['size']) ? 6 : intval($_GET['size']);
        $page = empty($_GET['page']) ? 1 : intval($_GET['page']);
        $limit = ($page - 1) * $size;
        $sql = 'SELECT * FROM memorial WHERE user_id = '. $user_id. ' ORDER BY id DESC LIMIT '.$limit. ','.$size;
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $memorials = array();
        foreach ($res as $row){
            $images = $this->memorial_model->images($row['id']);
            if($images){
                $row['image'] = $images[0]['pic'];
            }
            $memorials[] = $row;
        }
        //判断ajax请求
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest"){
            $this->output($memorials);
        }
        $data['memorials'] = $memorials;
        $this->view('memorial_manage',$data);
    }

    public function mod()
    {
        $this->checklogin();
        $user_id = $_SESSION['user']['user_id'];
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空');
        }
        $sql = 'SELECT * FROM memorial WHERE id = '. $id. ' AND user_id = '.$user_id;
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        $memorial = $ret[0];
        if(!$memorial){
            show_error('无法找到纪念馆');
        }
        if(isset($_POST) && $_POST){
            $params = array();
            $params['name'] = htmlspecialchars($_POST['name']);
            $params['user_id'] = $user_id;
            $params['brief'] = $_POST['brief'] ? htmlspecialchars($_POST['brief']) : '';
            $params['birthday'] = $_POST['birthday'] ? $_POST['birthday'] : '';
            $params['death'] = $_POST['death'] ? $_POST['death'] : '';
            $params['epitaph'] = $_POST['epitaph'] ? htmlspecialchars($_POST['epitaph']) : '';
            $params['is_strong'] = intval($_POST['is_strong']) == 1 ? 1 : 0;
            $params['stick'] = intval($_POST['stick']) == 1 ? 1 : 0;
            $params['content'] = $_POST['content'] ? htmlspecialchars($_POST['content']) : '';
            $params['ctime'] = time();
            $this->memorial_model->mod($id,$params);
            $sql = 'DELETE FROM memorial_image WHERE memorial_id='. $id;
            $this->db->query($sql);
            $time = time();
            $sql = 'INSERT INTO memorial_image(pic,memorial_id,ctime) VALUES';
            foreach($_POST['pic'] as $pic){
                $sql .= "('$pic',$id,$time),";
            }
            $sql = rtrim($sql,',');
            $this->db->query($sql);
            redirect(site_url('memorial/detail'). '?id='.$id);
        }
        $data['memorial'] = $memorial;
        $data['images'] = $this->memorial_model->images($id);
        $this->view('memorial_form',$data);
    }
    public function delete()
    {
        $this->checklogin();
        $user_id = $_SESSION['user']['user_id'];
        $id = intval($_GET['id']);
        if (!$id){
            show_error('ID不能为空');
        }
        $sql = 'SELECT * FROM memorial WHERE id = '. $id. ' AND user_id = '.$user_id;
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        $memorial = $ret[0];
        if(!$memorial){
            show_error('无法找到纪念馆');
        }
        $this->memorial_model->del($id);
        redirect(site_url('memorial/manage'));
    }

    public function myfollow()
    {
        $this->checklogin();
        $user_id = $_SESSION['user']['user_id'];
        $sql = 'SELECT m.* FROM memorial_follow mf LEFT JOIN memorial m ON mf.memorial_id=m.id WHERE mf.user_id='.$user_id. ' AND mf.status=1';
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $memorials = array();
        foreach ($res as $row){
            $images = $this->memorial_model->images($row['id']);
            if($images){
                $row['images'] = $images;
            }
            $memorials[] = $row;
        }
        $data['memorials'] = $memorials;
        $this->view('memorial_follow',$data);
    }
}
