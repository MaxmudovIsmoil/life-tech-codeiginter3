<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array("student_model", 'payment_model'));
    }
    // public function index(){
        
    //     $this->data['title'] = "To`lov qilish";

    //     $this->data['content'] = "admin/student/payment";
    //     $this->load->view($this->layout, $this->data);
    // }

    public function pay(){
        $this->form_validation->set_rules('selectoy', 'Oy', 'trim|required');
        $this->form_validation->set_rules('summa', 'Summa', 'trim|required');

        if ($this->form_validation->run() === TRUE)
        {
            $tolov = [
                'oyga' => $this->input->post('selectoy'),
                'sum' => $this->input->post('summa'),
                'date' => date('Y-m-d H:i:s'),
                'user_id' => $data['user_id'],
               
            ];
            var_dump($tolov);
            // if($this->payment_model->pay($tolov)){
				// redirect("", "refresh");
            // }
        }
        
		}
		// else {
		// 	$this->data["validation_errors"] = $this->form_validation->error_array();
        // }
    

}
?>