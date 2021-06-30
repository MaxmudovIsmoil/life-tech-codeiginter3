<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Index extends CI_Controller
{
    public $data = [];

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        echo json_encode("Hello World !!!");
    }
}


