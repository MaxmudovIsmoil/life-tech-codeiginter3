<div class="row">
    <div class="col-md-5 col-3 mt-1">
        <a href="<?= site_url('teachers/teacher_davomat/'); ?>">
            <i class="fas fa-long-arrow-alt-left fa-25x" style="font-size: 2.5em;color:#117a8b;"></i>
        </a>
    </div>
    <div class="col-md-7 col-9 mt-2">
        <h6 class="h4 text-left mb-0">Dars Jadval</h6>
    </div>
</div>
<nav aria-label="Page navigation" class="pt-3 js_teacher_timetable_nav">
    <ul class="pagination justify-content-center">
        <li class="page-item js_date_button js_prev_date">
            <a class="page-link" href="javascript:void(0);" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item disabled text-center w-100">
            <span style="display: none" class="js_teacher_timetable_data" data-teacher_id="<?= $teacher_id; ?>"><?= $datetime; ?></span>
            <a class="page-link js_timetable_date" href="#" tabindex="-1"><?= date("d", $datetime) ." ". lang(date("F", $datetime)).", ". lang(date("l", $datetime)); ?></a>
        </li>
        <li class="page-item js_date_button js_next_date">
            <a class="page-link" href="javascript:void(0);" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
<div class="row" style="">
    <div class="col-md-12">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="4%">№</th>
                <th>Guruh nomi</th>
                <th>Kurs nomi</th>
                <th>Vaqtlari</th>
                <th>Turi</th>
            </tr>
            </thead>
            <tbody id="js_dars_jadval_row">
            <?php $i=1; foreach ($teacher_guruh as $k => $tg): ?>
                <?php
                $str = $tg['soat'];
                $substr = substr($str, 0,5);
                $soat = date("H:i", strtotime($substr))." - ".date("H:i", strtotime($substr)+5400);
                ?>
                <tr>
                    <th class="align-middle nomer"><?=$i++; ?></th>
                    <td class="align-middle">
                        <span data-toggle="modal" data-target=".modal_davomat" class="badge badge-pill badge-success guruh_badge js_dars_jadval_student_davomat" data-guruh-id="<?= $tg['id'];?>" data-soat="<?= $soat; ?>"><?=$tg['guruh_nomi']; ?> </span>
                    </td>
                    <td class="align-middle"><?=$tg['nomi']; ?></td>
                    <td class="align-middle js_guruh_time"><?= $soat; ?></td>
                    <td class="align-middle">
                        <?php if ($tg['turi']==1) echo "Indvidual";
                        else echo "Guruh"; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>