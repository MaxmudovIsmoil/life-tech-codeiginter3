<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- to`lov modal ochilishi -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
        <?= form_open_multipart("payment/pay", array("class" => "needs-validation", "novalidate" => "novalidate"), array("type"=>3)) ?>
            <div class="modal-body">
                <input type="hidden" value=""><??>
                <div class="col-md-4 mb-3">
                    <label for="oy">To`lov oyi: </label>
                    <select name="selectoy" class="custom-select">
                        <option selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="summa">To`lov summasi: </label>
                    <input type="number" class="form-control" id="" name="summa" placeholder="" value="<?= set_value("ism") ?>" required>
                    <div class="invalid-feedback">
                    Summani kiriting!
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
                <button type="submit" class="btn btn-primary">To`lash</button>
            </div>
        <?= form_close(); ?>
    </div>
  </div>
</div>
<!-- modal tugashi -->

    <div class="card">
        <div class="col-sm-5">
            <h4 class="mt-2 ml-3">To'lovlar</h4>
        </div><!-- /.col -->
        <div class="col-sm-12 pr-1" style="margin-top: -40px;">
            <ol class="breadcrumb float-sm-right" style="background: none; margin-bottom: 0px;">
                <li class="breadcrumb-item"><a href="<?= site_url("asos/index"); ?>">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url("student/index/"); ?>">O'quvchilar</a></li>
                <li class="breadcrumb-item active">To'lovlar</li>
            </ol>
        </div><!-- /.col -->

        <div class="card-header student_payment_btn">
            <h6 class="">Kurs ➡ <?= $student_course['kurs_nomi']; ?></h6>
            <h6 class="">Guruh ➡ <?= $student_course['guruh_nomi']." ".date('H:i', strtotime($student_course['soat'])); ?></h6>
            <h6 class="">Kurs turi ➡ <?php if($student_course['turi'] == '0') : echo "Guruh"; else: echo "Indvidual"; endif; ?></h6>
            <h6 class="">Davomiyligi ➡ <?= $student_course['term'].' oy'; ?></h6>
            <!-- <a class="btn btn-primary" href="<?= site_url("student/student_payment_pay"); ?>" style="font-weight: bold;">
                <i class="fas fa-hand-holding-usd"></i> To'lash
            </a> -->
            <button type="button" class="btn btn-primary" style="font-weight: bold;" data-toggle="modal" data-target="#myModal"><i class="fas fa-hand-holding-usd"></i>To`lov</button>

        </div>

        <div class="card-body student_payment_card_body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="6%">№</th>
                    <th>Sana</th>
                    <th>To'langan summa</th>
                    <th>Kurs summasi</th>
                    <th>Qarz</th>
                    <th>To'lov vaqti</th>
                    <th>Maqom</th>
                    <th class="text-right">Harakatlar</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>12.11.2020</td>
                        <td>100 000</td>
                        <td>150 000</td>
                        <td><span class="student_payment_debt">50 000</span></td>
                        <td>12:15:04</td>
                        <td>Oddiy</td>
                        <td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">

                                <a href="<?= site_url("student/")?>" class="btn btn-info" title="To'liq ko'rish" aria-label="To'liq ko'rish"><i class="fas fa-eye"></i></a>

                                <a href="<?= site_url("student/")?>" class="btn btn-primary" title="Taxrirlash" aria-label="Tahrirlash"><i class="fas fa-edit"></i></a>

                                <button type="button" data-href="<?= site_url("Student/"); ?>" data-title="<?= 'asa'; ?>" class="btn btn-danger js_delete_item" title="O'chirish" aria-label="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>13.12.2020</td>
                        <td>100 000</td>
                        <td>150 000</td>
                        <td><span class="student_payment_debt">50 000</span></td>
                        <td>11:05:44</td>
                        <td>Oddiy</td>
                        <td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">

                                <a href="<?= site_url("student/")?>" class="btn btn-info" title="To'liq ko'rish" aria-label="To'liq ko'rish"><i class="fas fa-eye"></i></a>

                                <a href="<?= site_url("student/")?>" class="btn btn-primary" title="Taxrirlash" aria-label="Tahrirlash"><i class="fas fa-edit"></i></a>

                                <button type="button" data-href="<?= site_url("Student/"); ?>" data-title="<?= 'asa'; ?>" class="btn btn-danger js_delete_item" title="O'chirish" aria-label="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr style="background: lightblue">
                        <td>3</td>
                        <td></td>
                        <td><span class="font-weight-bold">200 000</span></td>
                        <td></td>
                        <td> <span class="student_payment_debt">100 000</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>




