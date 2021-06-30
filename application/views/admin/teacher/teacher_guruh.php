<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">
        <div class="col-sm-5">
            <h4 class="mt-2 ml-3"><?= $teacher_name; ?> guruhlari</h4>
        </div><!-- /.col -->
        <div class="col-sm-12 pr-1" style="margin-top: -40px;">
            <ol class="breadcrumb float-sm-right" style="background: none; margin-bottom: 0px;">
                <li class="breadcrumb-item"><a href="<?= site_url("asos/index"); ?>">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url("teacher/index/"); ?>"><?= $teacher_name;?></a></li>
                <li class="breadcrumb-item active">Gruhlar</li>
            </ol>
        </div><!-- /.col -->

        <div class="card-header mt-4">
            <!--            <a class="btn btn-primary" href="--><?//= site_url("teacher_group/teacher_group_add/".$teacher_id); ?><!--" style="font-weight: bold;"><i class="fas fa-plus"></i> Qo'shish</a>-->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5.5%">№</th>
                    <th>Nomi</th>
                    <th>Kunlari</th>
                    <th>vaqti</th>
                    <th>Statusi</th>
                    <th>Soni</th>
                    <th>Tashkil etilgan</th>
                    <th>Muddati</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($teacher_groups as $k => $t_group): ?>
                    <tr style="background: <?php if($t_group['status']==1){ echo '#ddf386'; }elseif($t_group['status']==2){echo '#9ae9bd'; }else{ echo '#efb88b';} ?>">
                        <th><?=$i++; ?></th>
                        <td>
                            <span class="badge badge-pill badge-info guruh_nomi js_guruh_nomi"
                                  data-url="<?= site_url('teacher/ajax_teacher_group_student/'.$teacher_id.'/'.$t_group['id'])?>" data-toggle="modal" data-target=".guruh_model">
                                <?= $t_group['guruh_nomi'];?>
                            </span>
                        </td>
                        <td style="font-size: 14px;">
                            <?php if($t_group['duy']){ echo "Duyshanba,"; }else{ null;} ?>
                            <?php if($t_group['sey']){ echo "Seyshanba,"; }else{ null;} ?>
                            <?php if($t_group['chor']){ echo "Chorshanba,"; }else{ null;} ?>
                            <?php if($t_group['pay']){ echo "Payshanba,"; }else{ null;} ?>
                            <?php if($t_group['juma']){ echo "Juma"; }else{ null;} ?>
                            <?php if($t_group['shan']){ echo "shanba"; }else{ null;} ?>
                            <?php if($t_group['yak']){ echo "Yakyshanba"; }else{ null;} ?>
                        </td>
                        <td><?= date("H:i",strtotime($t_group['soat'])); ?></td>

                        <td><?php
                            switch ($t_group['status']):
                                case 1: echo "Yangi ochilgan"; break;
                                case 2: echo "O'qiyotgan"; break;
                                case 3: echo "Tugatilgan"; break;
                            endswitch;
                            ?></td>
                        <td><?= ($t_group['turi']==1) ? "Indvidual" : "Guruh"; ?> <span class="badge badge-secondary"><?= count($t_group['guruh']); ?></td>
                        <td><?= date("d.m.Y", strtotime($t_group['create_date'])); ?></td>
                        <td><?= $t_group['term']; ?> oy</td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
