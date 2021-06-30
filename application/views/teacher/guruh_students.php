<div class="row">
    <div class="col-md-4 col-3">
        <a href="<?= site_url('teachers/teacher_davomat/barcha_guruhlar'); ?>">
            <i class="fas fa-long-arrow-alt-left fa-25x" style="font-size: 2.5em;color:#117a8b;"></i>
        </a>
    </div>
    <div class="col-md-8 col-9">
        <h6 class="h4 text-left ml-4"><?= $guruh_nomi; ?> guruhidagi o'quvchilar</h6>
        <h6 class="h5 text-left mb-1 ml-5"><p class="badge badge-secondary mb-0"><?= $kunlari; ?><span class="dars_vaqti"><?= $dars_vaqti;?></span></p></h6>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="4%">№</th>
                <th>Familiya</th>
                <th>Ism</th>
                <th>Telefon</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach ($guruh_students as $k => $gs): ?>
                <tr>
                    <th class="align-middle nomer"><?=$i++; ?></th>
                    <td class="align-middle"><?= $gs['familiya']; ?></td>
                    <td class="align-middle"><?=$gs['ism']; ?></td>
                    <td class="align-middle"><?= phone_format_helper($gs['telefon']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
