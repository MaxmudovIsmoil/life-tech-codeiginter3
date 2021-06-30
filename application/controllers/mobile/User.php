<?php 

class User extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model(array('mobile_model'));
	}

	public function login()
    {
        $response = array("errors" => false, "logged_in" => false,  'message' => "", "data" => array());

        // validate form input
//        $this->form_validation->set_rules('identity', str_replace(':', '', "Login"), 'required');
//        $this->form_validation->set_rules('password', str_replace(':', '', "Password"), 'required');

//        if ($this->form_validation->run() === TRUE)
//        {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool)$this->input->get('remember');

            $this->session->login = $this->input->get('identity');

            if ($this->ion_auth->login($this->input->get('identity'), $this->input->get('password'), $remember))
            {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $response["logged_in"] = true;


                $user = $this->ion_auth->user()->row();
                $user_data = $this->mobile_model->student_data($this->session->login);
                unset($user->password);

                $checkStudentLesson = $this->mobile_model->checkStudentLessons('oq0249');

                $arr = array();
                if (!$checkStudentLesson) {

                    foreach ($user_data as $k => $ud) {
                        $arr[$k]['student']['login'] = $ud['username'];
                        $arr[$k]['student']['familiya'] = $ud['familiya'];
                        $arr[$k]['student']['ism'] = $ud['ism'];
                        $arr[$k]['student']['telefon'] = $ud['telefon'];

                        $arr[$k]['kurs']['kurs_id'] = $ud['kurs_id'];
                        $arr[$k]['kurs']['kurs_nomi'] = $ud['kurs_nomi'];
                        $arr[$k]['kurs']['kurs_narx'] = $ud['kurs_narx'];
                        $arr[$k]['kurs']['guruh']['id'] = $ud['guruh_id'];
                        $arr[$k]['kurs']['teacher_ism'] = $ud['t_ism'];
                        $arr[$k]['kurs']['teacher_fam'] = $ud['t_familiya'];
                        $arr[$k]['kurs']['teacher_telefon'] = $ud['t_telefon'];

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
                }
                else{
                    $arr['kurslar'] = $this->mobile_model->kurslar();
                    $arr['tanlangaKurslar'] = $this->mobile_model->kursTanlagan($this->session->login);
                }

                $response["data"] = $arr;
                

//                    array(
//                    "last_name" => "Mirzakulov",
//                    "first_name" => "Abdurahmon",
//                    "kurslari" => array("Web Dasturlash"),
//                    "teacher" => "Maxmudov Ismoilxon",
//                    "kurs_time" => "14:00"
//                );

            }
            else
            {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $response["errors"] = $this->ion_auth->errors();
                $response["message"] = "login yoki parol xato";
            }
//        }
//        else
//        {
//            // the user is not logging in so display the login page
//            // set the flash data error message if there is one
//            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
//
//            $response["errors"] = $this->data['message'];
//
//        }


        echo json_encode($response);
    }

    public function logout()
    {
        $this->data['title'] = "Logout";

        // log the user out
        $this->ion_auth->logout();

        // redirect them to the login page
        redirect('user/login', 'refresh');
    }
}


?>