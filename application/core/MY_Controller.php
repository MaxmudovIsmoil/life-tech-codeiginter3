<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $data = [];
    public $layout;
     
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->lang->load('auth','english');
        // $this->load->library(['ion_auth', 'form_validation']);
        // $this->load->model('oquv_guruh_model');

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

//        $this->lang->load('auth');
        $this->layout = 'admin/layout/dashboard';
    }


    public function _render_page($view, $data = NULL, $returnhtml = FALSE)
    {
        $viewdata = (empty($data)) ? $this->data : $data;
        $view_html = $this->load->view($view, $viewdata, $returnhtml);
        // This will return html on 3rd argument being true
        if ($returnhtml)
        {
            return $view_html;
        }
    }
}

class Admin_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in()) {
          redirect('user/login', 'refresh');
        }

        if (!$this->ion_auth->is_admin()) {
//            show_error('You must be an administrator to view this page.');
            redirect('teachers/Teacher_davomat/', 'refresh');
        }

    }

    /* Redirect a user checking if is admin */
    public function redirectUser(){
        if ($this->ion_auth->is_admin()){
            redirect('asos/', 'refresh');
        }
        redirect('/', 'refresh');
    }
}

class Teacher_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
//        $this->load->model('oquv_guruh_model','teacher_model');
        $this->load->library('ion_auth');
        $this->layout_teacher   = 'teacher/layout/main';

        if (!$this->ion_auth->logged_in()) {
            redirect('user/login', 'refresh');
        }

        if (!$this->ion_auth->in_group(2)) {
//            show_error("Teacher emas");
            redirect('user/login', 'refresh');
        }

    }
}

class Public_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
}

?>