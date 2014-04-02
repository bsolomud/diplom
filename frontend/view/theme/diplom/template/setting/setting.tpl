<?php echo $header; ?>
	<?php echo $column_left; ?>
	<div id="content" class="content-wrapper">
		<form id="setting-form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data
			">
		<table cellpadding="5" cellspacing="0">
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
			<tr<?php if(isset($error["config_error_log"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_error_log["text"]; ?></td>
				<td>
					<?php foreach($radio as $value => $text) : ?>
					<label for="config_error_log-<?php echo $value; ?>"><?php echo $text; ?>&nbsp;
						<input id="config_error_log-<?php echo $value; ?>" type="radio" name="config_error_log" value="<?php echo $value; ?>"<?php if($value == $config_error_log["value"]) : ?> checked="checked"<?php endif; ?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endforeach; ?>
				</td>
			</tr>
			<tr<?php if(isset($error["config_error_display"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_error_display["text"]; ?></td>
				<td>
					<?php foreach($radio as $value => $text) : ?>
					<label for="config_error_display-<?php echo $value; ?>"><?php echo $text; ?>&nbsp;
						<input id="config_error_display-<?php echo $value; ?>" type="radio" name="config_error_display" value="<?php echo $value; ?>"<?php if($value == $config_error_display["value"]) : ?> checked="checked"<?php endif; ?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endforeach; ?>
				</td>
			</tr>
			<tr<?php if(isset($error["config_seo_url"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_seo_url["text"]; ?></td>
				<td>
					<?php foreach($radio as $value => $text) : ?>
					<label for="config_seo_url-<?php echo $value; ?>"><?php echo $text; ?>&nbsp;
						<input id="config_seo_url-<?php echo $value; ?>" type="radio" name="config_seo_url" value="<?php echo $value; ?>"<?php if($value == $config_seo_url["value"]) : ?> checked="checked"<?php endif; ?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endforeach; ?>
				</td>
			</tr>
			<tr<?php if(isset($error["connection"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $connection["text"]; ?></td>
				<td>
					<?php foreach($connections as $value => $text) : ?>
					<label for="connection-<?php echo $value; ?>"><?php echo $text; ?>&nbsp;
						<input id="connection-<?php echo $value; ?>" type="radio" name="connection" value="<?php echo $value; ?>"<?php if($value == $connection["value"]) : ?> checked="checked"<?php endif; ?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endforeach; ?>
				</td>
			</tr>
			<tr<?php if(isset($error["config_meta_description"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_meta_description["text"]; ?></td>
				<td>
					<textarea name="config_meta_description" cols="80" rows="5"><?php echo $config_meta_description["value"]; ?></textarea>
				</td>
			</tr>
			<tr<?php if(isset($error["config_template"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_template["text"]; ?></td>
				<td>
					<select name="config_template">
					<?php foreach($templates as $value => $text) : ?>
						<option value="<?php echo $value; ?>"<?php if($value == $config_template["value"]) : ?> selected="selected"<?php endif; ?>><?php echo $text; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr<?php if(isset($error["config_language"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_language["text"]; ?></td>
				<td>
					<select name="config_language">
					<?php foreach($languages as $value => $text) : ?>
						<option value="<?php echo $value; ?>"<?php if($value == $config_language["value"]) : ?> selected="selected"<?php endif; ?>><?php echo $text; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr<?php if(isset($error["config_url"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_url["text"]; ?></td>
				<td><input type="text" name="config_url" value="<?php echo $config_url["value"]; ?>" /></td>
			</tr>
			<tr<?php if(isset($error["config_video_limit"])) : ?> class="warning"<?php endif; ?>>
				<td class="config-fieldname"><?php echo $config_video_limit["text"]; ?></td>
				<td><input type="text" name="config_video_limit" value="<?php echo $config_video_limit["value"]; ?>" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="<?php echo $submit; ?>" /></td>
			</tr>
		</table>
		</form>
	</div>
<?php echo $footer; ?>