<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array("student_model",'kurs_model','user_kurs_model','teacher_model'));
    }

    public function index()
    {
        $this->data['title'] = "O'qiyotgan o'quvchilar";
        $students = $this->student_model->get_students_active();

        // Student malumotlari va qaysi kurslarga qatnashishi
        $student_kurslari = array();
        foreach($students as $k => $student){
            $kurs[$student["user_id"]]["kurs"][$student["kurs_id"]] = $student["kurs_nomi"];
            $student_kurslari[$student['user_id']] = $student;
            $student_kurslari[$student['user_id']]["kurs"] = $kurs[$student["user_id"]]["kurs"];
        }
        $this->data['student_kurslari'] = $student_kurslari;


        $this->data['content'] = "admin/student/index";
        $this->load->view($this->layout, $this->data);
    }

    public function student_view($id, $teacher_id = null, $guruh_id = null){
        $this->data['title'] = "O'quvchi";

        $user = $this->ion_auth->user($teacher_id)->row();
        $this->data['teacher_name'] = $user->ism;
        $this->data['teacher_id'] = $teacher_id;

        if($teacher_id && $guruh_id) {
            $this->data['teacher_group_student'] = $this->teacher_model->get_teacher_group_student($guruh_id);
            $this->data['guruh_nomi'] = $this->data['teacher_group_student'][0]['guruh_nomi'];
            $this->data['guruh_id'] = $this->data['teacher_group_student'][0]['oquv_group_id'];
        }

        $this->data["odamlar"] = $this->student_model->get_student_one($id);

        $user_kurs = $this->student_model->get_student_user_kurs($id);

        $student = array();
        $student_kurslari = array();
        foreach($user_kurs as $key => $val)
        {
            $student = $val;
            $student_kurslari[$val["kurs_id"]] = $val["kurs_nomi"];
        }
        $this->data["student_one"] = $student;
        $this->data["student_kurslari"] = $student_kurslari;

        $this->data['content'] = "admin/student/student_view";
        $this->load->view($this->layout, $this->data);
    }

    public function student_create()
    {
        $this->data['title'] = "O'quvchi qo'shish";
        
        $this->data["kurslar"] = $this->kurs_model->get_kurslar();

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // login
        $prefix = "oq";
        $max_id = $this->student_model->get_max_id();
        $this->load->helper("mix");
        $code = uniqe_code_genetrator($prefix, $max_id);
        $this->data['code'] = $code;


        // validate form input
        $this->form_validation->set_rules('kurs_id[]', 'Kurs id', 'trim');
        $this->form_validation->set_rules('type', 'Shaxs turi', 'trim');

        $this->form_validation->set_rules('familiya', 'Familiya', 'trim|required');
        $this->form_validation->set_rules('ism','Ism', 'trim|required');
        $this->form_validation->set_rules('tug_yil',"Tug'ilgan yil", 'trim|required');
//        if ($identity_column !== 'email')
//        {
//            $this->form_validation->set_rules('identity', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
//            $this->form_validation->set_rules('email', 'trim|valid_email');
//        }

        $this->form_validation->set_rules('telefon', 'Telefon', 'trim');
        $this->form_validation->set_rules('manzil','Manzil', 'trim');
        $this->form_validation->set_rules('jins', 'Jins', 'trim');
        $this->form_validation->set_rules('company','Company', 'trim');
//        $this->form_validation->set_rules('pasport_file', 'Pasport nushasi', 'trim');
//        $this->form_validation->set_rules('status','Status', 'trim');
//        $this->form_validation->set_rules('password','Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
//        $this->form_validation->set_rules('password_confirm','Password_Comfirm', 'required');


        if ($this->form_validation->run() === TRUE)
        {
            // upload pasport file
            $config_pasport['upload_path']          = './upload/student/';
            $config_pasport['allowed_types']        = 'jpg|jpeg|pdf|doc|docx';
            $config_pasport['file_name']            = time();

            $this->load->library('upload', $config_pasport);

            if( !$this->upload->do_upload('pasport_file') )
            {
                $error = array('error' => $this->upload->display_errors());
                $pasport = "";
//                $this->load->view('student/student_create', $error);
            }
            else
            {
                $this->data = array('upload_data' => $this->upload->data());
                $pasport = $this->data["upload_data"]['file_name'];
            }


            $_POST["tug_yil"] = date("Y-m-d", strtotime($this->input->post("tug_yil")));
//            $email = strtolower($this->input->post('email'));
            $email = $code."@gmail.com";
            $identity = ($identity_column === 'email') ? $email : $code;
//            $password = $this->input->post('password');
            $password = '123';


            $additional_data = [
                'familiya'      => $this->input->post('familiya'),
                'ism'           => $this->input->post('ism'),
                'tug_yil'       => $this->input->post('tug_yil'),
                'company'       => $this->input->post('company'),
                'telefon'       => $this->input->post('telefon'),
                'manzil'        => $this->input->post('manzil'),
                'jins'          => $this->input->post('jins'),
                'status'        => 1,
                'pasport_file'  =>  $pasport,
            ];
        }

        $group = array($this->input->post("type"));

        if ($this->form_validation->run() === TRUE && $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $group))
        {
            $user_ids = array();
            for ($i = 0; $i<count($this->input->post('kurs_id')); $i++) {
                $user_ids[$i] = $user_id;
            }
           
            $kurs_ids = $this->input->post('kurs_id');
            $a = array();
            
            for ($i = 0; $i<count($this->input->post('kurs_id')); $i++) {
                $a[$i]  = $this->user_kurs_model->add(array("user_id" => $user_ids[$i], "kurs_id"=> $kurs_ids[$i]));
            }
            if ($a) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("student/student_yangilar", 'refresh');
            }
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['content'] = "admin/student/student_create";
            $this->load->view($this->layout, $this->data);
        }
    }
    
    public function student_edit($id)
    {
        $this->data["title"] = "O'quvchi tahrirlash";
        $this->data["kurslar"] = $this->kurs_model->get_kurslar();
        // user_kurs jadvalidan studentni qaysi kursalrga qatnashayotgani
        $user_kurs = $this->student_model->get_student_user_kurs($id);

        $student = array();
        $student_kurslari = array();
        foreach($user_kurs as $key => $val)
        {
            $student = $val;
            $student_kurslari[$val["id"]][] = $val["kurs_id"];
        }
        $this->data["student_one"] = $student;
        $this->data["student_kurslari"] = $student_kurslari;

        // Login 
        $prefix = "oq";
        $max_id = $this->student_model->get_max_id();
        $this->load->helper("mix");
        $code = uniqe_code_genetrator($prefix, $max_id);
        $this->data['code'] = $code;


        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('familiya',"Familiya" , 'trim|required');
        $this->form_validation->set_rules('ism', "Ism", 'trim|required');
        $this->form_validation->set_rules('tug_yil',"Tug_yil", 'trim|required');
        $this->form_validation->set_rules('telefon',"Telefon", 'trim');
//        $this->form_validation->set_rules('email',"Email", 'trim');
        $this->form_validation->set_rules('manzil',"Manzil", 'trim');
        $this->form_validation->set_rules('company', "Company", 'trim');
        $this->form_validation->set_rules('maqom', "Maqom", 'trim');
        $this->form_validation->set_rules('jins', "Jins", 'trim|required');

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;


        if ($identity_column !== 'email')
        {
            $this->form_validation->set_rules('identity', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'trim|valid_email');
        }

        if (isset($_POST) && !empty($_POST))
        {
            // update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password',"Password", 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm',"Password_Comfirm", 'required');
            }
            if ($this->form_validation->run() === TRUE)
            {
                // upload pasport file
                $config_pasport['upload_path']          = './upload/student/';
                $config_pasport['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
                $config_pasport['file_name']            = time();

                $this->load->library('upload', $config_pasport);

                if( !$this->upload->do_upload('pasport_file')  )
                {
                    $error = array('error' => $this->upload->display_errors());
                    $pasport = "";
                    $this->load->view('admin/student/student_edit', $error);
                }
                else
                {
                    $this->data = array('upload_data' => $this->upload->data());
                    $pasport = $this->data["upload_data"]['file_name'];
                }

                if(empty($pasport))
                    unset($_POST['pasport_file']);
                else
                    $_POST["pasport_file"] = $pasport;


                $this->data = [
                    'familiya'  => $this->input->post('familiya'),
                    'ism'       => $this->input->post('ism'),
                    'tug_yil'   => $this->input->post('tug_yil'),
                    'telefon'   => $this->input->post('telefon'),
                    'manzil'    => $this->input->post('manzil'),
                    'email'     => $this->input->post('email'),
                    'company'   => $this->input->post('company'),
                    'stasut'    => $this->input->post('status'),
                    'jins'      => $this->input->post('jins'),
                    // 'pasport_file' => $this->input->post('pasport_file'),
                ];

                // update the password if it was posted
                if ($this->input->post('password'))
                {
                    $this->data['password'] = $this->input->post('password');
                }

                if($this->student_model->delete_user_kurs($id)) {
                    // kurs uchun
                    $kurs_ids = $this->input->post('kurs_id');
                    $k = array();

                    $user_id = $id;
                    for ($i = 0; $i < count($this->input->post('kurs_id')); $i++) {
                        $k[$i] = $this->student_model->add_user_kurs(array("user_id" => $user_id, "kurs_id" => $kurs_ids[$i]));
                    }
                }

                if($k){
                    // check to see if we are updating the user
                    if ($this->ion_auth->update($id, $this->input->post()))
                    {
                        // redirect them back to the admin page if admin, or to the base url if non admin
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('student/', 'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        $this->redirectUser();
                    }
                }
            }
        }

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        $this->data['content'] = "admin/student/student_edit";
        $this->load->view($this->layout, $this->data);
    }


    public function student_delet($id)
    {
        $result = $this->student_model->student_delete($id);
        echo json_encode($result);
    }


    public function student_yangilar() {
        $this->data['title'] = "Yangi kelgan o'quvchilar";
        $students = $this->student_model->get_students_yangilar();

        // Student malumotlari va qaysi kurslarga qatnashishi
        $student_kurslari = array();
        foreach($students as $k => $student){
            $kurs[$student["user_id"]]["kurs"][$student["kurs_id"]] = $student["kurs_nomi"];
            $student_kurslari[$student['user_id']] = $student;
            $student_kurslari[$student['user_id']]["kurs"] = $kurs[$student["user_id"]]["kurs"];
        }
        $this->data['student_kurslari'] = $student_kurslari;

        $this->data['content'] = "admin/student/student_yangilar";
        $this->load->view($this->layout, $this->data);
    }


    public function student_bitirgan(){
        $this->data['title'] = "Bitirgan o'quvchilar";
        $students = $this->student_model->get_students_bitirgan();

        // Student malumotlari va qaysi kurslarga qatnashishi
        $student_kurslari = array();
        foreach($students as $k => $student){
            $kurs[$student["user_id"]]["kurs"][$student["kurs_id"]] = $student["kurs_nomi"];
            $student_kurslari[$student['user_id']] = $student;
            $student_kurslari[$student['user_id']]["kurs"] = $kurs[$student["user_id"]]["kurs"];
        }
        $this->data['student_kurslari'] = $student_kurslari;

        $this->data['content'] = "admin/student/student_bitirgan";
        $this->load->view($this->layout, $this->data);
    }


    public function student_payment($id) {
        var_dump($id);

        $user = $this->ion_auth->user($id)->row();
        $this->data['last_name'] = $user->ism;
        $this->data['first_name'] = $user->familiya;
        $this->data['studnet_id'] = $id;

        $this->data['title'] =  $user->familiya." ".$user->ism;

        $this->data['student_course'] = $this->student_model->student_course_for_payment($id);


        $this->data['content'] = "admin/student/student_payment";
        $this->load->view($this->layout, $this->data);
    }

    public function student_payment_pay($id){
        $user = $this->ion_auth->user($id)->row();
        $this->data['studnet_id'] = $id;

        $this->data['title'] = "To`lov qilish";
        $this->data['content'] = "admin/student/payment";
        $this->load->view($this->layout, $this->data);
    }

    /** Androidga user login parolni tekshirib true bolsa malumot berish **/
    public function check_user() {

    }

}

?>