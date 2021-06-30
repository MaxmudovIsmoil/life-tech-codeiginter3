<div class="row">
    <div class="col-md-5 col-3 mt-1">
        <a href="<?= site_url('teachers/teacher_davomat/'); ?>">
            <i class="fas fa-long-arrow-alt-left fa-25x" style="font-size: 2.5em;color:#117a8b;"></i>
        </a>
    </div>
    <div class="col-md-7 col-9 mt-2">
        <h6 class="h4 text-left mb-0">Barcha guruhlar davomati</h6>
    </div>
</div>


<!-- Guruhlar davomtai -->
<?php foreach($teacher_guruh as $tguruh): ?>
    <div class="row teacher_davoamt_report">
        <div class="col-md-12">
            <div class="btn-group term_pagination_group bg-success mb-2 mt-3 d-flex" role="group">
                <?php for($i=1; $i <= $tguruh['term']; $i++): ?>
                    <button type="button" class="btn btn-info js_term_pagination pt-1 pb-1" data-term="<?= $i;?>" data-guruh-id="<?= $tguruh['id']; ?>"><?= $i; ?> - Oylik</button>
                <?php endfor; ?>
            </div>
            <table class="table table-bordered table-striped" id="js_guruh_once_davomat_<?= $tguruh['id']; ?>">
                <thead>
                <tr>
                    <th>
                        <p><i class="fas fa-layer-group"></i> <?= $tguruh['guruh_nomi'] ; ?></p>
                        <span><?= get_week_days($tguruh['duy'], $tguruh['sey'], $tguruh['chor'],$tguruh['pay'],$tguruh['juma'],$tguruh['shan'],$tguruh['yak']); ?></span>
                        <span class="vaqti"><i class="fa fa-clock"></i> <?= date('H:i', strtotime($tguruh['soat'])); ?></span>
                    </th>
                    <?php for($i=0;$i<12; $i++): ?>
                        <th valign="top" align="center">
                            <p><?= $i+1; ?></p>
                            <?php if(isset($dars_kunlar[$tguruh["id"]][$i])){ ?>
                                <?php $h = date('D', strtotime($dars_kunlar[$tguruh["id"]][$i]["kun"])); ?>
                                <?php switch($h){
                                    case 'Mon': $a = 'Dushaba'; break;
                                    case 'Tue': $a = 'Seshanba'; break;
                                    case 'Wed': $a = 'Chorshanba'; break;
                                    case 'Thu': $a = 'Payshanba'; break;
                                    case 'Fri': $a = 'Juma'; break;
                                    case 'Sat': $a = 'Shanba'; break;
                                } ?>
                                <span><?= $a; ?></span>
                                <i><?= date('d.m.Y', strtotime($dars_kunlar[$tguruh["id"]][$i]["kun"])); ?></i>
                            <?php }else{ ?>
                                <span>&nbsp;</span>
                                <i>&nbsp;</i>
                            <?php } ?>
                        </th>
                    <?php endfor; ?>
                </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php $davomat = $this->teacher_davomat_model->teacher_guruh_davomat($tguruh["id"],1); ?>

                    <?php $j = 0; foreach ($davomat as $k =>  $da) {?>
                        <th>
                            <p><?= $da[$j]['last_name']." ".$da[$j]['first_name']; ?></p>
                            <span><i class="fas fa-phone"></i> <?= phone_format_helper($da[$j]['phone']); ?></span>
                        </th>
                        <?php for($i=0; $i<12; $i++): ?>
                            <td>
                                <?php if(isset($da[$i])) {?>
                                    <?php if(!$da[$i]["status"]) {?>
                                        <i class="fas fa-times"></i>
                                    <?php } else { ?>
                                        <i class="fas fa-check"></i>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div><!--./ row -->

<?php  endforeach; ?>

