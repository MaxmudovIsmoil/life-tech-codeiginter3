<?php 

class User extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
    {
        // $this->ion_auth->update(1, array("password" => 'admin'));

        $this->data['title'] = $this->lang->line('login_heading');

        // validate form input
        $this->form_validation->set_rules('identity', str_replace(':', '', "Login"), 'required');
        $this->form_validation->set_rules('password', str_replace(':', '', "Password"), 'required');

        if ($this->form_validation->run() === TRUE)
        {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool)$this->input->post('remember');

            $this->session->login = $this->input->post('identity');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
            {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('asos/', 'refresh');
            }
            else
            {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('user/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
        else
        {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->_render_page('admin/layout/' . DIRECTORY_SEPARATOR . 'login', $this->data);
        }
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