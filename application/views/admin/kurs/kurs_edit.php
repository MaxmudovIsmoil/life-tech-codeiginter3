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
            <h1 class="m-0 text-dark"><?= $title; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url("asos/index") ?>">Bosh sahifa</a></li>
              <li class="breadcrumb-item active"><a href="<?= site_url("courses/") ?>">Kurslar</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <div class="content ml-3">
    <div class="row">
      <div class="col-md-12">
        <?= form_open("", array("class" => "needs-validation","novalidate" => "novalidate"), array("id" => $kurs_one["id"])) ?>
          <div class="row">
            <div class="col-md-4 mb-4">
              <label for="nomi">Nomi</label>
              <input type="text" class="form-control" id="nomi" name="nomi" value="<?= set_value("nomi", $kurs_one["nomi"]) ?>" required>
              <div class="invalid-feedback">
                Kurs nomini kiriting
              </div>
                <!-- <label for="price" class="mt-3">Narxi</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="" value="<?= set_value("price", $kurs_one['price']) ?>" required>
                <div class="invalid-feedback">
                    Kurs narxini kiriting
                </div>
                <label for="type" class="mt-3">Turi <span style="font-size: 12px; color: #0c5460">(ofline / online)</span></label>
                <select name="type" id="type" class="form-control">
                    <option value="1" <?= ($kurs_one['type'] == 1) ? "selected" : ''; ?>>ofline</option>
                    <option value="2" <?= ($kurs_one['type'] == 2) ? "selected" : ''; ?>>online</option>
                </select> -->
              <button class=" mt-4 btn btn-primary btn-block" type="submit">Saqlash</button>
            </div>
          </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>