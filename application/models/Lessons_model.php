<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons_model extends CI_Model
{
    public function add($post)
    {
        $id = $this->db->insert("lessons", $post);
        return $id;
    }

    public function get_oquv_group_id($id)
    {
        $this->db->select('count(id)');
        $this->db->where('l.oquv_group_id='.$id);
        $query = $this->db->get("lessons l");
        return $query->row_array();
    }

    public function get_lessons_oquv_group_id($id)
    {
        $this->db->where('l.oquv_group_id = '.$id);
        $query = $this->db->get("lessons l");
        return $query->result_array();
    }

    public function delete($oquv_group_id)
    {
        $this->db->where("oquv_group_id", $oquv_group_id);
        $id = $this->db->delete("lessons");
        return $id;
    }

//    /** Guruhdagi o'quvchilarni ism,fam,tel */
//    public function teacher_oquv_group_student($teacehr_id, $guruh_id)
//    {
//        $this->db->select('l.oquv_group_id, l.student_id');
//        $this->db->select('og.guruh_nomi, og.soat');
//        $this->db->select('u.ism, u.familiya, u.telefon');
//        $this->db->join('users u','u.id=l.student_id');
//        $this->db->join('oquv_group og','og.id=l.oquv_group_id');
//        $query = $this->db->get("lessons l");
//        return $query->result_array();
//    }

    /** Guruhdagi o'quvchilarni ism,fam,tel */
    public function lessons_oquv_group($id)
    {
        $this->db->select('l.oquv_group_id, l.student_id');
        $this->db->select('u.ism, u.familiya, u.telefon, u.status');
        $this->db->join('users u','u.id=l.student_id');
        $this->db->where('l.oquv_group_id='.$id);
        $query = $this->db->get("lessons l");
        return $query->result_array();
    }
}