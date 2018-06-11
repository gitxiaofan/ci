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
            $memorial_id = $_POST['id'];
            $user_id = 9;
            $time = time();
            $sql = 'INSERT INTO sacrifice_info(user_id,sacrifice_id,memorial_id,ctime) VALUES';
            foreach($_POST['sacrifice'] as $sacrifice){
                $sql .= "($user_id,$sacrifice,$memorial_id,$time),";
            }
            $sql = rtrim($sql,',');
            $this->db->query($sql);
        }
        $data['memorial'] = $this->memorial_model->detail($id);
        $data['images'] = $this->memorial_model->images($id);
        $sql = 'SELECT * FROM sacrifice WHERE status = 1 ORDER BY sort ASC';
        $query = $this->db->query($sql);
        $data['sacrifices'] = $query->result_array();
        $sql = 'SELECT si.*,u.nickname,s.name FROM sacrifice_info si LEFT JOIN user u ON si.user_id = u.user_id LEFT JOIN sacrifice s ON si.sacrifice_id = s.id WHERE memorial_id = '.$id. ' ORDER BY ctime DESC';
        $query = $this->db->query($sql);
        $res = $query->result_array();
        
        $this->view('memorial_sacrifice',$data);
    }


}
