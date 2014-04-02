<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div class="content-wrapper">
		<?php if($videolist) { ?>
		<table class="video-box shared-box" cellspacing="0" cellpadding="0">
		<?php foreach($videolist as $video) : ?>
		<tr>
			<td>
				<a class="play" href="<?php echo $video['href']; ?>" title="<?php echo $video['title']; ?>"></a>
				<span class="title"><?php echo $video['title']; ?></span>
				<?php if($video['thumbnail']) : ?>
				<img src="<?php echo $video['thumbnail']; ?>" />
				<?php endif; ?>
				<span class="published"><?php echo $video['shared']; ?></span>
			</td>
		</tr>
		<?php endforeach; ?>
		</table>
		<script type="text/javascript">
		$(function(){
			$(".video-box tr td").hover(function(){
				var width = $(this).width();
				var height = $(this).height();
				$(this).children(".play").css({"width": width, "height": height}).fadeIn();
			}).mouseleave(function(){$(this).children(".play").fadeOut();});
		});
		</script>
		<div class="pagination"><?php echo $pagination; ?></div>
		<?php } else { ?>
		<h3 class="no-results"><?php echo $no_shared; ?></h3>
		<?php } ?>
	</div>
<?php echo $footer; ?>