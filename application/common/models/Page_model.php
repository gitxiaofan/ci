<?php

class Page_model extends CI_Model
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
        $sql = 'INSERT INTO page SET ';
        foreach ($data as $k => $val){
            $sql .= " $k = '$val',";
        }
        $sql = rtrim($sql, ',');
        return $this->db->query($sql);
    }

    public function detail($id){
        if(!$id){
            return false;
        }
        $sql = 'SELECT * FROM page WHERE id='.$id;
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        return $ret[0];
    }

    public function mod($id,$data)
    {
        if (!$id || !$data){
            return false;
        }
        $sql = 'UPDATE page SET ';
        foreach ($data as $k => $val){
            $sql .= " $k = '$val',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ' WHERE id = '. $id;
        return $this->db->query($sql);
    }
}