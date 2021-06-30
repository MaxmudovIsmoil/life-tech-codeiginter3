<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">
    	<div class="card-header">
        <a class="btn btn-primary" href="<?= site_url("teacher/teacher_create"); ?>" style="font-weight: bold;"><i class="fas fa-plus"></i> Qo'shish</a>
    	</div>
        <!-- /.card-header -->
		  <div class="card-body">
      	<table id="example1" class="table table-bordered table-striped">
          <thead>
          	<tr>
            	<th width="6%">№</th>
				<th>Ismi</th>
				<th>Familyasi</th>
				<th>Mutaxasisligi</th>
				<th>Telefon</th>
				<th>Status</th>
				<th class="text-right">Harakatlar</th>
			</tr>
          </thead>
          <tbody>
          	<?php $i=1; foreach ($teachers as $key => $teacher): ?>
				<tr style="background: <?php if($teacher['status']==1){ echo '#ddf386'; }elseif($teacher['status']==2){echo '#9ae9bd'; }else{ echo '#efb88b';} ?>">
					<th class="align-middle"><?=$i++; ?></th>
					<td class="align-middle"><a href="<?= site_url('teacher/teacher_guruh/'.$teacher['teacher_id'])?>"><?= $teacher['ism'];?></a></td>
					<td class="align-middle"><?=$teacher['familiya']; ?></td>
					<td class="align-middle" style="font-size: 14px; padding-bottom: 3px;padding-top: 3px;">
						<?php foreach($teacher['kurs'] as $k => $kurs) : ?>
							<?= $kurs; ?><br>
						<?php endforeach; ?>
					</td>
					<td class="align-middle"><?= phone_format_helper($teacher['telefon']); ?></td>
					<td class="align-middle"><?php  if($teacher['status']==1) echo "Yangi kelgan"; elseif($teacher['status']==2) echo "Faol"; else echo "Nofaol"; ?></td>

					<td class="text-right py-0 align-middle">
					  <div class="btn-group btn-group-sm">
						<a href="<?= site_url("teacher/teacher_view/".$teacher['teacher_id'])?>" class="btn btn-info" title="To'liq ko'rish" data-toggle="tooltip" data-placement="top">
                            <i class="fas fa-eye"></i>
                        </a>

						<a href="<?= site_url("teacher/teacher_edit/".$teacher['teacher_id'])?>" class="btn btn-primary" title="Tahrirlash" data-toggle="tooltip" data-placement="top">
                            <i class="fas fa-edit"></i>
                        </a>

						<button type="button" data-href="<?= site_url("teacher/teacher_delet/".$teacher['teacher_id'])?>" data-title="<?= $teacher['ism']?>" class="btn btn-danger js_delete_item" title="O'chirish" aria-label="O'chirish" data-toggle="modal" data-target="#delete_notify">
							<i class="fas fa-trash"></i>
						</button>
					  </div>
					</td>
				</tr>
			<?php endforeach ?>
          </tbody>
      	</table>
      </div>
	</div>
</div>
