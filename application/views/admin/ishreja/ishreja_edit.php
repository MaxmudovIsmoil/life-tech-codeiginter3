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
            <li class="breadcrumb-item active"><a href="<?= site_url("ishreja/") ?>">Ish reja</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content ml-3">
    <?= form_open("", array("class" => "needs-validation","novalidate" => "novalidate")) ?>
      <div class="row">
        <div class="col-md-3 mb-4">
          <label for="mavzu">mavzu</label>
          <input type="text" class="form-control" id="mavzu" name="mavzu" placeholder="" value="<?= set_value("mavzu", $ishreja['mavzu']) ?>" required>
          <div class="invalid-feedback">
            Mavzuni kiriting
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <label for="kurs_id">Kursni tanlang</label>
          <select class="custom-select d-block w-100" id="kurs_id" name="kurs_id">
              <option value="">---</option>
              <?php foreach ($kurslar as $k) { ?>
                <?php if ($k["id"] == $ishreja['kurs_id']): ?>
                  <option selected value="<?= $k["id"]; ?>" <?= set_select('kurs_id', $k["id"]); ?>><?= $k["nomi"] ?></option>
                <?php else: ?>
                  <option value="<?= $k["id"]; ?>" <?= set_select('kurs_id', $k["id"]); ?>><?= $k["nomi"] ?></option>
                <?php endif; ?>
              <?php } ?>
          </select>
        </div>
      </div>
      <button class="col-md-6 btn btn-primary btn-block" type="submit">Saqlash</button>
    <?= form_close(); ?>
  </div>
</div>