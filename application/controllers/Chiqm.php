<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chiqm extends Admin_Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('chiqm_model'));
    }

    public function index()
    {
        $this->data['title'] = "Chiqmlar";

        $this->data["chiqm"] = $this->chiqm_model->get_chiqmlar();

        $this->data["expense"] = $this->chiqm_model->get_expense($id = 1);


        $this->data['content'] = "admin/chiqim/index";
        $this->load->view($this->layout, $this->data);
    }

    public function ajax_chiqm($id)
    {
        $chiqm = $this->chiqm_model->get_chiqmlar();

        $expense = $this->chiqm_model->get_expense($id);

        $html = '';
        $i = 1;
        if ($expense) {

            foreach ($expense as $e) {
                $html .= '<tr>
                            <th>' . $i++ . ' </th>
                            <td>' . $e["name"] . '</td>
                            <td>' . format_money($e["price"]) . '</td>
                            <td>' . date("d.m.Y H:i", strtotime($e["created_date"])) . '</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit-modal'.$e['id'].'" title="Taxrirlash" aria-label="Taxrirlash">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" data-href="" class="btn btn-danger js_delete_item" title = "O\'chirish" aria-label = "O\'chirish" data-toggle="modal" data-target="#delete_notify">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <div class="modal fade" id="edit-modal'.$e['id'].'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-modal-Lavel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-modal-Lavel">Chiqm qo\'shish </h5>
                                        <button type = "button" class="close" data-dismiss = "modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action = "'.site_url('chiqm/edit/'.$e['id']).'" method = "post" class="js_edit_form_expense needs-validation" novalidate = "novalidate" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <label for="chiqm_id'.$e['id'].'"> Chiqm turi </label>
                                                    <select type = "text" name = "chiqm_id" id = "chiqm_id'.$e["id"].'" class="form-control" required >
                                                        <option value = "" > ---</option>';
                                                        foreach($chiqm as $ch ):
                                                            $html .='<option value="'.$ch['id'].'"';
                                                             if($e["chiqm_id"] == $ch['id'])
                                                                echo 'selected';
                                                             $html .= '>'. $ch['name'].'</option>';
                                                        endforeach;
                                                    $html .='</select>
                                                    <div class="invalid-feedback">
                                                        Chqim turini tanlang!
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="name'. $e["id"].'">Nomi</label>
                                                    <input type="text" name="name" id="name'. $e["id"].'" class="form-control" value="'.$e['name'].'" required>
                                                    <div class="invalid-feedback">
                                                        Sababini kiriting!
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="price'.$e['id'].'">Summasi</label>
                                                    <input type="text" name="price" id="price'.$e['id'].'" class="form-control" value="'. $e['price'].'" required>
                                                    <div class="invalid-feedback">
                                                        Summani kiriting!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success btn-square js_edit_btn_expense" name="save" value="Saqlash">
                                            <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                          </tr>';
            }
        }
        else{
            $html = '<tr><td colspan="4" class="text-center">Ma\'hsulot mavjud emas<td><tr>';
        }

        echo $html;

    }


    public function add()
    {
        $this->form_validation->set_rules('chiqm_id', "Chiqm turi", 'trim|required');
        $this->form_validation->set_rules('name', "Nomi", 'trim|required');
        $this->form_validation->set_rules('price', "Summasi", 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {
            if($id = $this->chiqm_model->add($this->input->post()))
            {
                redirect("chiqm/", "refresh");
            }
        }
        else
        {
            $this->data["validation_errors"] = $this->form_validation->error_array();
        }
        $this->data['content'] = "admin/chiqm/index";
        $this->load->view($this->layout, $this->data);
    }


    public function edit($id)
    {
        $this->form_validation->set_rules('chiqm_id', "Chiqm turi", 'trim|required');
        $this->form_validation->set_rules('name', "Nomi", 'trim|required');
        $this->form_validation->set_rules('price', "Summasi", 'trim|required');


        if ($this->form_validation->run() == TRUE) {

            $post = array(
                'name'  =>  $this->input->post('name'),
                'price' =>  $this->input->post('price'),
                'chiqm_id'=>  $this->input->post('chiqm_id'),
            );

            if($this->chiqm_model->update($id, $post)){
                echo json_encode(['success' => $post]);
            }
            else
                echo json_encode(['warning' => 'bazaga yozishda xatolik']);

        }
        else
            echo json_encode($this->form_validation->error_array());

    }

    public function kurs_delet($id)
    {
        $result = $this->kurs_model->kurs_delete($id);
        // $result = true;
        echo json_encode($result);
    }
}