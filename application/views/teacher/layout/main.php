<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="<?= site_url('assets/bootstrap4.3.1/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?= site_url('assets/plugins/fontawesome-free/css/all.css');?>">
<!--    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <link rel="stylesheet" href="<?= site_url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css") ?>">
    <link rel="stylesheet" href="<?= site_url("assets/css/teacher_davomat_style.css") ?>">
</head>
<body>

	<div class="container-fluid mt-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top pt-0 pb-0">

            <h6 class="text-white pt-1 mr-2 fam_fish"><?= $_SESSION['teacher_familiya']." ".$_SESSION['teacher_ism']; ?></h6>
            <h6 class="text-white pt-1 date_timer"><span><?= date("d", time()) ." ". lang(date("F", time())) .", ". lang(date("l", time())); ?> </span> <span id="timer"></span></h6>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarZavuch" aria-controls="navbarZavuch" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarZavuch">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->uri->segment(3) == NULL) ? "active" : ""; ?>" href="<?= site_url('teachers/teacher_davomat/')?>">Asosiy Sahifa <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->uri->segment(3) == "barcha_guruhlar") ? "active" : ""; ?>" href="<?= site_url('teachers/teacher_davomat/barcha_guruhlar')?>">Barcha guruhlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($this->uri->segment(3) == "dars_jadval") echo "active"; elseif($this->uri->segment(3) == "dars_jadval_student_davomat") echo "active"; ?>" href="<?= site_url('teachers/teacher_davomat/dars_jadval')?>">Dars Jadval</a>
                    </li>

                </ul>
                <span class="navbar-text pt-0 pb-0">
                    <a class="nav-link pl-0 pt-1" href="<?= site_url('user/login');?>"><i class="fas fa-sign-out-alt"></i> Chiqish</a>
                </span>
            </div>
        </nav>


        <div class="content">
            <?php $this->load->view($content); ?>
        </div>


	</div><!-- ./ container-fluid -->

    <!-- Dars jadval guruhdagi o'quvchilarni davomat model -->
    <div class="modal fade modal_davomat" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalDavomat" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDavomat">Guruh nomi</h5>
                    <p class="js_datetime_model"><span class="js_date_model">Kun Oy Hafta</span>, <span class="js_time_model">14:00 - 15:30</span></p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body davomat_modal_body">

                </div><!-- ./ modal-body -->
                <div class="modal-footer">
<!--                    <button type="button" class="btn btn-primary btn-sm">saqlash</button>-->
<!--                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Orqaga</button>-->
                </div><!-- ./ modal-footer -->
            </div>
        </div>
    </div>
    <!-- ./ Model -->

    <script src="<?= site_url("assets/plugins/jquery/jquery.min.js") ?>"></script>
    <script src="<?= site_url("assets/bootstrap4.3.1/js/bootstrap.min.js") ?>"></script>
    <script src="<?= site_url("assets/plugins/datatables/jquery.dataTables.js") ?>"></script>
    <script src="<?= site_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js") ?>"></script>
    <script src="<?= site_url('assets/js/teacher_davomat_function.js?'.time())?>"></script>
</body>
</html>



