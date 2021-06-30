<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurs_model extends CI_Model {

    public function get_kurslar()
    {
        $this->db->select("k.*"); // oquv_groupda kursga tegishli gruhlar soni
        $this->db->group_by("k.id");
        $this->db->order_by('k.id ASC');
        $this->db->join('oquv_group og', 'og.kurs_id = k.id', 'left'); 
        $query = $this->db->get("kurslar k");
        return $query->result_array();
    }

    public function kurs_one($id)
    {
        $query = $this->db->get_where("kurslar",array('id'=>$id));
        return $query->row_array();
    }

    public function add($post)
    {
        $id = $this->db->insert("kurslar", $post);
        return $id;
    }

    public function update($id, $post)
    {
         $this->db->where("id", $id);
         $id = $this->db->update("kurslar", $post);
//        $result = $this->db->query("UPDATE `kurslar` SET nomi='{$nomi}', price = '{$price}', type = '{$type}' where id='{$id}'")or die($this->db->error());
        return $id;
    }

    public function kurs_delete($id)
    {
        $this->db->where("id", $id);
        $id = $this->db->delete("kurslar");
        return $id;
    }


}

