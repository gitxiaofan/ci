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
        $data = array(
            'title' => '追思列表',
        );
        $per_page = 20;
        $limit = (intval(isset($_GET['per_page']) ? $_GET['per_page'] : 1) - 1) * $per_page;
        $sql = 'SELECT c.*,u.nickname as u_name,m.name as m_name FROM comment c LEFT JOIN user u ON u.user_id = c.user_id LEFT JOIN memorial m ON m.id = c.memorial_id WHERE 1 '. $this->condition(). ' ORDER BY c.id DESC LIMIT '. $limit. ','. $per_page;;
        $q = $this->db->query($sql);
        $res = $q->result_array();
        $comments = array();
        foreach($res as $row){
            $row['ctime'] = date('Y-m-d H:i:s',$row['ctime']);
            $comments[] = $row;
        }
        $data['comments'] = $comments;
        $data['pagination'] = $this->page(site_url('comment/index'),$this->count(),$per_page);
        $this->load->view('comment_index',$data);
    }

    public function condition()
    {
        $condition = '';
        if(!empty($_GET['k'])){
            $condition .= 'AND m.name LIKE "%'.$_GET['k'].'%" ';
        }
        return $condition;
    }

    public function count()
    {
        $sql = 'SELECT count(*) count FROM comment c LEFT JOIN memorial m ON m.id = c.memorial_id WHERE 1 '. $this->condition();
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res[0]['count'];
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