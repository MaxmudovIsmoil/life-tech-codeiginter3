<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mt-2 ml-4"><?= $kurs_one['nomi']; ?></h3>
            </div><!-- /.col -->
            <div class="col-sm-6 pr-3">
                <ol class="breadcrumb float-sm-right" style="background: none;">
                    <li class="breadcrumb-item"><a href="<?= site_url("asos/index"); ?>">Bosh sahifa</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url("oquv_guruh/index"); ?>">Gruhlar</a></li>
                    <li class="breadcrumb-item active"><?= $kurs_one['nomi']; ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="container">
            <div class="row ml-2 mr-1">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link <?= $this->uri->segment(2) == "oquv_guruh_active" ? "active":""; ?>" href="<?= site_url("oquv_guruh/oquv_guruh_active/".$kurs_one['id']); ?>">O'qiyotgan va to'planayotgan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $this->uri->segment(2) == "oquv_guruh_tugatilgan" ? "active":""; ?>" href="">Tugatilgan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-header" style="margin-top: 30px;">
<!--            <a class="btn btn-primary" href="--><?//= site_url("oquv_guruh/oquv_guruh_add/".$kurs_one['id']); ?><!--" style="font-weight: bold;"><i class="fas fa-plus"></i> Guruh yaratish</a>-->
        </div>
        <!-- /.content-header -->

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Nomi</th>
                    <th>Kunlar</th>
                    <th>Vaqt</th>
                    <th>O'qtuvchi</th>
                    <th>Turi</th>
                    <th>Soni</th>
                    <th>Status</th>
                    <th class="text-right">Harakatlar</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($oquv_group_tugatilgan as $k => $og): ?>
                    <tr style="background: <?php if($og['status']==1){ echo '#ddf386'; }elseif($og['status']==2){echo '#9ae9bd'; }else{ echo '#efb88b';} ?>" class="align-middle">
                        <th><?=$i++; ?></th>
                        <td class=""><span class="badge badge-pill badge-info guruh_nomi js_guruh_nomi" data-url="<?= site_url("oquv_guruh/ajax_oquv_guruh_student/".$og['id']); ?>" data-toggle="modal" data-target=".guruh_model">
								<?= $og['guruh_nomi']; ?></span>
                        </td>
                        <td style="font-size: 14px;">
                            <?php if($og['duy']){ echo "Duyshanba,"; }else{ null;} ?>
                            <?php if($og['sey']){ echo "Seyshanba,"; }else{ null;} ?>
                            <?php if($og['chor']){ echo "Chorshanba,"; }else{ null;} ?>
                            <?php if($og['pay']){ echo "Payshanba,"; }else{ null;} ?>
                            <?php if($og['juma']){ echo "Juma"; }else{ null;} ?>
                            <?php if($og['shan']){ echo "shanba"; }else{ null;} ?>
                            <?php if($og['yak']){ echo "Yakyshanba"; }else{ null;} ?>
                        </td>
                        <td><?php
                            $str = $og['soat'];
                            $substr = substr($str, 0,5);
                            echo date("H : i", strtotime($substr));
                            ?></td>
                        <td><?=$og['teacher_fam'];?> <?=$og['teacher_ism']; ?></td>
                        <td>
                            <?php if ($og['turi']==1) echo "Indvidual";
                            else echo "Guruh"; ?>
                        </td>
                        <td><?= $og['student_soni']; ?></td>
                        <td>
                            <?php switch ($og['status']) {
                                case '1': echo "Yangi ochilgan"; break;
                                case '2': echo "O'qiyotgan"; break;
                                case '3': echo "Tugatgan"; break;
                                default: null; break;
                            } ?>
                        </td>

                        <td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
<!--                                <a href="--><?//= site_url("oquv_guruh/oquv_guruh_view_student_add/".$kurs_one['id']."/".$og['id']); ?><!--" class="btn btn-success" title="Guruhga o'quvchi biriktirish"><i class="fas fa-user-plus"></i></a>-->
                                <a href="<?= site_url("oquv_guruh/oquv_guruh_view_this/".$kurs_one['id']."/".$og['id']); ?>" class="btn btn-info" title="To'liq ko'rish"><i class="fas fa-eye"></i></a>

                                <a href="<?= site_url("oquv_guruh/oquv_guruh_edit/".$kurs_one['id']."/".$og['id']); ?>" class="btn btn-primary" title="Taxrirlash"><i class="fas fa-edit"></i></a>

                                <button type="button" data-href="<?= site_url("oquv_guruh/oquv_guruh_delet/".$og['id'])?>" class="btn btn-danger js_delete_item" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                     <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
