<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="card">
  	<div class="card-header">
        <a class="btn btn-primary" href="<?= site_url("courses/kurs_add"); ?>" style="font-weight: bold;">
            <i class="fas fa-plus"></i> Qo'shish
        </a>
  	</div>
    <!-- /.card-header -->
    <div class="card-body">
    	<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
                <th width="7%">№</th>
                <th>Nomi</th>
                <!-- <th>Narxi</th>
                <th>Turi</th> -->
                <th class="text-right">Harakatlar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach ($kurslar as $k => $val): ?>
                <tr>
                    <th><?=$i++; ?></th>
                    <td><?=$val['nomi']; ?></td>
                    <!-- <td><?= number_format($val['price'],0, ',', ' ')." so'm"; ?></td> -->
                    <!-- <td><?= ($val['type'] == 1) ? "Ofline" : "Online"; ?></td> -->
                    <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                            <a href="<?= site_url('courses/kurs_edit/'.$val['id']) ?>" class="btn btn-primary" title="Tahrirlash" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" data-href="<?= site_url("courses/kurs_delet/".$val['id'])?>" class="btn btn-danger js_delete_item" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>
<!-- modal kurs qo'shish -->
<!--<div class="modal fade" id="create_notify" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="create_notifyLabel" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="create_notifyLabel" style="font-weight: bold;">Kurs qo'shish</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        --><?php //form_open("courses/kurs_add", array("class" => "needs-validation","novalidate" => "novalidate")) ?>
<!--          <div class="form-group">-->
<!--            <label for="recipient-name" class="col-form-label">Kurs nomi</label>-->
<!--            <input type="text" class="form-control js_kurs_nomi" id="recipient-name" name="nomi" value="--><?php //set_value("kurs_nomi") ?><!--" required>-->
<!--            <div class="invalid-feedback">-->
<!--              Kurs nomini kiriting-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="modal-footer">-->
<!--            <button type="button" class="btn btn-secondary" data-dismiss="modal">Orqaga</button>-->
<!--            <button type="submit" class="btn btn-primary js_modal_create">Saqlash</button>-->
<!--          </div>-->
<!--        --><?php //form_close(); ?>
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!-- / .modal kurs qo'shish -->

<!-- ####################################################################### -->

