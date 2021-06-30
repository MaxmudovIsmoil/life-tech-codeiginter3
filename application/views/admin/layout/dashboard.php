<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Life Tech </title>
 
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= site_url("assets/plugins/fontawesome-free/css/all.min.css") ?>">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= site_url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css") ?>">
  <!-- Chart jquery plugins -->

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= site_url("assets/dist/css/adminlte.css") ?>">
    <!-- Google Font: Source Sans Pro -->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel=  "stylesheet">
    <link href="<?= site_url("assets/js/datepicker/gijgo.min.css") ?>" rel="stylesheet">
    <link href="<?= site_url("assets/css/form-validation.css?".time()) ?>" rel="stylesheet">


    <!-- Chart CSS -->
    <link rel="stylesheet" href="<?= site_url('assets/plugins/jquery-animated-bar-chart/dist/bar.chart.min.css')?>" />


    <link href="<?= site_url("assets/plugins/fancybox/jquery.fancybox.min.css"); ?>" rel="stylesheet">
    <link href="<?= site_url("assets/css/multi-select.css?".time()); ?>" rel="stylesheet">
    <link href="<?= site_url("assets/css/style.css?".time()); ?>" rel="stylesheet">
    <link href="<?= site_url("assets/css/gruhlar.css"); ?>" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-light">
        <!-- Left navbar links -->

          <a class="nav-link btn_push" data-widget="pushmenu" href="#">
            <i class="fas fa-bars"></i>
          </a>

          <h3 class="nav-link title">
            <?= $title; ?>
          </h3>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" id="admin_btn" data-toggle="dropdown" href="#">
              <!-- <i class="fas fa-user-cog"></i> -->
              <img src="<?= site_url("assets/img_icon/admin.png"); ?>">
              <p>Admin</p>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <img src="<?= site_url("assets/img_icon/add.svg");?>" width="12%" class="mr-2">
                Foydalanuvchi qo'shish
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= site_url('asos/admin_edit'); ?>" class="dropdown-item">
                <img src="<?= site_url("assets/img_icon/admin_edit.svg");?>" width="12%" class="mr-2">
                Admin tahrirlash
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= site_url('user/login'); ?>" class="dropdown-item">
                <img src="<?= site_url('assets/img_icon/logout.svg')?>" width="10%" class='mr-2'>
                <!-- <i class="fas fa-sign-out-alt mr-1"></i> -->
                Tizimdan chiqish
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= site_url("asos/") ?>" class="brand-link pt-2 pb-2">
          <img src="<?= site_url("assets/dist/img/AdminLTELogo.jpg"); ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Life Tech</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-2 pb-2 mb-0 d-flex">
            <div class="image">
              <img src="<?= site_url("assets/dist/img/user1.jpg"); ?>" class="img-circle elevation-2">
            </div>
            <div class="info">
              <a href="<?= site_url("asos/index") ?>" class="d-block">Administrator</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item has-treeview">
                <a href="<?= site_url("asos/") ?>" class="nav-link <?php  if($this->uri->segment(1) == "asos") echo "active"; else if($this->uri->segment(1) == NULL) echo "active"; ?>">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    Bosh sahifa
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="<?= site_url("courses/") ?>" class="nav-link <?= $this->uri->segment(1) == "courses" ? "active":""; ?>">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Kurslar
                  </p>
                </a>
              </li>
              <!-- <?php // if ($this->ion_auth->in_group('admin')): ?> -->

              <li class="nav-item has-treeview">
                <a href="<?= site_url("oquv_guruh/") ?>" class="nav-link <?= $this->uri->segment(1) == "oquv_guruh" ? "active":""; ?>">
                  <i class="nav-icon fas fa-layer-group"></i>
                  <p>
                    Guruhlar
                  </p>
                </a>
              </li>

              <!-- <li class="nav-item has-treeview">
                <a href="<?= site_url("davomat/") ?>" class="nav-link <?= $this->uri->segment(1) == "davomat" ? "active":""; ?>">
                  <i class="nav-icon fas fa-user-clock"></i>
                  <p>
                    Davomat
                  </p>
                </a>
              </li> -->

              <li class="nav-item has-treeview">
                <a href="<?= site_url("teacher/") ?>" class="nav-link <?= $this->uri->segment(1) == "teacher" ? "active":""; ?>">
                  <i class="nav-icon fas fa-user-secret"></i>
                  <p>
                    O'qituvchilar
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="<?= site_url("student/") ?>" class="nav-link <?= $this->uri->segment(1) == "student" ? "active":""; ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Barcha o'quvchilar
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview">
                <a href="<?= site_url("chiqm/")?>" class="nav-link <?= $this->uri->segment(1) == "chiqm" ? "active":""; ?>">
