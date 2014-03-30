<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div class="content-wrapper">
		<h3 class="heading-title"><?php echo $video['name']; ?></h3>
		<p id="player" class="video-data"></p>
		<p class="video-info"></p>
    	<script>
			// 2. This code loads the IFrame Player API code asynchronously.
			var tag = document.createElement('script');
			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			// 3. This function creates an <iframe> (and YouTube player)
			//    after the API code downloads.
			var player;
			function onYouTubeIframeAPIReady() {
				player = new YT.Player('player', {
					height: '450',
					width: '850',
					playerVars: {
						start: <?php echo $video["start"]; ?>,
						hd: 1,
						controls: 2,
						enablejsapi: 1
					},
					videoId: '<?php echo $video["video_id"]; ?>',
					events: {
						'onStateChange': onPlayerStateChange
					}
				});
			}
			function onPlayerStateChange(event) {
				if (event.data == YT.PlayerState.PAUSED) {
					setupYAPI();
				}
			}
			function setupYAPI() {
				player.stopVideo();
				if($("#share-start").length != 0) {
					$("#share-start").attr("value", Math.floor(player.getCurrentTime()));
				}
			}
		</script>
		<?php if($share) : ?>
		<div class="share-box">
			<h3><?php echo $share["text"];?></h3>
			<?php if($share["friends"]) : ?>
			<form id="share-form" class="share-form" action="<?php echo $share["action"]; ?>" method="post">
				<input type="submit" value="<?php echo $share["submit"]; ?>" />
				<input id="share-start" type="hidden" name="start" value="0" />
				<input type="hidden" name="video" value="<?php echo $video["video_id"]; ?>" />
				<input type="hidden" name="user_id" value="<?php echo $share["user_id"]; ?>" />
				<p class="fridns_list">
				<?php foreach($share["friends"] as $friend_id => $friend_username) : ?>
					<label for="friend-<?php echo $friend_username; ?>">
						<input id="friend-<?php echo $friend_username; ?>" type="checkbox" name="friends[]" value="<?php echo $friend_id; ?>" /><span><?php echo $friend_username; ?></span>
					</label>
				<?php endforeach; ?>
				</p>
			</form>
			<script type="text/javascript">$(function(){$("form#share-form").live("submit", function(e){setupYAPI();});});</script>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
<?php echo $footer; ?>