<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div class="content-wrapper">
		<h3 class="heading-title"><?php echo $video['name']; ?></h3>
		<p class="video-info">

		</p>
		<p class="video-data">
		<?php echo $video['embed']; ?>
		</p>
		<p class="share-form">
			<form id="share-form" action="<?php echo $share_action; ?>" method="post">
				
			</form>
		</p>
	</div>
<?php echo $footer; ?>