<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
<!--            <h3 class="alert alert-info">Malumotalr</h3>-->
          </div><!-- /.col -->
          <div class="col-sm-6">
<!--            <h3 class="alert alert-primary">Reyting</h3>-->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" >
      <div class="container-fluid">
        <div class="row pb-4">
            <div class="col-md-12 col-sm-12">
                <h4 class="text-center h5 text-danger">Yo'nalishlar statistikasi</h4>
                <span class="d-none js_computer_savodxonlik"><?= $statistics[0]['student_count'] ?? null; ?></span>
                <span class="d-none js_corldrow"><?= $statistics[1]['student_count'] ?? null; ?></span>
                <span class="d-none js_photoshop"><?= $statistics[2]['student_count'] ?? null; ?></span>
                <span class="d-none js_web"><?= $statistics[3]['student_count'] ?? null; ?></span>
                <span class="d-none js_java"><?= $statistics[4]['student_count'] ?? null; ?></span>
                <div id="chtAnimatedBarChart" class="bcBar"></div>
            </div>
          <div class="col-md-6 col-sm-6 card_asos_statistika">
            <div class="card pb-4">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Statistika
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body mt-0 pt-0">
                <ul>
                  <li class="mb-3">Barcha o'qituvchilar <span class="badge badge-info"><?= $teachers_all; ?></span>
                    <ul>
                      <li>Active o'qituvchilar <span class="badge badge-success"><?= $teachers_active; ?></span></li>
                      <li>Tanafusdagi o'qituvchilar <span class="badge badge-danger"><?= $teachers_all-$teachers_active; ?></span></li>
                    </ul>
                  </li>

                  <li>Barcha guruhlar <span class="badge badge-info"><?= $guruh_new+$guruh_active+$guruh_closed; ?></span></li>
                    <ul>
                      <li>Yangi guruhlar <span class="badge badge-warning"><?= $guruh_new; ?></span></li></li>
                      <li>O'qiyotgan guruhlar <span class="badge badge-success"><?= $guruh_active; ?></span></li></li>
                      <li>Tamomlagan guruhlar <span class="badge badge-danger"><?= $guruh_closed; ?></span></li></li>
                    </ul>
                  </li>

                  <li class="mt-3">Barcha o'quvchilar <span class="badge badge-info"><?= $students_new+$students_active+$students_closed; ?></span></li>
                    <ul>
                      <li>Yangi o'quvchilar <span class="badge badge-warning"><?= $students_new; ?></span></li></li>
                      <li>O'qiyotgan o'quvchilar <span class="badge badge-success"><?= $students_active; ?></span></li></li>
                      <li>Tamomlagan o'quvchilar <span class="badge badge-danger"><?= $students_closed; ?></span></li></li>
                    </ul>
                  </li>

                </ul>
              </div>
               <!-- Canvas jquery plugins -->
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6 col-md-6 col-sm-6">
              <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    window.onload = function() {

        var options = {
            title: {
                text: "Sattistika"
            },
            data: [{
                type: "pie",
                startAngle: 0,
                showInLegend: "",
                legendText: "{label}",
                indexLabel: "{label} ({y})",
                yValueFormatString:"#,##0.#"%"",
                dataPoints: [
                    { label: "Bitirgan guruhlar ", y: <?= $guruh_closed; ?> },
                    { label: "Yangi guruhlar", y: <?= $guruh_new; ?> },
                    { label: "O'qiyotgan guruhlar ", y: <?= $guruh_active; ?> },
                    { label: "Active o'qituvchilar", y: <?= $teachers_active; ?> },
                    { label: "Tanaffussdagi o'qituvchilar", y: <?= $teachers_all-$teachers_active; ?> },
                    { label: "Yangi o'quvchilar", y: <?= $students_new;?> },
                    { label: "O'qiyotgan o'quvchilar", y: <?= $students_active;?> },
                    { label: "Bitirgan o'quvchilar", y: <?= $students_closed;?> }
                ]
            }]
        };
        $("#chartContainer").CanvasJSChart(options);
    }
</script>
