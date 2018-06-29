<?php
include 'Common.php';

class Page extends Common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function detail()
    {
        if(!$_GET['id']){
            show_error('页面ID不能为空');
        }
        $id = $_GET['id'];
        $sql = 'SELECT * FROM page WHERE id='.$id;
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $page = $res[0];
        $data['page'] = $page;
        $this->view('page_detail',$data);
    }
}