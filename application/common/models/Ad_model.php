<?php

class Ad_model extends CI_Model
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
        $data['ctime'] = time();
        $sql = 'INSERT INTO ad SET ';
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
        $sql = 'UPDATE ad SET ';
        foreach ($data as $k => $val){
            $sql .= " $k = '$val',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ' WHERE id = '. $id;
        return $this->db->query($sql);
    }

    public function detail($id)
    {
        if (!$id){
            return false;
        }
        $sql = 'SELECT * FROM ad WHERE id = '. $id;
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        return $ret[0];
    }

    public function del($id)
    {
        if (!$id){
            return false;
        }
        $sql = 'DELETE FROM ad WHERE id IN ('. $id. ')';
        return $this->db->query($sql);
    }

    public function adcat()
    {
        $sql = 'SELECT id,name FROM ad_cat';
        $query = $this->db->query($sql);
        foreach($query->result_array() as $row){
            $ret[$row['id']] = $row['name'];
        }
        return $ret;
    }
}