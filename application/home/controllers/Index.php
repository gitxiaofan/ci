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

		$data['sliders'] = $this->slider($this->settings['homeslider']);
        $this->view('index_index',$data);
	}


}
