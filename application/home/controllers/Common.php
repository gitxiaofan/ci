<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {
    public $settings;

    public function __construct()
    {
        parent::__construct();
        $this->settings = $this->settings();
        //$this->checklogin();
    }

    public function view($tpl,$data=array())
    {
        $outdata['settings'] = $this->settings;
        $outdata['data'] = $data;
        $this->load->view($tpl,$outdata);
    }

    public function settings()
    {
        $settings = array();
        $sql = 'SELECT * FROM settings WHERE autoload=1';
        $query = $this->db->query($sql);
        foreach($query->result_array() as $row){
            $settings[$row['name']] = $row['value'];
        }
        return $settings;
    }

    public function slider($adcat)
    {
        $return = array();
        $sql = 'SELECT * FROM ad WHERE cat_id='. $adcat. ' ORDER BY sort ASC';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row){
            $row['pic'] = base_url().$row['pic'];
            $return[] = $row;
        }
        return $return;
    }

    public function checklogin()
    {
        if ($_SESSION['user'] && $_SESSION['user']['user_id']){
            return true;
        }
        redirect(site_url('login/index'));
    }

    public function do_upload($file,$dir)
    {
        $config['upload_path']      = './uploads/'.$dir;
        $config['allowed_types']    = 'gif|jpg|png';
        $config['file_name'] = time().mt_rand(100,999);

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($file))
        {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
        else
        {
            return $this->upload->data();
        }
    }

    public function upload_img64($img,$dir)
    {
        $base64_img = trim($img);
        $up_dir = './uploads/'.$dir.'/';

        if(!file_exists($up_dir)){
            mkdir($up_dir,0755);
        }

        if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
            $type = $result[2];
            if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){
                $new_file = $up_dir.time().mt_rand(100,999).'.'.$type;
                if(file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_img)))){
                    $img_path = str_replace('./', '', $new_file);
                    return $img_path;
                }else{
                    return false;

                }
            }else{
                //文件类型错误
                return false;
            }

        }else{
            //文件错误
            return false;
        }
        return false;
    }

    public function page($base_url,$total_rows,$per_page=20)
    {
        $this->load->library('pagination');
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '末页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '<span><i class="fa fa-chevron-right"></i></span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span><i class="fa fa-chevron-left"></i></span>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['reuse_query_string'] = true;

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function input($name)
    {
        if($_GET[$name]){
            return $_GET[$name];
        }elseif($_POST[$name]){
            return $_POST[$name];
        }else{
            return '';
        }
    }

    public function output($data){
        echo json_encode($data);
        exit;
    }

    /**
     * 产生随机数串
     * @param integer $len 随机数字长度
     * @return string
     */
    public function randomKeys($length = 6)
    {
        $key='';
        $pattern='1234567890';
        for($i=0;$i<$length;++$i) {
            $key .= $pattern{mt_rand(0,9)};    // 生成php随机数
        }
        return $key;
    }

    /*
     * 发送短信
     */
    public function luosimao($mobile,$code)
    {
        $sql = 'SELECT * FROM settings WHERE name LIKE "sms_lsm_%"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row){
            switch ($row['name']){
                case 'sms_lsm_key':
                    $luosimao_key = $row['value'];
                    break;
                case 'sms_lsm_tpl':
                    $tpl = $row['value'];
                    break;
            }
        }
        if (!$luosimao_key || !$tpl){
            return false;
        }
        $message = str_replace('{code}',$code,$tpl);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

        curl_setopt($ch, CURLOPT_HTTP_VERSION  , CURL_HTTP_VERSION_1_0 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-'.$luosimao_key);

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $mobile,'message' => $message));

        $res = curl_exec( $ch );
        curl_close( $ch );
        //$res  = curl_error( $ch );
        $res = json_decode($res,true);
        if ($res['error'] == 0 && $res['msg'] == 'ok'){
            return true;
        }
        return false;
    }
}