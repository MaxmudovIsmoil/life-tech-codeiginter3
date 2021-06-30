<div class="row">
    <div class="col-md-5 col-3 mt-1">
        <a href="<?= site_url('teachers/teacher_davomat/'); ?>">
            <i class="fas fa-long-arrow-alt-left fa-25x" style="font-size: 2.5em;color:#117a8b;"></i>
        </a>
    </div>
    <div class="col-md-7 col-9 mt-2">
        <h6 class="h4 text-left mb-0">Barcha guruhlar</h6>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="4%">№</th>
                <th>Guruh nomi</th>
                <th>Kurs nomi</th>
                <th>Kunlari</th>
                <th>Vaqtlari</th>
                <th>Turi</th>
                <th>Mudati</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach ($teacher_guruh as $k => $tg): ?>
                <tr>
                    <th class="align-middle nomer"><?=$i++; ?></th>
                    <td class="align-middle">
                        <a href="<?= site_url("teachers/teacher_davomat/guruh_students/".$tg['id']); ?>">
                            <span class="badge badge-pill badge-success guruh_badge" id="guruh_nomi"><?=$tg['guruh_nomi']; ?></span>
                        </a>
                    </td>
                    <td class="align-middle"><?=$tg['nomi']; ?></td>
                    <td class="align-middle" style="font-size: 14px;">
                        <?php if($tg['duy']){ echo "Duyshanba,"; }else{ null;} ?>
                        <?php if($tg['sey']){ echo "Seyshanba,"; }else{ null;} ?>
                        <?php if($tg['chor']){ echo "Chorshanba,"; }else{ null;} ?>
                        <?php if($tg['pay']){ echo "Payshanba,"; }else{ null;} ?>
                        <?php if($tg['juma']){ echo "Juma"; }else{ null;} ?>
                        <?php if($tg['shan']){ echo "shanba"; }else{ null;} ?>
                        <?php if($tg['yak']){ echo "Yakyshanba"; }else{ null;} ?>
                    </td>
                    <td class="align-middle"><?php
                        $str = $tg['soat'];
                        $substr = substr($str, 0,5);
                        echo date("H:i", strtotime($substr))." - ".date("H:i", strtotime($substr)+5400);
                        ?></td>
                    <td class="align-middle">
                        <?php if ($tg['turi']==1) echo "Indvidual";
                        else echo "Guruh"; ?>
                    </td>
                    <td><?= $tg['term']." oy";?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>






