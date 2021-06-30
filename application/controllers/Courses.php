<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array("ishreja_model", 'kurs_model'));
    }

    public function index()
    {
        $this->data['title'] = "Kurslar";
        $this->data["kurslar"] = $this->kurs_model->get_kurslar();

        $this->data['content'] = "admin/kurs/index";
        $this->load->view($this->layout, $this->data);
    }
    public function kurs_add()
    {
        $this->data["title"] = "Kurs qo'shish";

        $this->form_validation->set_rules('nomi', "Nomi", 'trim|required');
        // $this->form_validation->set_rules('price', "Narxi", 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {   
            if($id = $this->kurs_model->add($this->input->post()))
            {
                redirect("courses/", "refresh");
            }
        }
        else
        {
            $this->data["validation_errors"] = $this->form_validation->error_array();
        }
         $this->data['content'] = "admin/kurs/kurs_add";
         $this->load->view($this->layout, $this->data);
    }


    public function kurs_edit($id)
    {
        $this->data["title"] = "Kurs taxrirlash";
        $this->data['kurs_one'] = $this->kurs_model->kurs_one($id);

        $this->form_validation->set_rules('nomi', "Nomi", 'trim|required');
        // $this->form_validation->set_rules('price', "Narxi", 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            $post = array(
                'nomi'  =>  $this->input->post('nomi'),
                // 'price' =>  $this->input->post('price'),
                // 'type'  =>  $this->input->post('type'),
            );
            if($id = $this->kurs_model->update($this->input->post('id'), $post)) {
                redirect("courses/", "refresh");
            }else{
                echo "Yangilashda xatolik";
            }

        } else {
            $this->data["validation_errors"] = $this->form_validation->error_array();
        }

         $this->data['content'] = "admin/kurs/kurs_edit";
         $this->load->view($this->layout, $this->data);
    }

    public function kurs_delet($id)
    {
        $result = $this->kurs_model->kurs_delete($id);
        // $result = true;
        echo json_encode($result);
    }
}