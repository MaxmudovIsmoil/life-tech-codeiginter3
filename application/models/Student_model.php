<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function get_students_active()
    {
        $this->db->select('u.id as user_id, u.ip_address, u.familiya, u.ism, u.telefon, u.manzil, u.email, u.jins, u.company,
        u.photo_file, u.pasport_file, u.status, k.id as kurs_id, k.nomi as kurs_nomi, users_groups.group_id');
        $this->db->where('u.status = 2');
        $this->db->join('users u', 'u.id = users_groups.user_id');
        $this->db->join('user_kurs u_k', 'u_k.user_id = u.id');
        $this->db->join('kurslar k', 'k.id = u_k.kurs_id');
        $query = $this->db->get_where('users_groups', array('group_id'=>3));
        return $query->result_array();

    }

    /** Yangi kelgan o'quvchilar **/
    public function get_students_yangilar(){

        $this->db->select('u.id as user_id, u.ip_address, u.familiya, u.ism, u.telefon, u.manzil, u.email, u.jins, u.company,
        u.photo_file, u.pasport_file, u.status, k.id as kurs_id, k.nomi as kurs_nomi, users_groups.group_id');
        $this->db->where('u.status = 1');
        $this->db->join('users u', 'u.id = users_groups.user_id');
        $this->db->join('user_kurs u_k', 'u_k.user_id = u.id');
        $this->db->join('kurslar k', 'k.id = u_k.kurs_id');
        $query = $this->db->get_where('users_groups', array('group_id'=>3));
        return $query->result_array();
    }

    /** Kursni bitirgan o'quvchilar */
    public function get_students_bitirgan(){

        $this->db->select('u.id as user_id, u.ip_address, u.familiya, u.ism, u.telefon, u.manzil, u.email, u.jins, u.company,
        u.photo_file, u.pasport_file, u.status, k.id as kurs_id, k.nomi as kurs_nomi, users_groups.group_id');
        $this->db->where('u.status = 3');
        $this->db->join('users u', 'u.id = users_groups.user_id');
        $this->db->join('user_kurs u_k', 'u_k.user_id = u.id');
        $this->db->join('kurslar k', 'k.id = u_k.kurs_id');
        $query = $this->db->get_where('users_groups', array('group_id'=>3));
        return $query->result_array();
    }

    public function get_student_one($id)
    {
        $this->db->join('users', 'users.id = users_groups.user_id');
        $query = $this->db->get_where('users_groups', array('users.id'=>$id,'group_id'=>3));
        return $query->row_array();
    }

    public function get_student_user_kurs($id)
    {
        $this->db->select("u.id, u.username, u.familiya, u.ism, u.telefon, u.manzil, u.tug_yil, u.company, u.jins, u.email, u.status, u.pasport_file, k.id as kurs_id, k.nomi as kurs_nomi");
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
    
    public function student_update($id, $post)
    {
        $this->db->where("id", $id);
        $id = $this->db->update("users", $post);
        return $id; 
    }

    public function student_delete($id)
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

    /** studnet qaysi kurslardan kirishini o'chirib tachlash user_kursdan */
    public function delete_user_kurs($student_id)
    {
        $this->db->where('user_id', $student_id);
        $id = $this->db->delete('user_kurs');
        return $id;
    }

    /** O'qituchini qaysi kurlardan kirishi user_kurs ga qoshish */
    public function add_user_kurs($post)
    {
        $id = $this->db->insert("user_kurs", $post);
        return $id;
    }


    /** Guruh statusiga qarab o'quvchi statusini o'gartirish */
    public function status_update($id, $post) {
        $this->db->where("id", $id);
        $id = $this->db->update("users", $post);
        return $id;
    }


    /**
     * O'quvchini qaysi kursga, qaysi guruhga, guruh turi oddiy/indvidual, qatnashayotganini
     */
    public function student_course_for_payment($id) {
        $this->db->select('k.nomi as kurs_nomi, oq.guruh_nomi, oq.soat, oq.turi, oq.term');
        $this->db->join('oquv_group oq', 'oq.id = l.oquv_group_id');
        $this->db->join('kurslar k', 'oq.kurs_id = k.id');
        $this->db->where('l.student_id = '.$id);
        $query = $this->db->get('lessons l');
        return $query->row_array();
    }

}
