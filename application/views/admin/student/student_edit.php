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
            <h1 class="m-0 text-dark">Kurs turi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url("asos/index") ?>">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url("student/") ?>">Student</a></li>
            </ol>
          </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content ml-3">
    <div class="row">
        <div class="col-md-8 order-md-1">
            <?= form_open_multipart("", array("class" => "needs-validation", "novalidate" => "novalidate"), array("student_one_id" => $student_one['id'])) ?>

            <div class="d-block">
              <?php foreach ($kurslar as $key => $k): ?>
                <div class="custom-control custom-checkbox">
                   <input id="kurs<?= ++$key ?>" name="kurs_id[]" type="checkbox" class="custom-control-input" value="<?=$k["id"]; ?>" <?= set_radio('kurs_id', $k["id"], (in_array($k["id"], $student_kurslari[$student_one["id"]]) ? TRUE:FALSE)); ?>>
                  <label class="custom-control-label" for="kurs<?= $key ?>"><?= $k["nomi"]; ?></label>
                </div>
              <?php endforeach; ?>
            </div>

            <hr class="mb-3">
            <h4 class="mb-2">Shaxs Ma'lumotlari</h4>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="familiya">Familiya</label> <i>*</i>
                <input type="text" class="form-control" id="familiya" name="familiya" placeholder="" value="<?= set_value("familiya",$student_one['familiya']); ?>" required>
                <div class="invalid-feedback">
                    Familiyani kiriting
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="ism">Ism</label>  <i>*</i>
                <input type="text" class="form-control" id="ism" name="ism" placeholder="" value="<?= set_value("ism",$student_one['ism']); ?>" required>
                <div class="invalid-feedback">
                    Ismni kiriting.
                </div>
              </div> 
              <div class="col-md-4 mb-3">
                <label for="telefon">Telefon</label> <i>*</i>
                <input type="text" class="form-control" id="telefon" name="telefon" value="<?= set_value("telefon", $student_one['telefon']); ?>" required>
                <div class="invalid-feedback">
                  Telefon raqamini kiriting
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="tug_yil">Tu'gilgan sana</label> <i>*</i>
                <input type="text" class="form-control" id="tug_yil" name="tug_yil" value="<?= set_value("tug_yil",$student_one['tug_yil']); ?>" required>
                <div class="invalid-feedback">
                  Tug'ilgan sanani kiriting.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="jins">Jins</label>  <i>*</i>
                <select class="custom-select d-block w-100" id="jins" name="jins" required>
                  <option <?php if ($student_one['jins']==1): echo "selected"; endif ?>
                  value="1" <?= set_select('jins', 1); ?>>Erkak</option>
                  <option <?php if ($student_one['jins']==2): echo "selected"; endif ?>
                  value="2" <?= set_select('jins', 2); ?>>Ayol</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="email">Pasport nusxasi</label> <i>*</i>
                <div class="custom-file">
                  <input type="file" name="pasport_file" multiple="true" class="custom-file-input" id="customFile" value="<?= set_value("pasport_file") ?>" >
                  <label class="custom-file-label" for="customFile"><?= $student_one['pasport_file'] ?></label>
                  <div class="invalid-feedback">pasportni yuklang</div>
                </div>
              </div>
            </div>
            <span class="text-muted"><i>* majburiy</i></span>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="maqom">Maqom</label>
                    <select class="custom-select d-block w-100" name="status" id="maqom">
                        <option value="1" <?= ($student_one['status']==1)? "selected": "";?>>Yangi kelgan</option>
                        <option value="2" <?= ($student_one['status']==2)? "selected": "";?> >O'qiyapdi</option>
                        <option value="3" <?= ($student_one['status']==3)? "selected": "";?> >Bitirgan</option>
                    </select>
                </div>
<!--                <div class="col-md-4 mb-3">-->
<!--                <label for="email">Email</label>-->
<!--                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="--><?//= set_value("email",$student_one['email']); ?><!--">-->
<!--                    <div class="invalid-feedback">-->
<!--                      Emailni kiriting.-->
<!--                    </div>-->
<!--              </div>-->
                <div class="col-md-4 mb-3">
                <label for="manzil">Manzil</label>
                <input type="text" class="form-control" id="manzil" name="manzil" value="<?= set_value("manzil",$student_one['manzil']); ?>">
              </div> 
                <div class="col-md-4 mb-3">
                <label for="company">Ishi yoki o'qish nomi</label>
                <input type="text" name="company" id="company" class="form-control" value="<?= set_value('company',$student_one['company']); ?>">
              </div>
            </div>

<!--            <div class="row">-->
<!--              --><?php //if($identity_column!=='email') : ?>
<!--                <div class="col-md-4">-->
<!--                  <label for='identity'>Login</label>-->
<!--                  --><?php //form_error('identity'); ?>
<!--                  <input type="text" name="identity" id="identity" class="form-control" value="--><?//= set_value('identity',$student_one['username']); ?><!--" disabled>-->
<!--                  <div class="invalid-feedback">-->
<!--                    Loginni kiriting.-->
<!--                  </div>  -->
<!--                </div>-->
<!--              --><?php //endif; ?>
<!---->
<!--              <div class="col-md-4">-->
<!--                <label for="password">Parol</label>-->
<!--                <input type="password" name="password" id="password" class="form-control" value="--><?//=set_value('password'); ?><!--" >-->
<!--                <div class="invalid-feedback">-->
<!--                  Parolni kiriting.-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="col-md-4">-->
<!--                <label for="password_confirm">Parolni tasdiqlang</label>-->
<!--                <input type="password" name="password_confirm" class="form-control" id="password_confirm" value="--><?//= set_value('password_confirm'); ?><!--" >-->
<!--                <div class="invalid-feedback">-->
<!--                  parolni qaytadan kiriting.-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
            <button class="btn btn-primary btn-block mt-3 mb-5" type="submit">Saqlash</button>
            <?= form_close(); ?>
        </div>
    </div>
  </div>
</div>
