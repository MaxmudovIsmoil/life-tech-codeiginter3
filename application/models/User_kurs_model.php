<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_kurs_model extends CI_Model {

     public function get_teacehr_kurs($id)
     {
         $this->db->select('uk.*');
         $this->db->select('u.id, u.ism, u.familiya');
         $this->db->select('ug.group_id');
         $this->db->where('ug.group_id = 2');
         $this->db->where('uk.kurs_id ='.$id);
         $this->db->join('users u', 'u.id = uk.user_id');
         $this->db->join('users_groups ug', 'ug.user_id = u.id');
         $query = $this->db->get("user_kurs uk");
         return $query->result_array();
     }

//     public function user_kurs_one($id)
//     {
//         $query = $this->db->get_where("user_kurs",array('id'=>$id));
//         return $query->row_array();
//     }

    public function get_user_kurs($id)
    {
        $this->db->select('uk.*');
        $this->db->select('u.id, u.ism, u.familiya');
        $this->db->where('k.id = '.$id);
        $this->db->where('ug.group_id = 3');
        $this->db->join('users_groups ug', 'ug.user_id = uk.user_id');
        $this->db->join('users u', 'u.id = uk.user_id');
        $this->db->join('kurslar k', 'k.id = uk.kurs_id');
        $query = $this->db->get("user_kurs uk");
        return $query->result_array();
    }



    public function add($post)
    {
        $id = $this->db->insert("user_kurs", $post);
        return $id;
    } 

    // public function update($id, $post)
    // {
    //     $this->db->where("id", $id);
    //     $id = $this->db->update("user_kurs", $post);
    //     return $id;
    // }
}
