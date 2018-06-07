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
        $sql = 'SELECT id,name,is_strong FROM memorial WHERE 1 '. $this->condition(). ' ORDER BY stick DESC, id DESC LIMIT 40';
        $query = $this->db->query($sql);
        $data['memorials'] = $query->result_array();
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

}
