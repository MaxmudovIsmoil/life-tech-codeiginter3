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
                        <li class="breadcrumb-item"><a href="<?= site_url("oquv_guruh/index") ?>">Guruhlar</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url("oquv_guruh/oquv_guruh_active/".$kurs_one['id']) ?>"><?= $title; ?></a></li>
                        <li class="breadcrumb-item active"><a href="<?= site_url("oquv_guruh/oquv_guruh_view/".$oquv_group_once['kurs_id']) ?>"><?= $oquv_group_once['guruh_nomi']; ?></a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content ml-3">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h5><b>Guruh malumotlari</b></h5>
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>1 </td>
                        <td>Nomi </td>
                        <td><?= $oquv_group_once['guruh_nomi']; ?></td>
                    </tr>
                    <tr>
                        <td>2 </td>
                        <td>O'qituvchi </td>
                        <td><?= $oquv_group_once['familiya']." ".$oquv_group_once['ism']; ?></td>
                    </tr>
                    <tr>
                        <td>3 </td>
                        <td>Kunlari </td>
                        <td>
                            <?php if($oquv_group_once['duy']){ echo "Duyshanba,"; }else{ null;} ?>
                            <?php if($oquv_group_once['sey']){ echo "Seyshanba,"; }else{ null;} ?>
                            <?php if($oquv_group_once['chor']){ echo "Chorshanba,"; }else{ null;} ?>
                            <?php if($oquv_group_once['pay']){ echo "Payshanba,"; }else{ null;} ?>
                            <?php if($oquv_group_once['juma']){ echo "Juma"; }else{ null;} ?>
                            <?php if($oquv_group_once['shan']){ echo "shanba"; }else{ null;} ?>
                            <?php if($oquv_group_once['yak']){ echo "Yakyshanba"; }else{ null;} ?>
                        </td>
                    </tr>
                    <tr>
                        <td>3 </td>
                        <td>Vaqti </td>
                        <td><?= date('H : i', strtotime($oquv_group_once['soat'])); ?></td>
                    </tr>
                    <tr>
                        <td>4 </td>
                        <td>Guruh turi </td>
                        <td><?= ($oquv_group_once['turi']==0) ? "Guruh" : "Indvidual"; ?></td>
                    </tr>
                    <tr>
                        <td>3 </td>
                        <td>Davomiyligi </td>
                        <td><?= $oquv_group_once['term']; ?> oy</td>
                    </tr>
                    <tr>
                        <td>4 </td>
                        <td>Guruh ochilgan sana</td>
                        <td><?= date("d.m.Y H:i", strtotime($oquv_group_once['create_date'])); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>