<?php

class Admin_model extends CI_Model
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
        $sql = 'INSERT INTO admin SET ';
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
        $sql = 'UPDATE admin SET ';
        foreach ($data as $k => $val){
            $sql .= " $k = '$val',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ' WHERE admin_id = '. $id;
        return $this->db->query($sql);
    }

    public function detail($id)
    {
        if (!$id){
            return false;
        }
        $sql = 'SELECT * FROM admin WHERE admin_id = '. $id;
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        return $ret[0];
    }

    public function del($id)
    {
        if (!$id){
            return false;
        }
        $sql = 'DELETE FROM admin WHERE admin_id IN ('. $id. ')';
        return $this->db->query($sql);
    }

    public function username_unique($username,$id=0)
    {
        $sql = 'SELECT * FROM admin WHERE username="'. $username. '"';
        if($id){
            $sql .= ' AND admin_id !='.$id;
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}