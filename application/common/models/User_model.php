<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($data)
    {
        if (!$data){
            return false;
        }
        $sql = 'INSERT INTO user SET ';
        foreach ($data as $k => $val){
            $sql .= " $k = '$val',";
        }
        $sql = rtrim($sql, ',');
        return $this->db->query($sql);
    }

    public function mod($id,$data)
    {
        if (!$id || !$data){
            return false;
        }
        $sql = 'UPDATE user SET ';
        foreach ($data as $k => $val){
            $sql .= " $k = '$val',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ' WHERE user_id = '. $id;
        return $this->db->query($sql);
    }

    public function detail($id)
    {
        if (!$id){
            return false;
        }
        $sql = 'SELECT * FROM user WHERE user_id = '. $id;
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        return $ret[0];
    }

    public function del($id)
    {
        if (!$id){
            return false;
        }
        $sql = 'DELETE FROM user WHERE user_id IN ('. $id. ')';
        return $this->db->query($sql);
    }

    public function mobile_unique($mobile,$id=0)
    {
        $sql = 'SELECT * FROM user WHERE mobile="'. $mobile. '"';
        if($id){
            $sql .= ' AND user_id !='. $id;
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}