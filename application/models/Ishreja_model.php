<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ishreja_model extends CI_Model {

    public function get_ishreja_guruh($id)
    {
        $query = $this->db->select("i_g.id, i_g.ishreja_guruh");

        $query = $this->db->get_where('ishreja_guruh i_g', array('kurs_id'=>$id));
        return $query->result_array();
    }

    public function ishreja_mavzu($id)
    {
        $query = $this->db->select("i_g_m.id, i_g_m.ishreja_guruh_id");
        $query = $this->db->select("i_m.mavzu,i_m.id as i_m_id");
        $query = $this->db->select("i_g.*");
        $query = $this->db->select("k.*");
        $query = $this->db->join('ishreja_mavzu i_m', 'i_m.id = i_g_m.ishreja_mavzu_id', 'left'); 
        $query = $this->db->join('ishreja_guruh i_g', 'i_g.id = i_g_m.ishreja_guruh_id', 'left'); 

        $query = $this->db->join('kurslar k', 'k.id = i_g.kurs_id', 'left');

        $query = $this->db->get_where('ishreja_guruh_mavzu i_g_m', array('i_g_m.ishreja_guruh_id'=>$id));
        return $query->result_array();
    }

    // public function ishreja_one($id)
    // {
    //     // $this->db->join("kurslar k", "k.id = ishreja.kurs_id");
    //     $query = $this->db->get_where("ishreja",array('id'=>$id));
    //     return $query->row_array();
    // }

    // public function ishreja_add($post)
    // {
    //     $id = $this->db->insert("ishreja", $post);
    //     return $id;
    // }

    // public function ishreja_update($id, $post)
    // {
    //     $this->db->where("id", $id);
    //     $id = $this->db->update("ishreja", $post);
    //     return $id;
    // }
    // public function ishreja_delete($id)
    // {
    //     $this->db->where("id", $id);
    //     $id = $this->db->delete("ishreja");
    //     return $id;
    // }
}
