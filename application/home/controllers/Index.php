<?php
include 'Common.php';

class Index extends Common {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
	    $data = array(
	        'title' => '首页'
        );
        $size = empty($_GET['size']) ? 40 : intval($_GET['size']);
        $page = empty($_GET['page']) ? 1 : intval($_GET['page']);
        $limit = ($page - 1) * $size;
        $sql = 'SELECT id,name,birthday,death,is_strong FROM memorial WHERE 1 '. $this->condition(). ' ORDER BY stick DESC, sacrifice_num DESC, id DESC LIMIT '. $limit. ','. $size;
        $query = $this->db->query($sql);
        $memorials = array();
        foreach ($query->result_array() as $row){
            $row['birthday'] = date('Y年m月d日',strtotime($row['birthday']));
            $row['death'] = date('Y年m月d日',strtotime($row['death']));
            $memorials[] = $row;
        }
        //判断ajax请求
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest"){
            $this->output($memorials);
        }
        $data['memorials'] = $memorials;
		$data['sliders'] = $this->slider($this->settings['homeslider']);
        $this->view('index_index',$data);
	}

	public function condition()
    {
        $condition = '';
        if(isset($_GET['k'])){
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

}
