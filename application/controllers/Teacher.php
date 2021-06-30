<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("teacher_model","ishreja_model",'kurs_model', 'user_kurs_model'));
    }

    public function index()
    {
        $this->data['title'] = "O'qtuvchilar";
        $teachers = $this->teacher_model->get_teachers();

        // O'qitucvhi malumotlari va qaysi kurslardan dars o'tishi
        $teacher_kurslari = array();
        foreach($teachers as $k => $teacher){
            $kurs[$teacher["teacher_id"]]["kurs"][$teacher["kurs_id"]] = $teacher["kurs_nomi"];
            $teacher_kurslari[$teacher['teacher_id']] = $teacher;
            $teacher_kurslari[$teacher['teacher_id']]["kurs"] = $kurs[$teacher["teacher_id"]]["kurs"];
        }
        $this->data['teachers'] = $teacher_kurslari;

        $this->data['content'] = "admin/teacher/index";
        $this->load->view($this->layout, $this->data);  
    }

    public function teacher_view($id)
    {
        $user_kurs = $this->teacher_model->get_teacher_user_kurs($id);

        $teacher = array();
        $teacher_kurslari = array();
        foreach($user_kurs as $key => $val)
        {
            $teacher = $val;
            $teacher_kurslari[$val["kurs_id"]] = $val["kurs_nomi"];
        }

        $this->data["teacher_one"] = $teacher;
        $this->data["teacher_kurslari"] = $teacher_kurslari;

        $this->data['title'] = "O'qtuvchi ".$teacher['ism'];
        $this->data['content'] = "admin/teacher/teacher_view";
        $this->load->view($this->layout, $this->data);  
    }

    public function teacher_create()
    {
        $this->data["title"] = "O'qtuvchi qo'shish";
        $this->data["kurslar"] = $this->kurs_model->get_kurslar();

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // login
        $prefix = "tech";
        $max_id = $this->teacher_model->get_max_id();
        $this->load->helper("mix");
        $code = uniqe_code_genetrator($prefix, $max_id);
        $this->data['code'] = $code;


        // validate form input
        $this->form_validation->set_rules('kurs_id[]', 'Kurs id', 'trim');
        $this->form_validation->set_rules('type', 'Shaxs turi', 'trim');

        $this->form_validation->set_rules('familiya', 'Familiya', 'trim|required');
        $this->form_validation->set_rules('ism','Ism', 'trim|required');
        $this->form_validation->set_rules('tug_yil',"Tug'ilgan yil", 'trim|required');
        if ($identity_column !== 'email')
        {
            $this->form_validation->set_rules('identity', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'trim');
        }

        $this->form_validation->set_rules('telefon', 'Telefon', 'trim');
        $this->form_validation->set_rules('manzil','Manzil', 'trim');
        $this->form_validation->set_rules('malumoti', 'Malumoti', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('jins', 'Jins', 'trim');
        $this->form_validation->set_rules('company','Company', 'trim');
        $this->form_validation->set_rules('email','Email', 'is_unique[users.email]');
        $this->form_validation->set_rules('password','Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm','Password_Comfirm','required');

        if ($this->form_validation->run() === TRUE)
        {
            // upload pasport file 
            $config_pasport['upload_path']          = './upload/teacher/';
            $config_pasport['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
            $config_pasport['file_name']            = time();

            $this->load->library('upload', $config_pasport);

            if( !$this->upload->do_upload('pasport_file') )
            {
                $error = array('error' => $this->upload->display_errors());
                $pasport = "";
                $this->load->view('admin/teacher/teacher_create', $error);
            }
            else
            {
                $this->data = array('upload_data' => $this->upload->data());
                $pasport = $this->data["upload_data"]['file_name'];
            }

            // upload photo file
            $config_photo['upload_path']          = './upload/teacher/';
            $config_photo['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
            $config_photo['file_name']            = time();

            $this->load->library('upload', $config_photo);

            if( !$this->upload->do_upload('photo_file') )
            {
                $error = array('error' => $this->upload->display_errors());
                $photo = "";
                $this->load->view('admin/teacher/teacher_create', $error);
            }
            else
            {
                $this->data = array('upload_data' => $this->upload->data());
                $photo = $this->data["upload_data"]['file_name'];
            }

            $_POST["tug_yil"]= date("Y-m-d", strtotime($this->input->post("tug_yil")));
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $code;
            $password = $this->input->post('password');

            $additional_data = [
                'familiya'      => $this->input->post('familiya'),
                'ism'           => $this->input->post('ism'),
                'tug_yil'       => $this->input->post('tug_yil'),
                'company'       => $this->input->post('company'),
                'telefon'       => $this->input->post('telefon'),
                'manzil'        => $this->input->post('manzil'),
                'status'        => $this->input->post('status'),
                'malumoti'      => $this->input->post('malumoti'),
                'jins'          => $this->input->post('jins'),
                'pasport_file'  =>  $pasport,
                'photo_file'    =>  $photo,
            ];
        }   

        $group = array($this->input->post("type"));

        if ($this->form_validation->run() === TRUE && $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $group))
        {
            // kurs uchun 
            $kurs_ids = $this->input->post('kurs_id');
            $k = array();
            
            for ($i = 0; $i<count($this->input->post('kurs_id')); $i++) {
                $k[$i]  = $this->user_kurs_model->add(array("user_id" => $user_id, "kurs_id" => $kurs_ids[$i]));
            }

            if ($k) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("teacher/", 'refresh');
            }
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['content'] = "admin/teacher/teacher_create";
            $this->load->view($this->layout, $this->data);  

        }
    }

    public function teacher_edit($id)
    {
        $this->data["kurslar"] = $this->kurs_model->get_kurslar();

        // user_kurs jadvalidan teacher ni qaysi kursalrga kirayotgani
        $user_kurs = $this->teacher_model->get_teacher_user_kurs($id);

        $teacher = array();
        $teacher_kurslari = array();
        foreach($user_kurs as $key => $val)
        {
            $teacher = $val;    
            $teacher_kurslari[$val["id"]][] = $val["kurs_id"];
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();


        $this->data["teacher_one"] = $teacher;
        $this->data["teacher_kurslari"] = $teacher_kurslari;
        $this->data['title'] = "O'qtuvchi ".$user->ism." tahrirlash";

        // validate form input
        $this->form_validation->set_rules('familiya',"Familiya",'trim|required');
        $this->form_validation->set_rules('ism', "Ism", 'trim|required');
        $this->form_validation->set_rules('telefon',"Telefon", 'trim');
        $this->form_validation->set_rules('tug_yil',"Tug_yil", 'trim|required');
        $this->form_validation->set_rules('jins', "Jins", 'trim|required');
        $this->form_validation->set_rules('email',"Email", 'trim');
        $this->form_validation->set_rules('manzil',"Manzil", 'trim');
        $this->form_validation->set_rules('status', "status", 'trim');
        $this->form_validation->set_rules('malumoti', "Malumoti", 'trim');
        $this->form_validation->set_rules('company', "Ish joyi", 'trim');

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        if ($identity_column !== 'email')
        {
            $this->form_validation->set_rules('identity', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'trim');
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
                $config_pasport['upload_path']          = './upload/teacher/';
                $config_pasport['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
                $config_pasport['file_name']            = time();

                $this->load->library('upload', $config_pasport);

                if( !$this->upload->do_upload('pasport_file')  )
                {
                    $error = array('error' => $this->upload->display_errors());
                    $pasport = "";
                    $this->load->view('admin/teacher/teacher_edit', $error);
                }
                else
                {
                    $this->data = array('upload_data' => $this->upload->data());
                    $pasport = $this->data["upload_data"]['file_name'];
                }
                /** Parport nusxasi uchun */
                if(empty($pasport)) 
                    unset($_POST["pasport_file"]);
                else 
                    $_POST["pasport_file"] = $pasport;

                // upload Photo file
                $config_photo['upload_path']          = './upload/teacher/';
                $config_photo['allowed_types']        = 'jpg|jpeg|png|pdf';
                $config_photo['file_name']            = time();

                $this->load->library('upload', $config_pasport);

                if( !$this->upload->do_upload('photo_file')  )
                {
                    $error = array('error' => $this->upload->display_errors());
                    $photo = "";
                    $this->load->view('admin/teacher/teacher_edit', $error);
                }
                else
                {
                    $this->data = array('upload_data' => $this->upload->data());
                    $photo = $this->data["upload_data"]['file_name'];
                }
                /** Rasm uchun  */
                if(empty($photo))
                    unset($_POST["photo_file"]);
                else
                    $_POST["photo_file"] = $photo;

                $_POST["tug_yil"]= date("Y-m-d", strtotime($this->input->post("tug_yil")));
                // update the password if it was posted
                if ($this->input->post('password')) {
                    $this->data['password'] = $this->input->post('password');
                }

                if($this->teacher_model->delete_user_kurs($id)) {

                    // kurs uchun
                    $kurs_ids = $this->input->post('kurs_id');
                    $k = array();

                    $user_id = $id;
                    for ($i = 0; $i < count($this->input->post('kurs_id')); $i++) {
                        $k[$i] = $this->teacher_model->add_user_kurs(array("user_id" => $user_id, "kurs_id" => $kurs_ids[$i]));
                    }
                }

                if ($k) {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

                    if ($this->ion_auth->update($id, $this->input->post())) {
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('teacher/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        $this->redirectUser();
                    }
                }

            }   
        }
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['content'] = "admin/teacher/teacher_edit";
            $this->load->view($this->layout, $this->data);
        }
    }

    public function teacher_delet($id)
    {
        $result = $this->teacher_model->teacher_delete($id);
        echo json_encode($result);
    }

    /** O'qituvchini guruhlari */
    public function teacher_guruh($teacher_id)
    {
        $user = $this->ion_auth->user($teacher_id)->row();
        $this->data['teacher_id'] = $user->id;
        $this->data['teacher_name'] = $user->ism;
        $this->data['title'] = "O'qituvchi ";

        $teacher_groups_all = $this->teacher_model->get_teacher_groups($teacher_id);

        $teacher_group = array();
        foreach($teacher_groups_all as $k => $teacher){
            $guruh[$teacher["id"]]["guruh"][$teacher["student_id"]] = $teacher["student_id"];
            $teacher_group[$teacher['id']] = $teacher;
            unset($teacher_group[$teacher['teacher_id']]['student_id']);
            $teacher_group[$teacher['id']]["guruh"] = $guruh[$teacher["id"]]["guruh"];
        }
        $this->data['teacher_groups'] = $teacher_group;

        $this->data['content'] = "admin/teacher/teacher_guruh";
        $this->load->view($this->layout, $this->data);
    }

    public function ajax_teacher_group_student($teacher_id, $guruh_id)
    {
        $teacher_group_student = $this->teacher_model->get_teacher_group_student($guruh_id);

        $html = '<thead class="bg-info">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Familiya</th>
                        <th scope="col">Ism</th>
                        <th scope="col">Telefon nomer</th>
                    </tr>
                 </thead>
				 <tbody>';

        foreach($teacher_group_student as $k => $l){
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
