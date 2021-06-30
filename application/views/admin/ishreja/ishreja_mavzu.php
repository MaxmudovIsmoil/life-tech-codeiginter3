<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">
        <div class="row">
            <div class="col-sm-3">
                <h3 class="mt-2 ml-4">Mavzular</h3>
            </div><!-- /.col -->
            <div class="col-sm-9 pr-3">
                <ol class="breadcrumb float-sm-right" style="background: none;">
                  <li class="breadcrumb-item"><a href="<?= site_url("asos/index"); ?>">Bosh sahifa</a></li>
                  <li class="breadcrumb-item"><a href="<?= site_url("courses/index"); ?>">Kurslar</a></li>
                  <li class="breadcrumb-item"><a href="<?= site_url("ishreja/index/".$kurs_one['id']); ?>"><?=$kurs_one['nomi'];?></a></li>
                  <li class="breadcrumb-item active"><?= $guruh_nomi; ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="card-header mt-1">
            <!-- <h5>Guruhlar</h5> -->
        </div>
        <div class="card-body">
            <?= form_open("", array("class" => "needs-validation","novalidate" => "novalidate")) ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 6%;">№</th>
                        <th>Nomi</th>
                        <!--  <th class="text-right">Harakatlar</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($ishreja_mavzu as $k => $i_m): ?>
                        <tr>
                            <th><?= $i++; ?></th>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input id="mavzu<?= $k; ?>" name="ishreja_mavzu<?=$k;?>" type="checkbox" class="custom-control-input" value = "<?=$i_m['i_m_id']?>" >
                                    <label class="custom-control-label" for="mavzu<?= $k; ?>"><?= $i_m['mavzu']; ?></label>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" name="btn_i_m" class="btn btn-primary">Saqlash</button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>