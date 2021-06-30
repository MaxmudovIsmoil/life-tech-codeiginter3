<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hisobot extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('kurs_model'));
    }

    public function index()
    {
        $this->data['title'] = "Hisobot";
//        $this->data["kurslar"] = $this->kurs_model->get_kurslar();

        $this->data['content'] = "admin/hisobot/index";
        $this->load->view($this->layout, $this->data);
    }

}