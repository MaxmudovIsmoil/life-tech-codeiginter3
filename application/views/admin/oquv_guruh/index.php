<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body" style="margin-top: 0px;">
	        <div class="row">
	        	<?php foreach ($kurslar as $id => $name): ?>
					<div class="col-md-6 col-sm-6 col-12">
						<a href="<?= site_url("oquv_guruh/oquv_guruh_active/".$id)?>">
							<div class="guruh row">
								<div class="col-md-1 col-sm-2 col-2 mt-1">
									<img src="<?=site_url("assets/img_icon/kom.svg")?>" width="140%">
							  	</div>
							  	<div class="col-md-10 col-sm-10 col-10">
									<h5 id="guruh_h5"><?= $name; ?></h5>
							  	</div>
							  	<div class="col-md-1 faol_rezerv">
									<span class="badge badge-warning right faol_rezerv_one" title="To'planayotgan" data-toggle="tooltip" data-placement="top">
									<?php if(array_key_exists($id, $waiting_g)) : ?>
										<?php echo $waiting_g[$id]; ?>
									<?php else : echo 0; ?>
									<?php endif; ?>
									</span>
									<span class="badge badge-primary right" title="O'qiyotgan" data-toggle="tooltip" data-placement="top">
									<?php if(array_key_exists($id, $active_g)) : ?>
										<?php echo $active_g[$id]; ?>
									<?php else : echo 0; ?>
									<?php endif; ?>
									</span>
								</div>
							</div><!-- /.guruh -->
						</a>
					</div>
	        	<?php endforeach ?>
	        </div>
        </div><!-- /.card-body -->
    </div>
</div>

