<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Oquv_guruh extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array("teacher_model","ishreja_model",'kurs_model','user_kurs_model','lessons_model','student_model'));
    }

    public function index()
    {
        $this->data['title'] = "Guruhlar";

        $result = $this->oquv_guruh_model->get_guruhlar();
        $kurslar = [];
        $waiting_g = array();
        $active_g = array();

        foreach ($result as $kurs) {
            $kurslar[$kurs['id']] = $kurs['nomi'];
            if($kurs['og_status'] == 1){
                if(array_key_exists($kurs['id'], $waiting_g))
                {
                    $waiting_g[$kurs['id']]++;
                }
                else
                {
                    $waiting_g[$kurs['id']] = 1;
                }
            }

            if($kurs['og_status'] == 2){
                if(array_key_exists($kurs['id'], $active_g))
                {
                    $active_g[$kurs['id']]++;
                }
                else
                {
                    $active_g[$kurs['id']] = 1;
                }
            }
        }

        $this->data["kurslar"] = $kurslar;
        $this->data["waiting_g"] = $waiting_g;
        $this->data["active_g"] = $active_g;

        $this->data['content'] = "admin/oquv_guruh/index";
        $this->load->view($this->layout, $this->data); 
    }

    /** Kursga tegishli tolanayotgan va o'qiyotgan guruhlar */
    public function oquv_guruh_active($kurs_id = null)
    {
        $this->data['title']        = "Guruhlar";
        $this->data['oquv_group']   = $this->oquv_guruh_model->get_oquv_guruh_active($kurs_id);
        $this->data['kurs_one']     = $this->kurs_model->kurs_one($kurs_id);

        $this->data['content'] = "admin/oquv_guruh/oquv_guruh_active";
        $this->load->view($this->layout, $this->data);
    }

    public function oquv_guruh_tugatilgan($kurs_id = null){
        $this->data['title']        = "Guruhlar";
        $this->data['oquv_group_tugatilgan']   = $this->oquv_guruh_model->get_oquv_guruh_tugatilgan($kurs_id);
        $this->data['kurs_one']     = $this->kurs_model->kurs_one($kurs_id);

        $this->data['content'] = "admin/oquv_guruh/oquv_guruh_tugatilgan";
        $this->load->view($this->layout, $this->data);
    }

    public function oquv_guruh_add($kurs_id = null)
    {
        $this->data['kurs_one'] = $this->kurs_model->kurs_one($kurs_id);
        $this->data['title'] = $this->data['kurs_one']['nomi'];

        $this->data['teacher_kurs'] = $this->teacher_model->get_teacehr_kurs_active($kurs_id);
        $this->data['kurs_id'] = $kurs_id;

        $kurs_id = isset($kurs_id) ? $kurs_id : $this->input->post('kurs_id');

        $this->form_validation->set_rules('guruh_nomi', "Guruh Nomi", 'trim|required');
        $this->form_validation->set_rules('soat', "Vaqt", 'trim|required');
        $this->form_validation->set_rules('term', "Muddati", 'trim');

        if ($this->form_validation->run() == TRUE) {

            if ($this->oquv_guruh_model->add($_POST)){
                redirect("oquv_guruh/oquv_guruh_active/".$kurs_id, "refresh");
            }else{
                echo 'Guruh yaratishda xatolik';
            }
        }

        $this->data['content'] = "admin/oquv_guruh/oquv_guruh_add";
        $this->load->view($this->layout, $this->data);
    }

    public function oquv_guruh_edit($kurs_id = null, $guruh_id = null)
    {
        $this->data['kurs_one'] = $this->kurs_model->kurs_one($kurs_id);
        $this->data['title'] = $this->data['kurs_one']['nomi'];

        $kurs_id    = isset($kurs_id) ? $kurs_id : $this->input->post('kurs_id');
        $guruh_id   = isset($guruh_id) ? $guruh_id : $this->input->post('guruh_id');

        $this->data['teacher_kurs'] = $this->user_kurs_model->get_teacehr_kurs($kurs_id);
        $this->data['kurs_id'] = $kurs_id;

        $this->data['oquv_group_once'] = $this->oquv_guruh_model->get_oquv_guruh_once($guruh_id);

        $student_oquv_group_status = $this->oquv_guruh_model->student_oquv_group_status_edit($guruh_id);


        $this->form_validation->set_rules('guruh_nomi', "Guruh Nomi", 'trim|required');
        $this->form_validation->set_rules('soat', "Vaqt", 'trim|required');
        $this->form_validation->set_rules('term', "Muddati", 'trim');

        if ($this->form_validation->run() == TRUE) {
            $student_status = $this->lessons_model->lessons_oquv_group($guruh_id);
            foreach($student_status as $k => $ss) {
                $data_ss = array(
                    'status'    => $this->input->post('status'),
                );
                $this->student_model->status_update($ss['student_id'], $data_ss);
            }

            $data = [
                "guruh_nomi"  => $this->input->post('guruh_nomi'),
                "teacher_id"  => $this->input->post('teacher_id'),
                "status"      => $this->input->post('status'),
                "soat"        => $this->input->post('soat'),
                "turi"        => $this->input->post('turi'),
                "term"        => $this->input->post('term'),
                "duy"         => $this->input->post('duy') ? $this->input->post('duy') : "0",
                "sey"         => $this->input->post('sey') ? $this->input->post('sey') : "0",
                "pay"         => $this->input->post('pay') ? $this->input->post('pay') : "0",
                "chor"        => $this->input->post('chor') ? $this->input->post('chor') : "0",
                "juma"        => $this->input->post('juma') ? $this->input->post('juma') : "0",
                "shan"        => $this->input->post('shan') ? $this->input->post('shan') : "0",
                "yak"         => $this->input->post('yak') ? $this->input->post('yak') : "0",
            ];

            if ($this->oquv_guruh_model->update($guruh_id, $data)){

                if($student_oquv_group_status){

                    foreach($student_oquv_group_status as $k => $val):
                        $data_status = array(
                            'status' => $this->input->post('status'),
                        );
                        $result = $this->oquv_guruh_model->update_student_maqoam($val['student_id'], $data_status);
                    endforeach;
                }else{
                    $result = true;
                }

                if($result){
                    redirect("oquv_guruh/oquv_guruh_active/".$kurs_id, "refresh");
                }
            }else{
                echo 'Guruh taxrirlashda xatolik';
            }
        }

        $this->data['content'] = "admin/oquv_guruh/oquv_guruh_edit";
        $this->load->view($this->layout, $this->data);
    }

    public function oquv_guruh_view_this($kurs_id = null, $guruh_id = null)
    {
        $this->data['kurs_one'] = $this->kurs_model->kurs_one($kurs_id);
        $this->data['title'] = $this->data['kurs_one']['nomi'];

        $this->data['oquv_group_once'] = $this->oquv_guruh_model->get_oquv_guruh_once($guruh_id);

        $this->data['content'] = "admin/oquv_guruh/oquv_guruh_view_this";
        $this->load->view($this->layout, $this->data);
    }

    public function oquv_guruh_delet($id)
    {
         $result = $this->oquv_guruh_model->delete($id);
         echo json_encode($result);
    }

    /** Guruhga o'quvchi biriktirish */
    public function oquv_guruh_view_student_add($kurs_id = null, $oquv_group_id = null){
        $this->data['kurs_one'] = $this->kurs_model->kurs_one($kurs_id);
        $this->data['title'] = $this->data['kurs_one']['nomi'];
        // $this->data['title'] = '12';


        $kurs_id        = isset($kurs_id)       ? $kurs_id          : $this->input->post('kurs_id');
        $oquv_group_id  = isset($oquv_group_id) ? $oquv_group_id    : $this->input->post('oquv_group_id');

        $this->data['oquv_group_once']  = $this->oquv_guruh_model->get_oquv_guruh_once($oquv_group_id);
//        $this->data['student_guruh']    = $this->oquv_guruh_model->get_student_guruh($kurs_id, $oquv_group_id);
        $lessons_oquv_group             = $this->lessons_model->get_lessons_oquv_group_id($oquv_group_id);



        $oquv_group = array();
        foreach($lessons_oquv_group as $key => $val)
        {
            $oquv_group[$val['student_id']] = $val["student_id"];
        }
        $this->data['oquv_group'] = $oquv_group;

        $arr = array();
        $t = $this->oquv_guruh_model->get_student_group_a($kurs_id);

        foreach($t as $k => $v){
            if(($this->ion_auth->get_users_groups($v['student_id'])->result()[0]->name!='teacher') && ($this->ion_auth->get_users_groups($v['student_id'])->result()[0]->name!='admin') ){
                $arr[] = $v;
            }
        }
        $this->data['student_guruh'] = $arr;

        // echo "<pre>";
        // print_r($kurs_id); 
        // echo "</pre>";



        $this->form_validation->set_rules('student_merger[]', "Student biriktirish", 'trim');

        if ($this->form_validation->run() == TRUE) {
            $student_merger = $this->input->post('student_merger');

            if($this->lessons_model->get_oquv_group_id($oquv_group_id)){
                $this->lessons_model->delete($oquv_group_id);
            }

            if($student_merger) :
                foreach ($student_merger as $k => $val):
                    $data = array(
                        "student_id" => $val,
                        "oquv_group_id" => $oquv_group_id,
                    );

                    $result = $this->lessons_model->add($data);

                endforeach;
            else:
                $result = true;
            endif;

            if($result){
                redirect("oquv_guruh/oquv_guruh_active/".$kurs_id, "refresh");
            }else{
                echo 'Guruhga o\'quvchi biriktirishda xatolik';
            }

        }

        $this->data['content'] = "admin/oquv_guruh/oquv_guruh_view_student_add";
        $this->load->view($this->layout, $this->data);
    }

    /** Guruhdagi o'quvchilar */
    public function ajax_oquv_guruh_student($id)
    {
        $lessons = $this->lessons_model->lessons_oquv_group($id);

        $html = '<thead class="bg-info">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Familiya</th>
                        <th scope="col">Ism</th>
                        <th scope="col">Telefon nomer</th>
                    </tr>
                 </thead>
				 <tbody>';

        foreach($lessons as $k => $l){
            $html .= '<tr class="tr">
                        <th scope="row">'.++$k.'</th>
                        <td>'.$l["familiya"].'</td>
                        <td>'.$l["ism"].'</td>
                        <td>'.phone_format_helper($l["telefon"]).'</td>
                    </tr>';
        }
        $html .= '</tbody>';

        echo json_encode($html);
    }
    
}
