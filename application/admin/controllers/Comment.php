<?php
include 'Common.php';

class Comment extends Common
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('comment_model');
    }

    public function index()
    {
        $sql = 'SELECT c.*,u.nickname as u_name,m.name as m_name FROM comment c LEFT JOIN user u ON u.user_id = c.user_id LEFT JOIN memorial m ON m.id = c.memorial_id';
        $q = $this->db->query($sql);
        $res = $q->result_array();
        $comments = array();
        foreach($res as $row){
            $row['ctime'] = date('Y-m-d H:i:s',$row['ctime']);
            $comments[] = $row;
        }

        $data['comments'] = $comments;
        $this->load->view('comment_index',$data);
    }

    public function del()
    {
        $id = intval($_GET['id']);
        if(!$id){
            show_error('ID不能为空','-1');
        }
        $sql = 'DELETE FROM comment WHERE id IN ('. $id. ')';
        $this->db->query($sql);
        redirect(site_url('comment/index'));
    }

}