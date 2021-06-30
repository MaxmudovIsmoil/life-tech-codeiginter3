<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chiqm_model extends CI_Model {

    public function get_chiqmlar()
    {
        $this->db->select("ch.*");
        $query = $this->db->get("chiqm ch");
        return $query->result_array();
    }

    public function get_expense($id)
    {
        $this->db->select("expense.*");
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get_where("expense", array('chiqm_id' => $id));
        return $query->result_array();
    }

    public function add($post)
    {
        $id = $this->db->insert("expense", $post);
        return $id;
    }


    public function update($id, $post)
    {
        $this->db->where("id", $id);
        $id = $this->db->update("expense", $post);
        return $id;
    }

    public function kurs_delete($id)
    {
        $this->db->where("id", $id);
        $id = $this->db->delete("kurslar");
        return $id;
    }


}

