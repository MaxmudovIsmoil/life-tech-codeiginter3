<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/*!
 * Username Generator PHP Library
 * Copyright 2019, almirab
 *
 * Date: Mon Aug 05 2019 v1.0.0
 */
class Username_generator {

    protected $CI;
    protected $db;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    //Generate a unique username using Database
    function generate_unique_username($string_name, $id, $rand_no = 999)
    {
        if(mb_detect_encoding($string_name) == "UTF-8")
        {
            $string_name = $this->translit($string_name);
        }

        $this->db = $this->CI->load->database("default", TRUE);
        $this->db->select("u.id as user_id, u.number, u.manzil as user_hudud");
        $this->db->join("groups g", "g.id = u_g.group_id");
        $this->db->join("user_groups u", "u_g.user_id = u.id");
        $query = $this->db->get_where("users u", array("u.id" => $id));
        $school = $query->row_array();

        $region_code    = $school["region_code"];
        $city_code      = $school["city_code"];
        $school_number  = $school["number"];

        while(true)
        {
            $username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
            $username_parts = array_slice($username_parts, 0, 2); //return only first two array part

            $part1 = (!empty($username_parts[0]))?substr($username_parts[0], 0,3):""; //cut first name to 8 letters
            $part2 = (!empty($username_parts[1]))?substr($username_parts[1], 0,3):""; //cut second name to 5 letters
            $part3 = ($rand_no)? rand(0, $rand_no): "";

            // $username = $part1. str_shuffle($part2). $part3; 
            // str_shuffle to randomly shuffle all characters
            $username = $region_code. $city_code. $school_number. $part1. $part2 . $part3; // str_shuffle to randomly shuffle all characters

            // $username_exist_in_db = $this->username_exist_in_database($username);
            // check username in database
            $username_exist_in_db = $this->CI->ion_auth->username_check($username); //check username in database
            if(!$username_exist_in_db){
                return $username;
            }
        }
    }

    function translit($s) {
        $s = (string) $s; // преобразуем в строковое значение
        $s = strip_tags($s); // убираем HTML-теги
        $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
        $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z- ]/i", "", $s); // очищаем строку от недопустимых символов
        // $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
        return $s; // возвращаем результат
    }
}