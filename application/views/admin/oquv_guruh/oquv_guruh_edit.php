<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header ml-2">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $oquv_group_once['guruh_nomi']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url("asos/index") ?>">Bosh sahifa</a></li>
                        <li class="breadcrumb-item active"><a href="<?= site_url("oquv_guruh/oquv_guruh_active/".$kurs_one['id']) ?>"><?= $kurs_one['nomi']; ?></a></li>
                        <li class="breadcrumb-item active">Guruh qo'shish</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content ml-3">
        <?php if (isset($message)) {
            // echo "<pre>";
            // print_r($message);
            // echo "</pre>";
        } ?>
        <?= form_open_multipart("oquv_guruh/oquv_guruh_edit/", array("class" => "needs-validation", "novalidate" => "novalidate"), array('status' => 1, "kurs_id" => $kurs_id, "guruh_id"=> $oquv_group_once['id'])) ?>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="teacher_id">O'qituvchini tanlang</label>
                        <select class="custom-select d-block w-100" id="teader_id" name="teacher_id" required>
                            <option value="">---</option>
                            <?php foreach($teacher_kurs as $k => $t_k): ?>
                                <option value="<?= $t_k['id']; ?>" <?= ($oquv_group_once['teacher_id']==$t_k['id']) ? "selected" : ""; ?>><?= $t_k['familiya']." ".$t_k['ism'];?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            Kursni tanlang
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="guruh_nomi">Guruh nomi</label>
                        <input type="text" class="form-control" id="guruh_nomi" name="guruh_nomi" value="<?= $oquv_group_once['guruh_nomi'];?>" required>
                        <div class="invalid-feedback">
                            Guruh nomini kiriting
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tug_yil">Vaqt</label>
                        <input type="time" class="form-control" id="soat" name="soat" value="<?= set_value("soat", $oquv_group_once['soat']) ?>" required>
                        <div class="invalid-feedback">
                            Vaqtni kiriting.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="guruh_nomi">Guruh turi</label>
                        <select class="custom-select d-block w-100" name="turi" id="turi">
                            <option value="0" <?= ($oquv_group_once['turi']== 0) ? "selected" : ""; ?>>Guruh</option>
                            <option value="1" <?= ($oquv_group_once['turi']== 1) ? "selected" : ""; ?>>Indvidual</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <select class="custom-select d-block w-100" name="status" id="status">
                            <option value="1" <?= ($oquv_group_once['status'] == 1) ? "selected" : ""; ?>>Yangi ochilgan</option>
                            <option value="2" <?= ($oquv_group_once['status'] == 2) ? "selected" : ""; ?>>O'qiyotgan</option>
                            <option value="3" <?= ($oquv_group_once['status'] == 3) ? "selected" : ""; ?>>Tugatilgan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="term">Kurs muddati</label>
                        <select class="custom-select d-block w-100" name="term" id="term">
                            <option value=""></option>
                            <option value="1" <?= ($oquv_group_once['term'] == 1) ? "selected" : ""; ?>>1 - Oylik</option>
                            <option value="2" <?= ($oquv_group_once['term'] == 2) ? "selected" : ""; ?>>2 - Oylik</option>
                            <option value="3" <?= ($oquv_group_once['term'] == 3) ? "selected" : ""; ?>>3 - Oylik</option>
                            <option value="4" <?= ($oquv_group_once['term'] == 4) ? "selected" : ""; ?>>4 - Oylik</option>
                            <option value="5" <?= ($oquv_group_once['term'] == 5) ? "selected" : ""; ?>>5 - Oylik</option>
                            <option value="6" <?= ($oquv_group_once['term'] == 6) ? "selected" : ""; ?>>6 - Oylik</option>
                            <option value="7" <?= ($oquv_group_once['term'] == 7) ? "selected" : ""; ?>>7 - Oylik</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 d-block">
                        <h6>Kunlarni tanlang</h6>
                        <div class="custom-control custom-checkbox">
                            <input id="duy" name="duy" type="checkbox" class="custom-control-input" value="1" <?= ($oquv_group_once['duy']== 1) ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="duy">Duyshanba</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input id="sey" name="sey" type="checkbox" class="custom-control-input" value="1" <?= ($oquv_group_once['sey'] == 1) ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="sey">Seyshanba</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input id="chor" name="chor" type="checkbox" class="custom-control-input" value="1" <?= ($oquv_group_once['chor']== 1) ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="chor">Chorshanba</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input id="pay" name="pay" type="checkbox" class="custom-control-input" value="1" <?= ($oquv_group_once['pay']== 1) ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="pay">Payshanba</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input id="juma" name="juma" type="checkbox" class="custom-control-input" value="1" <?= ($oquv_group_once['juma']== 1) ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="juma">Juma</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input id="shan" name="shan" type="checkbox" class="custom-control-input" value="1" <?= ($oquv_group_once['shan']== 1) ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="shan">Shanba</label>
                        </div>
                        <div class="custom-control custom-checkbox" style="color: red">
                            <input id="yak" name="yak" type="checkbox" class="custom-control-input" value="1" <?= ($oquv_group_once['yak']== 1) ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="yak">Yakshanba</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block mt-3 mb-5" type="submit">Saqlash</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>