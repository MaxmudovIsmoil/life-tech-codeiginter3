<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Davomat extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array("teacher_model","oquv_guruh_model",'kurs_model','journal_model'));
    }


    public function index()
    {
        $this->data['title'] = "Kurslar";
        $kurslar = $this->kurs_model->get_kurslar();
        $this->data["kurslar"] = $kurslar;
        $guruhlar = $this->oquv_guruh_model->get_oquv_guruh_active();
        $this->data["guruhlar"] = $guruhlar;
        $students = array();
        foreach ($guruhlar as $guruh) {
            $students[$guruh['id']] = $this->oquv_guruh_model->oquv_guruh_students($guruh["id"]);
        }
        $this->data["students"] = $students;

        $journal_active = $this->journal_model->get_all_journal_active();
        $dars_kunlar = array();
        foreach($journal_active as $ja){
            $dars_kunlar[$ja['og_id']][] = $ja;
        }
        $this->data['dars_kunlar'] = $dars_kunlar;

        $this->data['content'] = "admin/davomat/index";
        $this->load->view($this->layout, $this->data);
    }

    /**
     *  Davomat / active gurugdagi o'chilarni davoamti ajax
     **/
    public function ajax_term(){
        $guruh_id   = $this->input->post('guruh_id');
        $term       = $this->input->post('term');
        $guruhlar   = $this->oquv_guruh_model->get_oquv_guruh_active();

        $students = array();
        foreach ($guruhlar as $guruh) {
            if($guruh_id == $guruh["id"]){
                $students = $this->oquv_guruh_model->oquv_guruh_students($guruh["id"]);
            }
        }


        $journal_active = $this->journal_model->get_all_journal_active();
        $dars_kunlar = array();
        foreach($journal_active as $ja){
            $dars_kunlar[$ja['og_id']][] = $ja;
        }

        $davomat = $this->journal_model->davomat($guruh_id, $term);


        $html  = '<div class="col-md-3 col-sm-4 col-6 pl-4 group-students">
                        <ul class="list-group">';
                        foreach($students as $key => $student) {
                            if($key == 0){
                                $html .= '<li class="list-group-item">
                                    <p class="guruh-nomi text-left">'.$student['name'].'</p>
                                    <i class="guruh_vaqti"><i class="fa fa-clock"></i> '.date('H:i', strtotime($student['soat'])).'</i>
                                    <p class="dars_kunlari text-left">'.$student['kunlar'].'</p>
                                </li>';
                            }else{
                                $html .= '<li class="list-group-item">
                                    <p class="ism">'.$student['student_last_name'].' '.$student['student_first_name'].'</p>
                                    <span class="tel"><i class="fas fa-phone"></i> '.phone_format_helper($student['student_phone']).'</span>
                                </li>';
                            }
                        }

                        $html .= '</ul>
                            </div><!--./ col-md-3 -->
                            <div class="col-md-9 co-sm-8 col-6 davomat_scroll">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>';
                                        $k = 1;
                                        $limit_start = 0 + (12 * ($term-1));
                                        $limit_end = 12 * $term;
                                        for($i = $limit_start; $i < $limit_end; $i++):
                                        $html .= '<th><p>'.($limit_start+= 1).'</p>';
                                            if(isset($dars_kunlar[$guruh_id][$i])){

                                                $h = date('D', strtotime($dars_kunlar[$guruh_id][$i]["kun"]));
                                                switch($h){
                                                    case 'Mon': $a = 'Dushaba'; break;
                                                    case 'Tue': $a = 'Seshanba'; break;
                                                    case 'Wed': $a = 'Chorshanba'; break;
                                                    case 'Thu': $a = 'Payshanba'; break;
                                                    case 'Fri': $a = 'Juma'; break;
                                                    case 'Sat': $a = 'Shanba'; break;
                                                }
                                                $html .= '<span>'.$a.'</span>';
                                                $html .= '<i>'.date('d.m.Y', strtotime($dars_kunlar[$guruh_id][$i]["kun"])).'</i>';
                                            }else{
                                                $html .= '<span class="span_ajax">&nbsp;</span>';
                                                $html .= '<i>&nbsp;</i>';
                                            }
                                        $html .= '</th>';
                                        endfor;

                                   $html .= '</tr>
                                </thead>
                                <tbody>';

                                foreach ($davomat as $da) {
                                    $html .= '<tr>';
                                    for ($i = 0; $i < 12; $i++) {
                                        $html .= '<td>';
                                        if (isset($da[$i])) {
                                            if (!$da[$i]["status"]) {
                                                $html .= '<i class="fas fa-times"></i>';
                                            } else {
                                                $html .= '<i class="fas fa-check"></i>';
                                            }
                                        }
                                        $html .= '</td>';
                                    }
                                }
                                $html .= '</tr>
                                 </tbody>
                            </table>
                        </div>';
        echo json_encode($html);
    }



}