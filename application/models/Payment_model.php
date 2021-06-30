<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    
    
        public function pay($tolov)
	{
		$id = $this->db->insert("tolov", $tolov);
		return $id;
	}
    


}
?>