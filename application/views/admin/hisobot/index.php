<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">

        <?= form_open("hisobot/index", array("class" => "needs-validation","novalidate" => "novalidate")) ?>
            <div class="col-md-7 mt-4 d-flex">
                <input type="text" class="form-control ml-3" id="filtr_1" name="filtr_1" required>
                <input type="text" class="form-control ml-2" id="filtr_2" name="filtr_2" required>
                <button class="btn btn-primary btn-md ml-2" type="submit">Filtirlash</button>
            </div>
        <?= form_close(); ?>


        <div class="container-fluid mt-4">
            <div class="kirim mr-3 ml-3">
                <h4>Kirim</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="6%">№</th>
                            <th>Guruhlar nomi</th>
                            <th>Tushirgan pul</th>
                            <th>Tushimdan ulishi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Zokirjon</td>
                            <td>2500 000</td>
                            <td>50 %</td>
                        </tr>
                        <tr>
                            <th>2</th>
                            <td>Oybekjon</td>
                            <td>2200 000</td>
                            <td>50 %</td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>Test</td>
                            <td>700 000</td>
                            <td>45 %</td>
                        </tr>
                        <tr style="background: #63dd7f;color: white">
                            <th colspan="2" style="padding-left:7%">Jami</th>
                            <th colspan="2">5400 000</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="chiqim ml-3 mr-3">
                <h4>Chiqim</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="6%">№</th>
                        <th>Chiqim turi</th>
                        <th>Summa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>1</th>
                        <td>Svetga</td>
                        <td>120 000</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Intenet hizmati</td>
                        <td>70 000</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Reklamaga</td>
                        <td>1700 000</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>O'qituvchi Zokirjon darsdan ulishi</td>
                        <td>1250 000</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td>O'qituvchi Oybek darsdan ulishi</td>
                        <td>1100 000</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td>O'qituvchi Test darsdan ulishi</td>
                        <td>315 000</td>
                    </tr>
                    <tr style="background: #f7cd4e;color: white">
                        <th colspan="2" style="padding-left:7%">Jami</th>
                        <th colspan="2">2835 000</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="chiqim ml-3 mr-3">
                <h4>Natija</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Jami tushim</th>
                            <th>Jami chiqim</th>
                            <th>Natija</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background: #07d0ef;color: white">
                            <th>5400 000</th>
                            <th>2835 000</th>
                            <th>2565 000</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



