<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <?= form_open("", array("class" => "needs-validation","novalidate" => "novalidate") ); ?>
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" name="login" id="login" readonly value="<?= set_value("nomi", $login); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary mr-1">Saqlash</button>
                <a  href="<?= site_url('asos/'); ?>" class="btn btn-secondary">Orqaga</a>
            <?= form_close(); ?>
        </div>
    </div>
</div>
