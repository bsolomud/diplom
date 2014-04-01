<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div class="content-wrapper">
		<div id="setting-tabs" class="setting-tabs">
		<?php foreach($tabs as $tab_id => $tab_name) : ?>
		<a tab="setting-<?php echo $tab_id; ?>"><span><?php echo $tab_name; ?></span></a>
		<?php endforeach; ?>
		</div>
		<form id="setting-form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data
			">
		<div id="setting-config">
		<table cellpadding="0" cellspacing="0">
			<tr<?php if(isset($error["config_title"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_title["text"]; ?></td>
				<td><input type="text" name="config_title" value="<?php echo $config_title["value"]; ?>" /></td>
			</tr>
			<tr<?php if(isset($error["config_name"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_name["text"]; ?></td>
				<td><input type="text" name="config_name" value="<?php echo $config_name["value"]; ?>" /></td>
			</tr>
			<tr<?php if(isset($error["config_email"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_email["text"]; ?></td>
				<td><input type="text" name="config_email" value="<?php echo $config_email["value"]; ?>" /></td>
			</tr>
			<tr<?php if(isset($error["config_error_filename"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_error_filename["text"]; ?></td>
				<td><input type="text" name="config_error_filename" value="<?php echo $config_error_filename["value"]; ?>" /></td>
			</tr>
			
		</table>
		</div>
		</form>
	</div>
<?php echo $footer; ?>