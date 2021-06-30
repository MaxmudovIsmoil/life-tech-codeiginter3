<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header ml-2">
      	<div class="container-fluid">
	        <div class="row mb-2">
	          	<div class="col-sm-6">
	            	<h1 class="m-0 text-dark">To'liq ko'rish</h1>
	          	</div><!-- /.col -->
	          	<div class="col-sm-6">
	            	<ol class="breadcrumb float-sm-right">
	              		<li class="breadcrumb-item"><a href="<?= site_url("asos/index") ?>">Bosh sahifa</a></li>
                        <li class="breadcrumb-item active"><a href="<?= site_url("teacher/") ?>"><?= $teacher_one['ism'];?></a></li>
                        <li class="breadcrumb-item active">Ko'rish</li>
	            	</ol>
	          	</div><!-- /.col -->
	        </div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content ml-3">
    	<div class="row">
    		<div class="col-lg-5">
    			<h5><b>Shaxsiy malumotlari</b></h5>
    			<table class="table table-bordered table-striped" style="font-size: 14px;">
		            <tr>
		                <td>1 </td>
		                <td>Logini </td>
		                <td><?= $teacher_one['username']; ?></td>
		            </tr>
		            <tr>
		                <td>2 </td>
		                <td>Famiylasi </td>
		                <td><?= $teacher_one['familiya']; ?></td>
		            </tr>
		            <tr>
		                <td>3 </td>
		                <td>Ismi </td>
		                <td><?= $teacher_one['ism']; ?></td>
		            </tr>
		            <tr>
		                <td>4 </td>
		                <td>Tugilgan yili </td>
		                <td><?= date('d.m.Y', strtotime($teacher_one['tug_yil'])); ?></td>
		            </tr>
		            <tr>
		                <td>5 </td>
		                <td>Yashash manzili </td>
		                <td><?= $teacher_one['manzil']; ?></td>
		            </tr>
		            <tr>
		                <td>7 </td>
		                <td>Jinsi </td>
		                <td>
		                    <?php if($teacher_one['jins']==1): ?>
		                        <?="Erkak";  ?>
		                    <?php else: ?>
		                        <?="Ayol"; ?>    
		                    <?php endif; ?>
		                </td>
		            </tr>
		            <tr>
		                <td>8 </td>
		                <td>Telefon raqami </td>
		                <td><?= $teacher_one['telefon']; ?></td>
		            </tr>
		            <tr>
		                <td>9 </td>
		                <td>Emaili </td>
		                <td><?= $teacher_one['email']; ?></td>
		            </tr>
		            <tr>
		                <td>10 </td>
		                <td>Malumoti</td>
		                <td><?php if($teacher_one['malumoti']==2){echo "Oliy";}elseif($teacher_one['malumoti']==1){echo "O'rta";} ?></td>
		            </tr>
                    <tr>
                        <td>11 </td>
                        <td>Status</td>
                        <td><?= ($teacher_one['status']==2) ? "Faol": "Nofaol"; ?></td>
                    </tr>
		        </table>
    		</div>
    		<div class="col-lg-4">
    			<h5><b>Qaysi kurslardan dasr o'tishi</b></h5>
				<table class="table table-bordered table-striped" style="font-size: 14px;">
					<?php $i=1; foreach ($teacher_kurslari as $key => $val): ?>
						<tr>
			                <td><?= $i++; ?> </td>
							<td><?= $val; ?></td>
						</tr>
					<?php endforeach ?>
		        </table>
    		</div>
    		<div class="col-lg-3">
    			<h5><b>O'qituvchi rasm</b></h5>
    			<a data-fancybox="gallery" href="<?= site_url("upload/teacher/".$teacher_one['photo_file']) ?>">
          			<img src="<?= site_url("upload/teacher/".$teacher_one['photo_file']) ?>" width='255px' height='240px'>
        		</a>
                <a data-fancybox="gallery" class="btn btn-success btn-block mt-2" href="<?= site_url("upload/teacher/".$teacher_one['pasport_file']) ?>">
                    <i class="fas fa-passport"></i> O'qituvchi pasport nusxasi
                </a>
    		</div>
        </div> 
    </div>
</div>