<!--                  <i class="nav-icon fas fa-hand-holding-usd"></i>-->
                  <i class="nav-icon fas fa-file-invoice-dollar"></i>
                  <p>
                    Chiqimlar
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="<?= site_url("hisobot/") ?>" class="nav-link <?= $this->uri->segment(1) == "hisobot" ? "active":""; ?>">
                  <i class="nav-icon fas fa-file-contract"></i>
                  <p>
                    Hisobot
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <?php $this->load->view($content); ?>

      <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
      </a>
      <!-- Main Footer -->
        <footer class="main-footer">
          <strong>Almirab &copy; 2019-2020 <a href="#">Life Tech</a></strong>
          <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.0-rc.5
          </div>
        </footer>
        <?php include_once('modal.php'); ?>
      </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?= site_url("assets/plugins/jquery/jquery.min.js") ?>"></script>
  <!-- jquery ui -->
  <script src="<?= site_url("assets/plugins/jquery-ui/jquery-ui.min.js") ?>"></script>
  <!-- dataTable -->

  <script src="<?= site_url("assets/plugins/datatables/jquery.dataTables.js") ?>"></script>
  <script src="<?= site_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js") ?>"></script>
  <script src="<?= site_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js") ?>"></script>

  <!-- Modal delete -->
  <script src="<?= site_url('assets/js/modal_delete.js')?>"></script>
  <!-- /Modal -->

  <!-- AdminLTE -->
  <script src="<?= site_url("assets/dist/js/adminlte.js") ?>"></script>
  <!-- /AdminLTE -->

  <script src="<?= site_url("assets/dist/js/demo.js") ?>"></script>

  <script>
    $(function () {
//      $("#example1").DataTable();
      $('#example1').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
      });

    });

    $(document).ready(function () {
      bsCustomFileInput.init();
    });
  </script>
  <script src=" <?= site_url("assets/bootstrap4.3.1/js/bootstrap.min.js") ?>"></script>
  <script src=" <?= site_url("assets/bootstrap4.3.1/js/bootstrap.bundle.js") ?>"></script>

  <script src="<?= site_url("assets/js/form-validation.js") ?>"></script>
  <script src="<?= site_url("assets/js/datepicker/gijgo.min.js"); ?>"></script>
  <script src="<?= site_url("assets/js/jquery.multi-select.js"); ?>"></script>
  <script type="text/javascript">
    // run pre selected options
    $('#pre-selected-options').multiSelect();
  </script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

  <!-- D3 Js -->
  <script src='https://d3js.org/d3.v4.min.js'></script>

  <!-- Chart Js -->
  <script src="<?= site_url('assets/plugins/jquery-animated-bar-chart/dist/jquery.bar.chart.min.js')?>"></script>

  <!-- Yonalishlar statistikasi -->
  <script src="<?= site_url('assets/js/chart_statistika.js'); ?>"></script>

  <script src="<?= site_url("assets/js/functions.js?".time()) ?>"></script>
  <script src="<?= site_url("assets/js/function_ajax.js?".time()) ?>"></script>
  <script src="<?= site_url("assets/plugins/fancybox/jquery.fancybox.min.js") ?>"></script>

</body>
</html>