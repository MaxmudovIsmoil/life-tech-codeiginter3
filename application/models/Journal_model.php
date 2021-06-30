<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model
{

    /** Barcha oquv_guruh_aktivlarini keldi ketdi */
    public function davomat($oquv_group_id, $term){
        $limit_start = 0 + (12 * ($term-1));
        $limit_end = 12 * $term;

        $limit = "LIMIT ".$limit_start.",".$limit_end;
        $query = $this->db->query("
                                SELECT j.*, jd.student_id, jd.`status`
                                FROM (
                                SELECT j.*
                                FROM journal j
                                WHERE oquv_group_id = ".$oquv_group_id."
                                GROUP BY j.id
                                ORDER BY j.id
                                ".$limit."
                                ) d
                                LEFT JOIN journal j ON j.id = d.id
                                LEFT JOIN journal_details jd ON jd.journal_id = j.id
        ");

        $students = $query->result_array();

        $davomat = array();

        foreach ($students as $student) {
            $davomat[$student["student_id"]][] = $student;
        }

        return $davomat;
    }



    /** Journal all active */
    public function get_all_journal_active() {
        $result = $this->db->query('
                                    SELECT j.oquv_group_id as og_id, og.guruh_nomi, j.teacher_id, j.kun FROM `journal` j
                                    LEFT JOIN oquv_group og ON og.id = j.oquv_group_id where og.`status`= 2 ORDER BY j.kun ASC
                                    ');
        return $result->result_array();
    }



}