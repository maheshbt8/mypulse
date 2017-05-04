<?php
@extract($this->session->flashdata('data'));
if(isset($errors)){
	foreach ($errors as $e) {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <?php echo $e; ?>
		</div>
		<?php		
	}
}

if(isset($infos)){
	foreach ($infos as $e) {
		?>
		<div class="alert alert-warning alert-dismissible" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <?php echo $e; ?>
		</div>
		<?php		
	}
}

if(isset($warnings)){
	foreach ($warnings as $e) {
		?>
		<div class="alert alert-info alert-dismissible" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <?php echo $e; ?>
		</div>
		<?php		
	}
}

if(isset($success)){
	foreach ($success as $e) {
		?>
		<div class="alert alert-success alert-dismissible" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <?php echo $e; ?>
		</div>
		<?php		
	}
}
?>