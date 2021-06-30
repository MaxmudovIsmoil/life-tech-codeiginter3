<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">

	        <div class="col-sm-5">
	            <h4 class="mt-2 ml-3"><?= $kurs_one['nomi']; ?></h4>
	        </div><!-- /.col -->
	        <div class="col-sm-12 pr-1" style="margin-top: -45px;">
	            <ol class="breadcrumb float-sm-right" style="background: none;">
	              <li class="breadcrumb-item"><a href="<?= site_url("asos/index"); ?>">Bosh sahifa</a></li>
	              <li class="breadcrumb-item"><a href="<?= site_url("courses/index"); ?>">Kurslar</a></li>
	              <li class="breadcrumb-item active"><?= $kurs_one['nomi']; ?></li>
	            </ol>
	        </div><!-- /.col -->

		<div class="card-header">
			<!-- <h5>Guruhlar</h5> -->
		</div>
		<div class="card-body">
    		<table id="example1" class="table table-bordered table-striped">
	        	<thead>
		        	<tr>
		            	<th style="width: 30px;">№</th>
			          	<th>Guruhlar nomi</th>
						<!--  <th class="text-right">Harakatlar</th> -->
		        	</tr>
		        </thead>
		        <tbody>
	        	<?php $i=1; foreach ($ishreja_guruh as $k => $val): ?>
					<tr>
						<th><?=$i++; ?></th>
						<td><a href="<?=site_url("ishreja/ishreja_mavzu/".$ishreja_id.'/'.$val['id'])?>"><?=$val['ishreja_guruh']; ?></a></td>	
					</tr>
					<?php endforeach; ?>
	        	</tbody>
	    	</table>
	    </div> 	
    </div>
</div>



