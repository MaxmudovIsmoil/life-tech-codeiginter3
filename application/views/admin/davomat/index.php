<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card">
        <div class="row davomat_kurslar_fixed js_davomat_kurslar_fixed">
            <div class="col-sm-12">
                <?php foreach($guruhlar as $k => $guruh): ?>
                    <?php if($guruh['status'] == 2): ?>
                        <a href="#guruh_<?= $guruh['id']?>" class="btn btn-secondary" data-guruh-id="<?= $guruh['id']; ?>" id="k-btn"><?= $guruh['guruh_nomi']; ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div><!-- /.row -->

        <?php foreach ($guruhlar as $guruh) {?>
            <?php if($guruh["status"] == 2){?>
                <div class="davomat_guruh_block">
                    <div class="d-flex">
                        <h6 class="guruh_oqituvchi" id="guruh_<?= $guruh['id'];?>"><i class="fas fa-graduation-cap"></i> <?= $guruh["guruh_nomi"]; ?></h6>
                        <div class="ml-2">
                            <div class="btn-group btn-group-sm term_pagination_group" role="group">
                            <?php for($i=1; $i <= $guruh['term']; $i++): ?>
                                    <button type="button" class="btn btn-info js_term_pagination" data-term="<?= $i;?>" data-guruh-id="<?= $guruh['id']; ?>"><?= $i; ?> - Oy</button>
                            <?php endfor; ?>
                            </div>
                        </div>

                    </div>

                    <div class="row" id="guruh_once_davomat_<?= $guruh['id']; ?>">
                        <div class="col-md-3 col-sm-4 col-6 pl-4 group-students">
                            <ul class="list-group">
                                <?php foreach ($students[$guruh["id"]] as $key => $student) {?>
                                    <?php if($key == 0){ ?>
                                        <li class="list-group-item">
                                            <p class="guruh-nomi text-left"><?= $student['name']; ?></p>
                                            <i class="guruh_vaqti"><i class="fa fa-clock"></i> <?= date("H:i",strtotime($student['soat'])); ?></i>
                                            <p class="dars_kunlari text-left"><?= $student['kunlar'] ; ?></p>
                                        </li>
                                    <?php } else { ?>
                                        <li class="list-group-item">
                                            <p class="ism"><?= $student['student_last_name'].' '.$student['student_first_name']; ?></p>
                                            <span class="tel"><i class="fas fa-phone"></i> <?= phone_format_helper($student['student_phone']); ?></span>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div><!--./ col-md-3 -->
                        <div class="col-md-9 co-sm-8 col-6 davomat_scroll">

                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <?php for($i=0;$i<12;$i++): ?>
                                        <th valign="top" align="center">
                                            <p><?= $i+1; ?></p>
                                            <?php if(isset($dars_kunlar[$guruh["id"]][$i])){ ?>
                                                <?php $h = date('D', strtotime($dars_kunlar[$guruh["id"]][$i]["kun"])); ?>
                                                <?php switch($h){
                                                    case 'Mon': $a = 'Dushaba'; break;
                                                    case 'Tue': $a = 'Seshanba'; break;
                                                    case 'Wed': $a = 'Chorshanba'; break;
                                                    case 'Thu': $a = 'Payshanba'; break;
                                                    case 'Fri': $a = 'Juma'; break;
                                                    case 'Sat': $a = 'Shanba'; break;
                                                } ?>
                                                <span><?= $a; ?></span>
                                                <i><?= date('d.m.Y', strtotime($dars_kunlar[$guruh["id"]][$i]["kun"])); ?></i>
                                            <?php }else{ ?>
                                                <span>&nbsp;</span>
                                                <i>&nbsp;</i>
                                            <?php } ?>
                                        </th>
                                    <?php endfor; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $davomat = $this->journal_model->davomat($guruh["id"],1); ?>

                                <?php foreach ($davomat as $da) {?>
                                <tr>
                                    <?php for($i=0; $i<12; $i++) {?>
                                    <td>
                                        <?php if(isset($da[$i])) {?>
                                            <?php if(!$da[$i]["status"]) {?>
                                                <i class="fas fa-times"></i>
                                            <?php } else { ?>
                                                <i class="fas fa-check"></i>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div><!--./ col-md-9 -->
                    </div><!--./ row -->
                </div><!-- davomat_guruh_block-->
            <?php } ?>
        <?php }; ?>



    </div>
</div>