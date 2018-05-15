<?php
include 'Common.php';

class Home extends Common {

    public function __construct()
    {
        parent::__construct();
    }

    /**
	 * 后台管理首页
	 */
	public function index()
	{
		$this->load->view('home_index');
	}

	public function show()
    {
        $this->load->view('home_show');
    }

}
