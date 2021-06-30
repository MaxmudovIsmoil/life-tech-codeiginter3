<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mt-2 ml-3"><?= $oquv_group_once['guruh_nomi']; ?></h3>
            </div><!-- /.col -->
            <div class="col-sm-6 pr-3">
                <ol class="breadcrumb float-sm-right" style="background: none;">
                    <li class="breadcrumb-item"><a href="<?= site_url("asos/index"); ?>">Bosh sahifa</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url("oquv_guruh/index"); ?>">Gruhlar</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url("oquv_guruh/oquv_guruh_active/".$kurs_one['id']); ?>"><?= $kurs_one['nomi']; ?></a></li>
                    <li class="breadcrumb-item active"><?= $oquv_group_once['guruh_nomi']; ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="card-header mb-5" style="margin-top: -20px;">

<!--            <a class="btn btn-primary" href="--><?//= site_url("oquv_guruh/oquv_guruh_add/".$kurs_one['id']); ?><!--" style="font-weight: bold;"><i class="fas fa-plus"></i> Guruh yaratish</a>-->
        </div>
        <!-- /.content-header -->

        <div class="card-body">
            <?= form_open_multipart("oquv_guruh/oquv_guruh_view_student_add/", array("class" => "needs-validation", "novalidate" => "novalidate"), array('kurs_id' => $kurs_one['id'], "oquv_group_id" => $oquv_group_once['id'])); ?>
            <div class="row">
                <div class="col-md-3">
                    <h4>Yangi kelganlar</h4>
                </div>
                <div class="col-md-3">
                    <h4>Guruhdagilar</h4>
                </div>
            </div>
            <select id='pre-selected-options' name="student_merger[]" multiple='multiple'>
                    <?php foreach($student_guruh as $k => $sg): ?>
                        <option value="<?= $sg['student_id']?>" <?= (in_array($sg['student_id'], $oquv_group)) ? 'selected' : ""; ?>>
                            <?= $sg['familiya']." ".$sg['ism']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-primary mt-4 mb-5" type="submit">Saqlash</button>
            <?= form_close(); ?>
            <?php
            // echo "<pre>";
            // print_r($oquv_group);
            // echo "</pre>";
            ?>
        </div>
    </div>
</div>