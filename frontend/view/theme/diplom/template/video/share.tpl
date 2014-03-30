<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div class="content-wrapper">
		<?php if($videolist) { ?>

		<?php } else { ?>
		<h3 class="no-results"><?php echo $no_shared; ?></h3>
		<?php } ?>
	</div>
<?php echo $footer; ?>