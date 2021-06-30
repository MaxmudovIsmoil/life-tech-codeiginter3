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
						<?php if(isset($guruh_nomi)) : ?>
							<li class="breadcrumb-item active"><a href="<?= site_url("teacher/index/") ?>"><?= $teacher_name; ?></a></li>
							<li class="breadcrumb-item active"><a href="<?= site_url("teacher_group/index/".$teacher_id) ?>"><?= $guruh_nomi; ?></a></li>
							<li class="breadcrumb-item active"><a href="<?= site_url("teacher_group/teacher_group_student/".$teacher_id."/".$guruh_id) ?>">O'quvchilar</a></li>
						<?php else: ?>
							<li class="breadcrumb-item active"><a href="<?= site_url("student/") ?>">Student</a></li>
						<?php endif; ?>
	            	</ol>
	          	</div><!-- /.col -->
	        </div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content ml-3">
    	<div class="row">
    		<div class="col-lg-5 col-md-5 col-sm-6">
    			<h5><b>Shaxsiy malumotlari</b></h5>
    			<table class="table table-bordered table-striped" style="font-size: 14px;">
		            <tr>
		                <td>1 </td>
		                <td>Logini </td>
		                <td><?= $student_one['username']; ?></td>
		            </tr>
		            <tr>
		                <td>2 </td>
		                <td>Famiylasi </td>
		                <td><?= $student_one['familiya']; ?></td>
		            </tr>
		            <tr>
		                <td>3 </td>
		                <td>Ismi </td>
		                <td><?= $student_one['ism']; ?></td>
		            </tr>
		            <tr>
		                <td>4 </td>
		                <td>Tugilgan yili </td>
		                <td><?= date("d.m.Y", strtotime($student_one['tug_yil'])); ?></td>
		            </tr>
		            <tr>
		                <td>5 </td>
		                <td>Jinsi </td>
		                <td>
		                    <?php if($student_one['jins']==1): ?>
		                        <?="Erkak";  ?>
		                    <?php else: ?>
		                        <?="Ayol"; ?>    
		                    <?php endif; ?>
		                </td>
		            </tr>
		            <tr>
		                <td>6 </td>
		                <td>Yashash manzili </td>
		                <td><?= $student_one['manzil']; ?></td>
		            </tr>
		            <tr>
		                <td>7 </td>
		                <td>Telefon raqami </td>
		                <td><?= phone_format_helper($student_one['telefon']); ?></td>
		            </tr>
		            <tr>
		                <td>8 </td>
		                <td>Emaili </td>
		                <td><?= $student_one['email']; ?></td>
		            </tr>
					<tr>
						<td>9 </td>
						<td>Status</td>
						<td><?php if($student_one['status']==1){ echo "Yangi kelgan"; }
							elseif($student_one['status']==2){ echo "Nofaol";}
							else{ echo "Tugatgan"; } ?></td>
					</tr>
		            <tr>
		                <td>9 </td>
		                <td>Ishi yoki o'qishi nomi </td>
		                <td><?= $student_one['company']; ?></td>
		            </tr>
		        </table>
    		</div>
    		<div class="col-lg-4 col-md-4">
    			<h5><b>Qaysi kurslarga qatnashishi</b></h5>
				<table class="table table-bordered table-striped">
					<?php $i=1; foreach ($student_kurslari as $key => $val): ?>
						<tr>
			                <td><?= $i++; ?> </td>
							<td><?= $val; ?></td>
						</tr>
					<?php endforeach ?>
		        </table>
    		</div>
    		<div class="col-lg-3 col-md-3">
    			<h5><b>Pasport nusxasi</b></h5>
    			<a data-fancybox="gallery" href="<?= site_url("upload/student/".$student_one['pasport_file']) ?>">
          			<img src="<?= site_url("upload/student/".$student_one['pasport_file']) ?>" width='260px' height='230px'>
        		</a>
    		</div>
        </div> 
    </div>
</div>