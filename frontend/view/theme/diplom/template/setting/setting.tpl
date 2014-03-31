<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div class="content-wrapper">
		<div id="setting-tabs" class="setting-tabs">
		<?php foreach($settings as $group => $rows) : ?>
		<a tab="setting-<?php echo $group; ?>"><span><?php echo $language[$group]; ?></span></a>
		<?php endforeach; ?>
		</div>
		<form id="setting-form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data
			">
		<?php foreach($settings as $group => $rows) : ?>
		<div id="setting-<?php echo $group; ?>">
		<table cellpadding="0" cellspacing="0">
			<?php foreach($rows as $key => $value) : ?>
			<tr>
				<td><?php echo $language[$key]; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
		</div>
		<?php endforeach; ?>
		</form>
	</div>
<?php echo $footer; ?>