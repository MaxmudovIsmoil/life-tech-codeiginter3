<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <div class="card">
        <div class="container">
            <div class="row ml-2 mr-1 mt-2">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("student/student_yangilar"); ?>">Yangi kelgan o'quvchilar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("student/"); ?>">O'qiyotgan o'quvchilar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= site_url("student/student_bitirgan/"); ?>">Bitirgan o'quvchilar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body mt-0 pt-1">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="6%">№</th>
                    <th>Familyasi</th>
                    <th>Ismi</th>
                    <th>Yozilgan kurslari</th>
                    <th>Telefon</th>
                    <th>Status</th>
                    <th class="text-right">Harakatlar</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($student_kurslari as $k => $student): ?>
                    <tr>
                        <th><?=$i++; ?></th>
                        <td><?=$student['familiya']; ?></td>
                        <td><?=$student['ism']; ?></td>
                        <td class="align-middle" style="font-size: 15px; padding-bottom: 3px;padding-top: 3px;">
                            <?php  foreach($student['kurs'] as $k => $val): ?>
                                <?= $val; ?><br>
                            <?php  endforeach; ?>
                        </td>
                        <td><?= phone_format_helper($student['telefon']); ?></td>
                        <td><?= ($student['status'] == 3) ? 'Bitirgan': ""; ?></td>
                        <td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">

                                <a href="<?= site_url("student/student_view/".$student['user_id'])?>" class="btn btn-info" title="To'liq ko'rish" aria-label="To'liq ko'rish"><i class="fas fa-eye"></i></a>

                                <a href="<?= site_url("student/student_edit/".$student['user_id'])?>" class="btn btn-primary" title="Taxrirlash" aria-label="Tahrirlash"><i class="fas fa-edit"></i></a>

                                <button type="button" data-href="<?= site_url("Student/student_delet/".$student['user_id']); ?>" data-title="<?= $student['ism']; ?>" class="btn btn-danger js_delete_item" title="O'chirish" aria-label="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
