<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_model extends CI_Model {

    /** Foydalauvchi O'qituvchi ekanligiga tekshirish */
    public function is_teacher($username, $password) {
        $this->db->select('u.id as teacher_id, u.ip_address, u.familiya, u.ism');
        $this->db->join('users u', 'u.id = users_groups.user_id');
        $this->db->where('u.username = '.$username, "u.password = 123");
        $this->db->where("ug.group_id = 2");
        $query = $this->db->get('users_groups ug');
        return $query->row_array();
    }

    public function get_teachers()
    {
        $this->db->select('u.id as teacher_id, u.ip_address, u.familiya, u.ism, u.telefon, u.manzil, u.email, u.jins, u.company, u.photo_file, u.pasport_file, u.status');
        $this->db->select('k.id as kurs_id, k.nomi as kurs_nomi');
        $this->db->join('users u', 'u.id = users_groups.user_id');
        $this->db->join('user_kurs uk', 'uk.user_id = u.id');
        $this->db->join('kurslar k', 'k.id = uk.kurs_id');
        $query = $this->db->get_where('users_groups', array('group_id'=>2));
        return $query->result_array();
    }
    public function get_teacher_user_kurs($id)
    {
        $this->db->select("u.id, u.username, u.familiya, u.ism, u.telefon, u.manzil, u.tug_yil, u.company, u.jins, u.photo_file, u.malumoti, u.millati, u.email, u.pasport_file, u.status, k.id as kurs_id, k.nomi as kurs_nomi");
        $this->db->join('users u', 'u.id = uk.user_id');
        $this->db->join('kurslar k', 'k.id = uk.kurs_id');
        $query = $this->db->get_where('user_kurs uk', array('uk.user_id'=>$id));
        return $query->result_array();
    }

    public function add($post)
    {
        $id = $this->db->insert("users", $post);
        return $id;
    }

    public function teacher_delete($id)
    {
        $this->db->where("id", $id);
        $id = $this->db->delete("users");
        return $id;
    }

    public function get_max_id()
    {
        $this->db->select_max('id');
        $query = $this->db->get_where('users');
        $row = $query->row_array(); 

        return $row["id"];
    }


    /** O'qituvchini qaysi kurslardan kirishini ochirib tachlash user_kursdan */
    public function delete_user_kurs($teacher_id)
    {
        $this->db->where('user_id', $teacher_id);
        $id = $this->db->delete('user_kurs');
        return $id;
    }

    /** O'qituchini qaysi kurlardan kirishi user_kurs ga qoshish */
    public function add_user_kurs($post)
    {
        $id = $this->db->insert("user_kurs", $post);
        return $id;
    }

    /**
     * O'qituvchiga tegishli gruhlar
     * **/
    public function get_teacher_groups($id)
    {
        $this->db->select('u.id as teacher_id, u.ism');
        $this->db->select('k.*');
        $this->db->select('o_g.*');
        $this->db->select('l.student_id');
        $this->db->join('kurslar k', 'k.id = o_g.kurs_id');
        $this->db->join('users u', 'u.id = o_g.teacher_id');
        $this->db->join('lessons l', 'l.oquv_group_id = o_g.id');
        $query = $this->db->get_where("oquv_group o_g", array('teacher_id' => $id));
        return $query->result_array();
    }

    /**
     * Oq'ituvchiga tegishli gruh ichidagi o'quvchilar
     * **/
    public function get_teacher_group_student($group_id)
    {
        $this->db->select('u.id as user_id, u.ism, u.familiya, u.telefon, u.status');
        $this->db->select('o_g.id as oquv_group_id, o_g.guruh_nomi');
        $this->db->join('users u', 'u.id = l.student_id');
        $this->db->where('oquv_group_id', $group_id);
        $this->db->join('oquv_group o_g', 'o_g.id = l.oquv_group_id');
        $query = $this->db->get('lessons l');
        return $query->result_array();
    }


    /** Oqituvhi qaysi kurslardan dars o'ta olishi va o'qituvchini status = 2 teng yani activelari */
    public function get_teacehr_kurs_active($id)
    {
        $this->db->select('uk.*');
        $this->db->select('u.id, u.ism, u.familiya');
        $this->db->select('ug.group_id');
        $this->db->where(array('ug.group_id' => 2, 'uk.kurs_id' => $id, 'u.status' => 2));
        $this->db->join('users u', 'u.id = uk.user_id');
        $this->db->join('users_groups ug', 'ug.user_id = u.id');
        $query = $this->db->get("user_kurs uk");
        return $query->result_array();
    }

}





