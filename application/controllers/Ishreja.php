<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ishreja extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array("ishreja_model",'kurs_model','oquv_guruh_model'));
    }

    /* Ish reja boshlandi */
    public function index($id)
    {
        $this->data['kurs_one'] = $this->kurs_model->kurs_one($id);
        $this->data['ishreja_id'] = $id;
        $this->data['title'] = $this->data['kurs_one']['nomi']." guruhlari";
        $this->data["ishreja_guruh"] = $this->ishreja_model->get_ishreja_guruh($id);

        // echo "<pre>";
        // print_r($this->data['ishreja_guruh']);
        // echo "</pre>";

        $this->data['content'] = "admin/ishreja/index";
        $this->load->view($this->layout, $this->data);  
    }

    public function ishreja_mavzu($ishreja_id, $guruh_id)
    {
        $this->data['kurs_one'] = $this->kurs_model->kurs_one($ishreja_id);
        
        $this->data['kurs_id'] = $ishreja_id;
        $this->data['ishreja_mavzu'] = $this->ishreja_model->ishreja_mavzu($guruh_id);

        $this->data['guruh_nomi'] = $this->data['ishreja_mavzu'][0]['ishreja_guruh'] ?? null;
        
        $this->data['title'] = $this->data['guruh_nomi']." guruh ish rejasi";

        $this->data['content'] = "admin/ishreja/ishreja_mavzu";
        $this->load->view($this->layout, $this->data);
    }

    public function ish_reja_add()
    {
        $this->data["title"] = "Ish reja qo'shish";
        $this->data["kurslar"] = $this->kurs_model->get_kurslar();

        $this->form_validation->set_rules('mavzu', "Mavzu", 'trim|required');
        $this->form_validation->set_rules('kurs_id', "Kurs id", 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            if($id = $this->ishreja_model->ishreja_add($this->input->post())) {
                redirect("admin/ishreja/", "refresh");
            }
        }
        else {
            $this->data["validation_errors"]=$this->form_validation->error_array();
        }

        $this->data['content'] = "admin/ishreja/ishreja_add";
        $this->load->view($this->layout, $this->data); 
    }

    public function ish_reja_edit($id)
    {
        $this->data["title"] = "Ish Reja yangilash";
        $this->data["kurslar"] = $this->kurs_model->get_kurslar();
        $this->data["ishreja"] = $this->ishreja_model->ishreja_one($id);

        $this->form_validation->set_rules('mavzu', "Mavzu", 'trim|required');
        $this->form_validation->set_rules('kurs_id', "Kurs id", 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if($id = $this->ishreja_model->ishreja_update($id, $this->input->post())) {
                redirect("admin/ishreja/", "refresh");
            }
        } else {
            $this->data["validation_errors"]=$this->form_validation->error_array();
        }

        $this->data['content'] = "admin/ishreja/ishreja_edit";
        $this->load->view($this->layout, $this->data); 
    }

    public function ish_reja_delet($id)
    {
        $result = $this->ishreja_model->ishreja_delete($id);
        
        echo json_encode($result);
    }
    
}

?>