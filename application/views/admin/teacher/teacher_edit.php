<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header ml-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Kurs turi</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url("asos/index") ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url("teacher/") ?>">Teacher</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content ml-3">
    <div class="row">
        <div class="col-md-8 order-md-1">
            <?= form_open_multipart("", array("class" => "needs-validation", "novalidate" => "novalidate"), array("teacher_one_id" => $teacher_one['id'])) ?>
            <div class="d-block mb-3">
              <?php foreach ($kurslar as $key => $k): ?>
                <div class="custom-control custom-checkbox">
                  <input id="kurs<?= ++$key; ?>" name="kurs_id[]" type="checkbox" class="custom-control-input" value="<?=$k["id"]; ?>" <?= set_radio('kurs_id', $k["id"], (in_array($k["id"], $teacher_kurslari[$teacher_one["id"]]) ? TRUE:FALSE)); ?>>
                  <label class="custom-control-label" for="kurs<?= $key ?>"><?= $k["nomi"]; ?></label>
                </div>
              <?php endforeach; ?>
            </div>  

            <hr class="mb-2">
            <h4 class="">Shaxs Ma'lumotlar</h4>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="familiya">Familiya</label>  <i>*</i>
                <input type="text" class="form-control" id="familiya" name="familiya" placeholder="" value="<?= set_value("familiya",$teacher_one['familiya']); ?>" required>
                <div class="invalid-feedback">
                  Familiyani kiriting
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="ism">Ism</label>  <i>*</i>
                <input type="text" class="form-control" id="ism" name="ism" placeholder="" value="<?= set_value("ism",$teacher_one['ism']); ?>" required>
                <div class="invalid-feedback">
                    Ismni kiriting.
                </div>
              </div> 
              <div class="col-md-4 mb-3">
                <label for="telefon">Telefon</label>  <i>*</i>
                <input type="text" class="form-control" id="telefon" name="telefon" value="<?= set_value("telefon", $teacher_one['telefon']); ?>" required>
                <div class="invalid-feedback">
                  Telefon raqamini kiriting
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="tug_yil">Tu'gilgan sana</label> <i>*</i>
                <input type="text" class="form-control" id="tug_yil" name="tug_yil" value="<?= date("d.m.Y", strtotime($teacher_one['tug_yil'])); ?>" required>
                <div class="invalid-feedback">
                  Tug'ilgan sanani kiriting.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="jins">Jins</label>  <i>*</i>
                <select class="custom-select d-block w-100" id="jins" name="jins" required>
                  <option value="1" <?= $teacher_one['jins']==1 ? "selected" : "";?> >Erkak</option>
                  <option value="2" <?= $teacher_one['jins']==2 ? "selected" : "";?> >Ayol</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="pasport_file">Pasport nusxas</label> <i>*</i>
                <div class="custom-file">
                  <input type="file" name="pasport_file" multiple="true" class="custom-file-input" id="customFile" value="<?= set_value("pasport_file") ?>">
                  <label class="custom-file-label" for="customFile"><?= $teacher_one['pasport_file'] ?></label>
                  <div class="invalid-feedback">pasportni yuklang</div>
                </div>
              </div>
            </div>
            <span class="text-muted"><i>* majburiy</i></span>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?= set_value("email",$teacher_one['email']); ?>">
                <div class="invalid-feedback">
                  Emailni kiriting.
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <label for="manzil">Manzil</label>
                  <input type="text" class="form-control" id="manzil" name="manzil" placeholder="1234 Main St" value="<?= set_value("manzil",$teacher_one['manzil']); ?>">
              </div>
              <div class="col-md-4 mb-3">
                  <label for="pasport_file">Rasm</label>
                  <div class="custom-file">
                      <input type="file" name="photo_file" class="custom-file-input" id="customFile" >
                      <label class="custom-file-label" for="customFile"><?= $teacher_one['photo_file'] ?></label>
                      <div class="invalid-feedback">Rasmni yuklang</div>
                  </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="status">status</label>
                  <select class="custom-select d-block w-100" id="status" name="status">
                      <option value="2" <?= $teacher_one['status']==2 ? "selected": "";?>>Faol</option>
                      <option value="3" <?= $teacher_one['status']==3 ? "selected": "";?>>Nofaol</option>
                  </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="malumoti">Ma'lumot</label>
                  <select class="custom-select d-block w-100" id="malumoti" name="malumoti">
                    <option value="2" <?= $teacher_one['malumoti']==2 ? "selected": "";?>>Oliy</option>
                    <option value="1" <?= $teacher_one['malumoti']==1 ? "selected": "";?>>O'rta</option>
                  </select>
              </div>
              <div class="col-lg-4 mb-3">
                <label for="company">Ishi yoki o'qish nomi</label>
                <input type="text" name="company" id="company" class="form-control" value="<?= set_value('company',$teacher_one['company']); ?>">
              </div>            
            </div>

            <div class="row">
              <?php if($identity_column!=='email') : ?>
                  <div class="col-md-4">
                    <label for='identity'>Login</label>
                    <?php form_error('identity'); ?>
                    <input type="text" name="identity" id="identity" class="form-control" value="<?= set_value('identity',$teacher_one['username']); ?>" readonly>
                    <div class="invalid-feedback">
                      Loginni kiriting.
                    </div>  
                  </div>
                <?php endif; ?>
              <div class="col-md-4">
                <label for="password">Parol yangilash</label>
                <input type="password" name="password" id="password" class="form-control" value="<?=set_value('password'); ?>" >
                <div class="invalid-feedback">
                  Parolni kiriting.
                </div>
              </div>
              <div class="col-md-4">
                <label for="password_confirm">Parolni tasdiqlang</label>
                <input type="password" name="password_confirm" class="form-control" id="password_confirm" value="<?= set_value('password_confirm'); ?>" >
                <div class="invalid-feedback">
                  parolni qaytadan kiriting.
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-block mt-4 mb-5" type="submit">Saqlash</button>
            <?= form_close(); ?>
        </div>
    </div>
  </div>
</div>
