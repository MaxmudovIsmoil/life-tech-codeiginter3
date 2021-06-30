<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile_model extends CI_Model
{
    /**  */
    public function student_data($username) {
        $query = $this->db->query("SELECT u.`username`, u.ism, u.`familiya`, u.telefon, 
                                    k.id as kurs_id, k.nomi as kurs_nomi,
                                    og.teacher_id as t_id, teacher.familiya as t_familiya, teacher.ism as t_ism, teacher.telefon as t_telefon,
                                    og.id as guruh_id, og.guruh_nomi, og.`status`, og.duy, og.sey, og.chor, og.pay, og.juma,
                                    og.shan, og.yak, og.soat, og.turi, og.term FROM `lessons` l
                                    LEFT JOIN users u ON u.id = l.student_id
                                    LEFT JOIN oquv_group og on og.id = l.oquv_group_id
                                    LEFT JOIN kurslar k ON k.id = og.kurs_id
                                    LEFT JOIN users teacher ON teacher.id = og.teacher_id
                                    WHERE og.`status` <> 3 AND u.username = '".$username."'");
        return $query->result_array();
    }

    public function kurslar() {
        $query = $this->db->query("SELECT id, nomi, price FROM `kurslar`");
        return $query->result_array();
    }

    public function kursTanlagan($login)
    {
        $query = $this->db->query("SELECT u.username, u.ism, u.`familiya`, u.telefon, k.id as kurs_id, k.nomi, k.price FROM `user_kurs` uk 
                                    LEFT JOIN users u ON u.id = uk.user_id
                                    LEFT JOIN kurslar k ON k.id = uk.kurs_id
                                    WHERE u.username = '".$login."'");
        return $query->result_array();
    }

    public function checkStudentLessons($login) {
        $query = $this->db->query("SELECT u.username, u.ism, u.`familiya`, u.telefon, k.id as kurs_id, k.nomi, k.price FROM `user_kurs` uk 
                                    LEFT JOIN users u ON u.id = uk.user_id
                                    LEFT JOIN kurslar k ON k.id = uk.kurs_id
                                    WHERE u.username = '".$login."'");
        if (count($query->result_array()))
            return $query->result_array();
        else
            return false;
    }

}