<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_davomat extends Teacher_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('teacher_model','teacher/teacher_davomat_model','journal_model'));
        $this->weekday = date("w");
    }

    public function index()
    {
        $this->data['title'] = "Bosh sahifa";

        echo 111;

        $login = $_SESSION['login'];
        $teacher = $this->teacher_davomat_model->teacher_id($login);

        $this->session->teacher_id       = $teacher['teacher_id'];
        $this->session->teacher_ism      = $teacher['ism'];
        $this->session->teacher_familiya = $teacher['familiya'];

//        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
//        //list the users
//        $this->data['users'] = $this->ion_auth->users()->result();

        $this->data['content'] = "teacher/index";
        $this->load->view($this->layout_teacher, $this->data);
    }


    public function barcha_guruhlar($datetime = null) {
        $this->data['title'] = "O'qituvchi dars jadvali";
        $teacher_id = $_SESSION['teacher_id'];

        $teacher_guruh = $this->teacher_davomat_model->teacher_guruh_all($teacher_id);

        $this->data['teacher_id'] = $teacher_id;
        $this->data['teacher_guruh'] = $teacher_guruh;


        $this->data['content'] = "teacher/barcha_guruhlar";
        $this->load->view($this->layout_teacher, $this->data);
    }


    public function guruh_students($guruh_id) {

        $guruh_students = $this->teacher_davomat_model->guruh_students($guruh_id);
        $this->data['guruh_students']   = $guruh_students;
        $this->data['guruh_nomi']       = $guruh_students[0]['guruh_nomi'];
        $this->data['dars_vaqti']       = date('H:i', strtotime($guruh_students[0]['soat']))." - ".date('H:i', strtotime($guruh_students[0]['soat'])+5400);

        $kunlari = '';
        $kunlari .= ($guruh_students[0]['duy']==1) ? "Duyshanba, " : "";
        $kunlari .= ($guruh_students[0]['sey']==1) ? "Seyshanba, " : "";
        $kunlari .= ($guruh_students[0]['chor']==1) ? "Chorshanba, " : "";
        $kunlari .= ($guruh_students[0]['pay']==1) ? "Payshanba, " : "";
        $kunlari .= ($guruh_students[0]['juma']==1) ? "Juma, " : "";
        $kunlari .= ($guruh_students[0]['shan']==1) ? "Shanba, " : "";
        $kunlari .= ($guruh_students[0]['yak']==1) ? "Yakshanba, " : "";

        $this->data['kunlari'] = $kunlari;

        $this->data['content'] = "teacher/guruh_students";
        $this->load->view($this->layout_teacher, $this->data);
    }


    public function dars_jadval($datetime = null) {
        $this->data['title'] = "O'qituvchi dars jadvali";
        $teacher_id = $_SESSION['teacher_id'];

        $hafta_kuni = date('w');
        $teacher_guruh = $this->teacher_davomat_model->teacher_guruh($teacher_id, $hafta_kuni);

        $this->data['teacher_id'] = $teacher_id;
        $this->data['teacher_guruh'] = $teacher_guruh;

        $weekday = $this->weekday;
        if($datetime != null)
            $weekday = date("w", $datetime);
        else
            $datetime = time();

        $this->data['datetime'] = $datetime;

        $this->data['content'] = "teacher/dars_jadval";
        $this->load->view($this->layout_teacher, $this->data);
    }


    public function guruh_davomat() {
        $this->data['title'] = "Barcha guruhlar davomati";
        $teacher_id = $_SESSION['teacher_id'];

        $teacher_guruh = $this->teacher_davomat_model->teacher_guruh_all($teacher_id);

        $students = array();
        foreach($teacher_guruh as $k => $guruh){
            $students[$guruh['id']] = $this->teacher_davomat_model->teacher_guruh_davomat($guruh["id"], 1);
        }
        $this->data["students"] = $students;
        $t = $this->teacher_davomat_model->tt();

        $journal_active = $this->teacher_davomat_model->teacher_all_journal_active();
        $dars_kunlar = array();
        foreach($journal_active as $ja){
            $dars_kunlar[$ja['og_id']][] = $ja;
        }
        $this->data['dars_kunlar'] = $dars_kunlar;


        $this->data['teacher_id'] = $teacher_id;
        $this->data['teacher_guruh'] = $teacher_guruh;

        $this->data['content'] = "teacher/guruh_davomat";
        $this->load->view($this->layout_teacher, $this->data);
    }


    /** O'qituvchini oldingi (kechagi) kundagi dars jadvali */
    public function ajax_prev_dars_jadval() {
        $teacher_id = $_POST['teacher_id'];
        $datetime   = $_POST['datetime'];
        $datetime = $datetime-86400; /** bir kunga arqaga qaytarish */
        $date = date("d", $datetime) ." ". lang(date("F", $datetime)) .", ". lang(date("l", $datetime));

        $hafta_kuni = date('w', $datetime);
        $teacher_guruh = $this->teacher_davomat_model->teacher_guruh($teacher_id, $hafta_kuni);

        $html = '';
        $i=1;
        foreach ($teacher_guruh as $k => $tg):
            $str = $tg['soat'];
            $substr = substr($str, 0,5);
            $vaqt = date("H:i", strtotime($substr))." - ".date("H:i", strtotime($substr)+5400);

            if ($tg['turi']==1)
                $turi = "Indvidual";
            else
                $turi = "Guruh";

            $html .= '<tr>
                <th class="align-middle nomer">'.$i++.'</th>
                <td class="align-middle">
                    <span data-toggle="modal" data-target=".modal_davomat"
                    class="badge badge-pill badge-success guruh_badge js_dars_jadval_student_davomat"
                    data-guruh-id="'.$tg['id'].'" data-soat="'.$vaqt.'">'.$tg['guruh_nomi'].'</span>
                </td>
                <td class="align-middle">'.$tg['nomi'].'</td>
                <td class="align-middle">'.$vaqt.'</td>
                <td class="align-middle">'.$turi.'</td>
            </tr>';
        endforeach;


        $result = array(
            'html'      => $html,
            'date'      => $date,
            'datetime'  => $datetime,
        );
        echo json_encode($result);
    }


    /** O'qituvchini oldingi (kechagi) kundagi dars jadvali */
    public function ajax_next_dars_jadval() {
        $teacher_id = $_POST['teacher_id'];
        $datetime   = $_POST['datetime'];
        $datetime = $datetime+86400; /** bir kun qo'shish */
        $date = date("d", $datetime) ." ". lang(date("F", $datetime)) .", ". lang(date("l", $datetime));

        $hafta_kuni = date('w', $datetime);
        $teacher_guruh = $this->teacher_davomat_model->teacher_guruh($teacher_id, $hafta_kuni);

        $html = '';
        $i=1;
        foreach ($teacher_guruh as $k => $tg):
            $str = $tg['soat'];
            $substr = substr($str, 0,5);
            $vaqt = date("H:i", strtotime($substr))." - ".date("H:i", strtotime($substr)+5400);

            if ($tg['turi']==1)
                $turi = "Indvidual";
            else
                $turi = "Guruh";

            $html .= '<tr>
                <th class="align-middle nomer">'.$i++.'</th>
                <td class="align-middle">
                    <span data-toggle="modal" data-target=".modal_davomat"
                    class="badge badge-pill badge-success guruh_badge js_dars_jadval_student_davomat"
                    data-guruh-id="'.$tg['id'].'" data-soat="'.$vaqt.'">'.$tg['guruh_nomi'].'</span>
                </td>
                <td class="align-middle">'.$tg['nomi'].'</td>
                <td class="align-middle">'.$vaqt.'</td>
                <td class="align-middle">'.$turi.'</td>
            </tr>';
        endforeach;


        $result = array(
            'html'      => $html,
            'date'      => $date,
            'datetime'  => $datetime,
        );
        echo json_encode($result);
    }


    /** Dars jadval davomat
     * Guruhdagi o'quvchilarni modal oynada boy/yo'q qilish uchun chiqarish
     */
    public function ajax_guruh_oquvchilari() {
        $teacher_id = $this->session->teacher_id;
        $kun        = $_POST['kun'];
        $guruh_id   = $_POST['guruh_id'];

        $guruh_students = $this->teacher_davomat_model->guruh_students($guruh_id);

        $data_journal = array(
            'oquv_group_id' => $guruh_id,
            'teacher_id'    => $teacher_id,
            'kun'           => date('Y-m-d', $kun),
        );

        $journal_id = $this->teacher_davomat_model->get_check_journal_oquv_group_id($guruh_id, date('Y-m-d', $kun), $data_journal);

        if(!$this->teacher_davomat_model->get_check_journal_details_journal_id($journal_id)) {

            foreach ($guruh_students as $k => $gs) {
                $data_journal_details = array(
                    'journal_id'    => $journal_id,
                    'student_id'    => $gs['student_id'],
                    'status'        => 0,
                );
                $this->teacher_davomat_model->journal_details_add($data_journal_details);
            }
        }

        $html = '<table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Familiya</th>
                            <th scope="col">Ism</th>
                            <th scope="col">Davomat</th>
                            <th scope="col">Telefon</th>
                        </tr>
                    </thead>
                  <tbody>';
        $i=1;
        foreach($guruh_students as $k => $gs):
            $html .= '<tr>
                        <th class="align-middle">'.$i++.'</th>
                        <td class="align-middle">'.$gs["familiya"].'</td>
                        <td class="align-middle">'.$gs["ism"].'</td>
                        <td class="align-middle">
                              <span class="js_davomat_btn btn btn-danger btn-sm" data-journal-id="'.$journal_id.'" data-student-id="'.$gs['student_id'].'">Yo\'q <i class="fas fa-user-times"></i></span>
                        </td>
                        <td class="align-middle">'.phone_format_helper($gs["telefon"]).'</td>
                    </tr>';
        endforeach;
            $html .= '</tbody>';

        echo json_encode($html);

    }


    /** Journal_details Guruh o'quvchilarini davomatini bazaga yozish */
    public function ajax_student_davomat() {

        $journal_id = $this->input->post('journal_id');
        $student_id = $this->input->post('student_id');

        $status = array(
            'status' => $this->input->post('status')
        );

        if($this->teacher_davomat_model->journal_details_update($journal_id, $student_id, $status))
            $result = true;
        else
            $result = false;

        echo json_encode($result);
    }



    /** Guruhdagi o'quvchilar davomati ajax */
    public function ajax_guruh_term() {
        $guruh_id   = $this->input->post('guruh_id');
        $term       = $this->input->post('term');
        $guruhlar   = $this->oquv_guruh_model->get_oquv_guruh_active();

        $students = array();
        foreach ($guruhlar as $guruh) {
            if($guruh_id == $guruh["id"]){
                $students = $this->oquv_guruh_model->oquv_guruh_students($guruh["id"]);
            }
        }
        $guruh_once = $this->oquv_guruh_model->get_oquv_guruh_once($guruh_id);

        $journal_active = $this->journal_model->get_all_journal_active();
        $dars_kunlar = array();
        foreach($journal_active as $ja){
            $dars_kunlar[$ja['og_id']][] = $ja;
        }
        $davomat = $this->teacher_davomat_model->teacher_guruh_davomat($guruh_id, $term);

        $html = '<thead>
                    <tr>
                        <th class="th_first_once" width="120px">';
                            $html .= '<p><i class="fas fa-layer-group"></i> '.$guruh_once['guruh_nomi'].'</p>';
                            $html .= '<span>'.get_week_days($guruh_once['duy'], $guruh_once['sey'], $guruh_once['chor'],$guruh_once['pay'],$guruh_once['juma'],$guruh_once['shan'],$guruh_once['yak']).'</span>';
                            $html .= ' <span class="vaqti"><i class="fa fa-clock"></i> '.date('H:i', strtotime($guruh_once['soat'])).'</span>
                        </th>';
                    for($i=0; $i<12; $i++){
                        $html .= '<th valign="top" align="center">';
                            $html .= '<p>'.($i+1).'</p>';
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
                                $html .= '<i class="ajax_kun">'.date('d.m.Y', strtotime($dars_kunlar[$guruh_id][$i]["kun"])).'</i>';
                            }else{
                                $html .= '<span>&nbsp;</span>';
                                $html .= '<i>&nbsp;</i>';
                            }
                        $html .= '</th>';
                    }
                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                    $html .='<tr>';
                    $j=0; foreach ($davomat as $k =>  $da) {
                        $html .= '<th>';
                            $html .= '<p>'.$da[$j]['last_name']." ".$da[$j]['first_name'].'</p>';
                            $html .= '<span><i class="fas fa-phone"></i> '.phone_format_helper($da[$j]['phone']).'</span>';
                        $html .= '</th>';
                        $j++; for($i=0; $i<12; $i++):
                            $html .= '<td>';
                                 if(isset($da[$i])) {
                                     if(!$da[$i]["status"]) {
                                        $html .= '<i class="fas fa-times"></i>';
                                     } else {
                                        $html .='<i class="fas fa-check"></i>';
                                     }
                                 }
                            $html .= '</td>';
                        endfor;
                    $html .='</tr>';
                    }
                $html .= '</tbody>';

        echo json_encode($html);
    }

}








