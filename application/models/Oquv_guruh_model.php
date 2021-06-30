<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oquv_guruh_model extends CI_Model {

    public function get_guruhlar()
    {
        $this->db->select("k.*"); // oquv_groupda kursga tegishli gruhlar soni
        $this->db->select("og.status as og_status");
        // $this->db->group_by("k.id");
        $this->db->order_by('k.id ASC');
        // $this->db->where('og.status',);
        // $this->db->count_all("og.status");
        $this->db->join('oquv_group og', 'og.kurs_id = k.id', 'left'); 
        $query = $this->db->get("kurslar k");
        return $query->result_array();
    }

    public function get_oquv_guruh_status()
    {
        $res = $this->db->query("SELECT (case WHEN status = 1 THEN 'Toplanayotgan' WHEN status = 2 THEN 'oqiyotgan' ELSE 'tugatilgan' END) stat, kurslar.id, kurslar.nomi FROM `oquv_group` RIGHT JOIN `kurslar` on oquv_group.kurs_id=kurslar.id
            ");
        return $res->result_array();
    }

    public function get_oquv_guruh_active($id = null)
    {
        $this->db->select("count(l.oquv_group_id) as student_soni"); // oquv_groupda kursga tegishli guruhlar soni
        $this->db->group_by("o_g.id");
        $this->db->select('l.student_id');
        $this->db->select('o_g.id, o_g.guruh_nomi, o_g.status, o_g.duy,o_g.sey, o_g.chor, o_g.pay, o_g.juma, o_g.shan, o_g.yak, o_g.soat, o_g.turi, o_g.term');
        $this->db->where('o_g.status != 3');
        if(!is_null($id)){
            $this->db->where(array('kurs_id'=>$id));
        }
        $this->db->join('lessons l', 'l.oquv_group_id = o_g.id', 'left');
        $this->db->select('u.ism as teacher_ism, u.familiya as teacher_fam');
        $this->db->join('users u', 'u.id = o_g.teacher_id');
        $query = $this->db->get('oquv_group o_g');
        return $query->result_array();
    }

    public function get_oquv_guruh_tugatilgan($id)
    {
        $this->db->select("count(l.oquv_group_id) as student_soni"); // oquv_groupda kursga tegishli guruhlar soni
        $this->db->group_by("o_g.id");
        $this->db->select('l.student_id');
        $this->db->select('o_g.id, o_g.guruh_nomi, o_g.status, o_g.duy,o_g.sey, o_g.chor, o_g.pay, o_g.juma, o_g.shan, o_g.yak, o_g.soat, o_g.turi');
        $this->db->where('o_g.status = 3');
        $this->db->join('lessons l', 'l.oquv_group_id = o_g.id', 'left');
        $this->db->select('u.ism as teacher_ism, u.familiya as teacher_fam');
        $this->db->join('users u', 'u.id = o_g.teacher_id');
        $query = $this->db->get_where('oquv_group o_g', array('kurs_id'=>$id));
        return $query->result_array();
    }


    public function get_oquv_guruh_once($guruh_id)
    {
        $this->db->select('o_g.*');
        $this->db->select('u.familiya, u.ism');
        $this->db->join('users u', "u.id = o_g.teacher_id" );
        $query = $this->db->get_where('oquv_group o_g', array('o_g.id' => $guruh_id));
        return $query->row_array();
    }

    /** Guruhga student biriktirish */
    public function get_student_guruh($kurs_id, $guruh_id){
        $query = $this->db->query("SELECT *
                            FROM (
                            SELECT u.*
                            , og.student_id, og.og_id, og.guruh_nomi, og.`status`=='1' as og_status
                            FROM (
                            SELECT u.id as user_id, u.ism, u.familiya, uk.kurs_id
                            FROM user_kurs uk
                            LEFT JOIN users u ON u.id = uk.user_id
                            LEFT JOIN users_groups ug on ug.user_id = u.id
                            WHERE uk.kurs_id = ".$kurs_id." and ug.group_id = 3
                            ) u
                            LEFT JOIN (
                            SELECT og.id as og_id,og.guruh_nomi,og.kurs_id, og.status, l.student_id
                            FROM oquv_group og
                            LEFT JOIN lessons l ON l.oquv_group_id = og.id
                            WHERE og.kurs_id = ".$kurs_id." AND og.id <> ".$guruh_id." AND og.`status` <> 3
                            ) og ON u.user_id = og.student_id
                            ) a
                            WHERE a.student_id IS NULL
                        ");
        return $query->result_array();
    }

    public function  get_student_group_a($kurs_id)
    {
        // $q = $this->db->query("SELECT u.id as student_id, u.ism, u.familiya, u.status
        //                 FROM `users` u WHERE not id in 
        //                 (SELECT student_id FROM lessons l 
        //                 LEFT JOIN oquv_group og on og.id = l.oquv_group_id 
        //                 LEFT JOIN kurslar k on k.id = og.kurs_id 
        //                 WHERE og.soat = '{$soat}' and k.id = '{$kurs_id}')
        //                 ");
         $q = $this->db->query("SELECT u.id as student_id, u.familiya, u.ism, k.nomi, ug.group_id as kimligi 
                                FROM user_kurs uk
                                LEFT JOIN users u on u.id = uk.user_id
                                LEFT JOIN kurslar k ON k.id = uk.kurs_id
                                LEFT JOIN users_groups ug ON ug.user_id = u.id
                                WHERE uk.kurs_id = {$kurs_id} AND u.status = 1 AND ug.group_id = 3 
                            ");
                            
        return $q->result_array();
    }


    /** Oquv guruhga tegishli oquvchilarni yangi kelgan, o'qiyotgan yoki bitirganligini
     * guruhni statusiga qarab taxrirlash uchun shu guruhga tegishli o'quvchilarni olish
     */
    public function student_oquv_group_status_edit($guruh_id)
    {
        $this->db->select('l.*, u.ism, u.familiya, u.status');
        $this->db->where('l.oquv_group_id='.$guruh_id);
        $this->db->join('users u', 'u.id = l.student_id', 'left');
        $query = $this->db->get("lessons l");
        return $query->result_array();
    }

    public function update_student_maqoam($id, $post)
    {
        $this->db->where("id", $id);
        $id = $this->db->update("oquv_group", $post);
        return $id;
    }

    public function add($post)
    {
        $id = $this->db->insert("oquv_group", $post);
        return $id;
    }

    public function update($id, $post)
     {
         $this->db->where("id", $id);
         $id = $this->db->update("oquv_group", $post);
         return $id;
     }

    public function delete($id)
     {
         $this->db->where("id", $id);
         $id = $this->db->delete("oquv_group");
         return $id;
     }

    public function guruh_count_model()
    {
//        $this->db->where()
        $q = $this->db->count_all('oquv_group');
        return $q;
    }


    public function get_all_guruh() {
        $this->db->select("og.id, og.guruh_nomi, og.status");
        $query = $this->db->get("oquv_group og");
        return $query->result_array();
    }

    public function oquv_guruh_students($kurs_id)
    {
        $students_data = $this->db->query("
        SELECT u.id as student_id, og.*, ut.ism as teacher_first_name, ut.familiya as teacher_last_name
        ,u.id as student_id, u.ism as student_first_name, u.familiya as student_last_name, u.telefon as student_phone
        FROM `oquv_group` og
        LEFT JOIN lessons l on l.oquv_group_id = og.id
        LEFT JOIN users u on u.id = l.student_id
        LEFT JOIN users ut on ut.id = og.teacher_id
        WHERE og.`status` = 2 AND og.id = ".$kurs_id."
        ORDER BY u.id
        ");

        $students = $students_data->result_array();
        foreach ($students as $key => $student) {
            if($key == 0) { $students[$key] = $this->get_oquv_guruh_teacher($student); }
            unset($student["teacher_first_name"]);
            unset($student["teacher_last_name"]);
            $students[++$key] = $student;
        }

        return $students;

    }

    public function get_oquv_guruh_teacher($arr) {

        $teacher["name"] = $arr["teacher_last_name"]." ".$arr["teacher_first_name"];
        $teacher["soat"] = $arr["soat"];
        $kunlar = "";
        $kunlar .= !$arr["duy"] ? "":"Dushanba,";
        $kunlar .= !$arr["sey"] ? "":"Seshanba,";
        $kunlar .= !$arr["chor"] ? "":"Chorshanba,";
        $kunlar .= !$arr["pay"] ? "":"Payshanba,";
        $kunlar .= !$arr["juma"] ? "":"Juma";
        $kunlar .= !$arr["shan"] ? "":"Shanba";
        $teacher["kunlar"] = $kunlar;

        return $teacher;
    }


    /** Asosiy oynada kurslarga qatnashayotgan active o'quvchilar soni */
    public function all_kurs_statistika()
    {
//         $result = $this->db->query('SELECT og.kurs_id, k.nomi as kurs_name, og.id as og_id, og.guruh_nomi, count(l.student_id) as student_count
//                                    FROM lessons l
//                                    LEFT JOIN oquv_group og ON og.id = l.oquv_group_id
//                                    LEFT JOIN kurslar k ON k.id = og.kurs_id
//                                    WHERE og.`status` = 2
//                                    GROUP BY k.id
//                                   ');

        $result = $this->db->query('SELECT c.id, count(c.student_id) as student_count
            FROM (
            SELECT k.id, og.kurs_id, k.nomi as kurs_name, og.id as og_id, og.guruh_nomi, l.student_id
            FROM lessons l
            LEFT JOIN oquv_group og ON og.id = l.oquv_group_id
            LEFT JOIN kurslar k ON k.id = og.kurs_id
            WHERE og.`status` = 2
             ) c
            GROUP BY c.id');

        return $result->result_array();
    }


}

