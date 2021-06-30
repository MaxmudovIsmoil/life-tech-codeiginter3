<div class="row">
    <div class="col-md-4 col-3 mt-1">
        <a href="<?= site_url('teachers/teacher_davomat/dars_jadval'); ?>">
            <i class="fas fa-long-arrow-alt-left fa-25x" style="font-size: 2.5em;color:#117a8b;"></i>
        </a>
    </div>
    <div class="col-md-8 col-9 mt-2 pl-5">
        <h6 class="h4 text-left mb-0"><?= $guruh_nomi." guruh o'quvchilari"; ?></h6>
    </div>
</div>

<div class="row" style="">
    <div class="col-md-12">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="4%">№</th>
                <th width="24%">Familiya ism</th>
                <th>Davomat</th>
                <th>Telefon</th>
            </tr>
            </thead>
            <tbody id="js_dars_jadval_row">
            <?php $i=1; foreach ($student_davomat as $k => $sd): ?>
                <tr>
                    <th class="align-middle nomer"><?= $i++; ?></th>
                    <td class="align-middle"><?= $sd['familiya']." ".$sd['ism']; ?></td>
                    <td class="align-middle">
                        <span class="js_davomat_btn">
                            <input type="checkbox" class="js_davomat" value="1" data-toggle="toggle" data-on="Bor" data-off="Yo'q" data-onstyle="success" data-offstyle="danger" data-size="sm">
                        </span>
                    </td>
                    <td class="align-middle"><?= $sd['telefon']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>