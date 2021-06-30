<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">

        <div class="btn-group mr-3 ml-3 mt-2" role="group" aria-label="Basic example">
            <?php foreach($chiqm as $k => $ch): ?>
                <a href="<?= site_url('chiqm/ajax_chiqm/'.$ch['id']); ?>" class="btn js_btn_chiqm btn-secondary"><?= $ch['name']; ?></a>
            <?php endforeach; ?>
        </div>

        <div class="card-header">

            <button type="button" class="btn btn-primary js_create_item" data-toggle="modal" data-target="#add-model" style="font-weight: bold;">
                <i class="fas fa-plus"></i> Qo'shish
            </button>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Nomi</th>
                    <th>Summasi</th>
                    <th>Sanasi</th>
                    <th class="text-right">Harakatlar</th>
                </tr>
                </thead>
                <tbody class="js_tbody">

                    <?php $i = 1; foreach($expense as $k => $e): ?>
                        <div class="this_parent">
                            <tr class="js_this_tr">
                                <th><?= $i++; ?></th>
                                <td><?= $e['name']; ?></td>
                                <td><?= format_money($e['price']); ?></td>
                                <td><?= date("d.m.Y H:i", strtotime($e['created_date'])); ?></td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit-modal<?= $e['id']; ?>" title="Taxrirlash" aria-label="Taxrirlash">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" data-href="<?= site_url("chiqim/chiqim_delet/")?>" class="btn btn-danger js_delete_item" title="O'chirish" aria-label="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="edit-modal<?= $e['id']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-modal-Lavel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-modal-Lavel">Chiqm qo'shish</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= site_url('chiqm/edit/'.$e['id']); ?>" method="post" class="js_edit_form_expense needs-validation" novalidate="novalidate" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <label for="chiqm_id<?= $e['id']; ?>">Chiqm turi</label>
                                                    <select type="text" name="chiqm_id" id="chiqm_id<?= $e['id']; ?>" class="form-control" required>
                                                        <option value="">---</option>
                                                        <?php foreach($chiqm as $ch ): ?>
                                                            <option value="<?= $ch['id']; ?>" <?= ($e['chiqm_id'] == $ch['id']) ? 'selected': ''; ?>><?= $ch['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Chqim turini tanlang!
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="name<?= $e['id']; ?>">Nomi</label>
                                                    <input type="text" name="name" id="name<?= $e['id']; ?>" class="form-control" value="<?= $e['name']; ?>" required>
                                                    <div class="invalid-feedback">
                                                        Sababini kiriting!
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="price<?= $e['id']; ?>">Summasi</label>
                                                    <input type="text" name="price" id="price<?= $e['id']; ?>" class="form-control" value="<?= $e['price']; ?>" required>
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
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">Chiqm qo'shish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?= form_open("chiqm/add", array("class" => "needs-validation","novalidate" => "novalidate")) ?>
                 <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="chiqm_id">Chiqm turi</label>
                            <select type="text" name="chiqm_id" id="chiqm_id" class="form-control" required>
                                <option value="">---</option>
                                <?php foreach($chiqm as $ch ): ?>
                                    <option value="<?= $ch['id']; ?>"><?= $ch['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Chqim turini tanlang!
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="name">Nomi</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                            <div class="invalid-feedback">
                                Sababini kiriting!
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="price">Summasi</label>
                            <input type="text" name="price" id="price" class="form-control" required>
                            <div class="invalid-feedback">
                                Summani kiriting!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-square">Saqlash</button>
                    <button type="button" class="btn btn-secondary js_modal_closeBtn btn-square" data-dismiss="modal">Bekor qilish</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
