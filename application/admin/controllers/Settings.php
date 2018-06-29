<?php
include 'Common.php';

class Settings extends Common {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ad_model');
    }

    /**
     * 常规设置
     */
    public function index()
    {
        $data = array(
            'title' => '常规设置',
        );
        if(isset($_POST) && $_POST){
            foreach($_POST as $k => $val){
                $sql = 'INSERT INTO settings SET name="'. $k. '", value="'. $val. '" on duplicate key update value="'. $val. '"';
                $this->db->query($sql);
            }
        }
        $sql = 'SELECT * FROM settings';
        $query = $this->db->query($sql);
        foreach($query->result_array() as $row){
            $settings[$row['name']] = $row['value'];
        }
        $settings['adcats'] = $this->ad_model->adcat();
        $sql = 'SELECT * FROM page ORDER BY id DESC';
        $query = $this->db->query($sql);
        $pages = array();
        foreach ($query->result_array() as $row){
            $pages[$row['id']] = $row['title'];
        }
        $settings['pages'] = $pages;
        $data['settings'] = $settings;
        $this->load->view('settings_index',$data);
    }

    /*
     * 短信设置
     */
    public function sms()
    {
        $data = array(
            'title' => '短信设置',
        );
        if(isset($_POST) && $_POST){
            foreach($_POST as $k => $val){
                $sql = 'INSERT INTO settings SET name="'. $k. '", value="'. $val. '", autoload=0 on duplicate key update value="'. $val. '"';
                $this->db->query($sql);
            }
        }
        $sql = 'SELECT * FROM settings';
        $query = $this->db->query($sql);
        foreach($query->result_array() as $row){
            $settings[$row['name']] = $row['value'];
        }
        $data['settings'] = $settings;
        $this->load->view('settings_sms',$data);
    }


}
