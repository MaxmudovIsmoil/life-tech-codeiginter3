<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_davomat_model extends CI_Model
{
    public function teacher_id($teacher_username)
    {
        $this->db->select("u.id as teacher_id, u.ism, u.familiya");
        $query = $this->db->get_where('users u', array('u.username'=>$teacher_username));
        return $query->row_array();
    }

    public function teacher_guruh_all($id)
    {
        $this->db->select("k.nomi, og.*");
        $this->db->join('kurslar k', 'k.id = og.kurs_id');
        $this->db->where(array('og.status' => 2, 'og.teacher_id' => $id));
        $query = $this->db->get('oquv_group og');
        return $query->result_array();
    }

    public function teacher_guruh($id, $hafta_kuni)
    {

        switch($hafta_kuni){
            case 1:
                $hafta_kuni_col = "duy";
                break;
            case 2:
                $hafta_kuni_col = "sey";
                break;
            case 3:
                $hafta_kuni_col = "chor";
                break;
            case 4:
                $hafta_kuni_col = "pay";
                break;
            case 5:
                $hafta_kuni_col = "juma";
                break;
            case 6:
                $hafta_kuni_col = "shan";
                break;
            default:
                $hafta_kuni_col = "yak";
        }

        $where = array("og.".$hafta_kuni_col => 1);

        $this->db->select("k.nomi, og.*");
        $this->db->join('kurslar k', 'k.id = og.kurs_id');
        $this->db->where(array('og.status' => 2, 'og.teacher_id' => $id));
        $this->db->where($where);
        $query = $this->db->get('oquv_group og');
        return $query->result_array();
    }

    /** O'qituchi guruhidagi o'qucvhilar */
    public function guruh_students($guruh_id) {
        $this->db->select('u.id as student_id, u.ism, u.familiya, u.telefon');
        $this->db->select('og.guruh_nomi, og.soat, og.duy, og.sey, og.chor, og.pay, og.juma, og.shan, og.yak');
        $this->db->join('lessons l', 'l.oquv_group_id = og.id');
        $this->db->join('users u', 'u.id = l.student_id');
        $query = $this->db->get_where('oquv_group  og', array('og.id' => $guruh_id));
        return $query->result_array();
    }

    /**
     *  Bazada journal jadvalda guruh Id va shu kungi malumot bor bo'lsa journal_id aks holatda bazaga yozib journal_id
     *  Ya'ni modal birinchi martda bosilgan bo'lsa bazaga yozib id olamiz yana bosilsa shu id olamiz
     * **/
    public function get_check_journal_oquv_group_id($guruh_id, $kun, $post) {
        $this->db->where(array('j.oquv_group_id' => $guruh_id, 'j.kun' => $kun));
        $query = $this->db->get('journal j');
        $result = $query->row_array();
        $journal_id = $result['id'];

        if($journal_id) {
            return $journal_id;
        }
        else{
            $this->db->insert('journal', $post);
            return $this->db->insert_id();
        }
    }


    /** journal_details da journal_id bor yo'qligini tekshirhsh */
    public function get_check_journal_details_journal_id($journal_id) {
        $query = $this->db->get_where('journal_details jd', array('jd.journal_id' => $journal_id));
        return $query->result_array();
    }


    /** Modal oyna birinchi martda bosilganda journal_detailsga o'quvchilarni status = 0 yozib qo'yish */
    public function journal_details_add($post) {
        $res = $this->db->insert('journal_details', $post);
        return $res;
    }

    /** journal_details jadvalidan journal_id va student_id bo'yicha davomatni (status) bor yo'q qilib qo'shish */
    public function journal_details_update($journal_id, $student_id, $data_status) {
        $this->db->where(array('jd.journal_id' => $journal_id, 'jd.student_id' => $student_id));
        $res = $this->db->update('journal_details jd', $data_status);
        return $res;
    }


    public function teacher_guruh_davomat($oquv_group_id, $term = 1){
        $limit_start = 0 + (12 * ($term-1));
        $limit_end = 12 * $term;

        $limit = "LIMIT ".$limit_start.",".$limit_end;
        $query = $this->db->query("
                                SELECT j.*, jd.student_id, jd.`status`, u.familiya as last_name, u.ism as first_name, u.telefon as phone
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
                                LEFT JOIN users u ON u.id = jd.student_id
        ");

        $students = $query->result_array();

        $davomat = array();
        foreach ($students as $student) {
            $davomat[$student["student_id"]][] = $student;
        }

        return $davomat;
    }



    /** Journal all active */
    public function teacher_all_journal_active() {
        $result = $this->db->query('
                                    SELECT j.oquv_group_id as og_id, og.guruh_nomi, j.teacher_id, j.kun FROM `journal` j
                                    LEFT JOIN oquv_group og ON og.id = j.oquv_group_id where og.`status`= 2 ORDER BY j.kun ASC
                                    ');
        return $result->result_array();
    }


    public function tt()
    {
        $res = $this->db->query('SELECT d.*, jd.`status` AS davomat
                                FROM (
                                SELECT l.id as l_id, l.student_id, og.kurs_id, 
                                og.id as og_id, og.guruh_nomi, og.teacher_id, og.`status`, 
                                og.duy, og.sey, og.chor, og.pay, og.juma, og.shan, og.yak, og.soat, og.term,
                                u.ism, u.familiya, u.telefon as phone,
                                j.id as j_id, j.kun AS j_kun
                                FROM lessons l
                                LEFT JOIN oquv_group og ON og.id = l.oquv_group_id
                                LEFT JOIN users u ON l.student_id = u.id
                                LEFT JOIN journal j ON j.oquv_group_id = l.oquv_group_id
                                WHERE og.id = 20
                                ) d
                                LEFT JOIN journal_details jd ON jd.journal_id = d.j_id
                                
                            ');

        return $res->result_array();
    }


}