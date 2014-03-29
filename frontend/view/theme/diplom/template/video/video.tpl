<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div class="content-wrapper">
		<h3 class="heading-title"><?php echo $video['name']; ?></h3>
		<p class="video-data">
		<?php echo $video['embed']; ?>
		</p>
		<p class="video-info">

		</p>
		<?php if($share) : ?>
		<div class="share-box">
			<h3><?php echo $share["text"];?></h3>
			<?php if($share["friends"]) : ?>
			<form id="share-form" class="share-form" action="<?php echo $share["action"]; ?>" method="post">
				<input type="submit" name="user_id" value="<?php echo $share["submit"] ?>" />
				<input id="share-start" type="hidden" name="start" value="0" />
				<input type="hidden" value="<?php echo$share["user_id"]; ?>" />
				<p class="fridns_list">
				<?php foreach($share["friends"] as $friend_id => $friend_username) : ?>
					<label for="friend-<?php echo $friend_username; ?>">
						<input id="friend-<?php echo $friend_username; ?>" type="checkbox" name="friends[]" value="<?php echo $friend_id; ?>" /><span><?php echo $friend_username; ?></span>
					</label>
				<?php endforeach; ?>
				</p>
			</form>
			<?php endif; ?>
		</div>
		<script type="text/javascript">
		$(function(){
			$("form#share-form").live("submit", function(){
				var start = 0;
				// Set start via Youtube Javascript API
				$("input#share-start").attr("value", start);
			});
		});
		</script>
		<?php endif; ?>
	</div>
<?php echo $footer; ?>