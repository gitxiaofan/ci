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
        $data['memorial'] = $this->memorial_model->detail($id);
        $birthday = explode('-',$data['memorial']['birthday']);
        $data['memorial']['birthday'] = $birthday[0].'年'.$birthday[1].'月'.$birthday[2].'日';
        $death = explode('-',$data['memorial']['death']);
        $data['memorial']['death'] = $death[0].'年'.$death[1].'月'.$death[2].'日';
        $data['images'] = $this->memorial_model->images($id);
        $this->view('memorial_detail',$data);
    }
}
