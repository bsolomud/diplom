<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div class="content-wrapper">
	<?php if(isset($text_error)) { ?>
		<h2 class="empty-page"><?php echo $text_error; ?></h2>
	<?php } else { ?>
		<?php $counter = 0; $total = count($results); ?>
		<table class="video-box" cellspacing="0" cellpadding="0">
		<?php for($i=1;$i<=$total / 3;$i++) : ?>
			<tr>
				<?php for($j=0;$j<3;$j++) : ?>
				<?php $video = array_shift($results); ?>
				<td>
					<a class="play" href="<?php echo $video['href']; ?>" title="<?php echo $video['name']; ?>"></a>
					<span class="title"><?php echo $video['name']; ?></span>
					<?php if($video['thumbnail']) : ?>
					<img src="<?php echo $video['thumbnail']; ?>" />
					<?php endif; ?>
					<span class="published"><?php echo $video['publishedAt']; ?></span>
				</td>
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
		</table>
		<div id="pagination" class="pagination"><?php echo $pagination; ?></div>
		<?php } ?>
	</div>
	<script type="text/javascript">
	$(function(){
		$(".video-box tr td").hover(function(){
			var width = $(this).width();
			var height = $(this).height();
			$(this).children(".play").css({"width": width, "height": height}).fadeIn();
		}).mouseleave(function(){$(this).children(".play").fadeOut();});
	});
	</script>
<?php echo $footer; ?>