<?php


class Memorial_model extends CI_Model
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
        $sql = 'INSERT INTO memorial SET ';
        foreach ($data as $k => $val){
            if($k == 'content') continue;
            $sql .= " $k = '$val',";
        }
        $sql = rtrim($sql, ',');
        $this->db->query($sql);
        $id = $this->db->insert_id();
        if ($data['content'] && $id){
            $sql = 'INSERT INTO memorial_content SET memorial_id = '. $id. ', content = "'. $data['content']. '"';
            $this->db->query($sql);
        }
        return $id;
    }

    public function mod($id,$data)
    {
        if (!$id || !$data){
            return false;
        }
        $sql = 'UPDATE memorial SET ';
        foreach ($data as $k => $val){
            if($k == 'content') continue;
            $sql .= " $k = '$val',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ' WHERE id = '. $id;
        $this->db->query($sql);
        $sql = 'UPDATE memorial_content SET content = "'. $data['content']. '" WHERE memorial_id = '.$id;
        $this->db->query($sql);
        return true;
    }

    public function detail($id)
    {
        if (!$id){
            return false;
        }
        $sql = 'SELECT m.*,mc.content FROM memorial m LEFT JOIN memorial_content mc ON m.id = mc.memorial_id WHERE m.id = '. $id;
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        return $ret[0];
    }

    public function del($id)
    {
        if (!$id){
            return false;
        }
        $sql = 'DELETE FROM memorial WHERE id IN ('. $id. ')';
        $this->db->query($sql);
        $sql = 'DELETE FROM memorial_content WHERE memorial_id IN ('. $id. ')';
        $this->db->query($sql);
        return true;
    }
}