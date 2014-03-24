<?php echo $header; ?>
<?php echo $column_left; ?>
	<div class="content-wrapper">
		<form id="signup-form" class="signup-form" action="<?php echo $action; ?>" method="post">
		<table cellpadding="0" cellspacing="0">
			<tr<?php if($valid_username) : ?> class="warning"<?php endif; ?>>
				<td class="form-label"><?php echo $label_username; ?></td>
				<td class="form-input">
					<input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $placeholder_username; ?>" />
				</td>
				<td class="form-info"><?php if($valid_username) { ?><span class="error"><?php echo $valid_username; ?></span><?php } else { ?><span class="notice"><?php echo $info_username; ?></span><?php } ?></td>
			</tr>
			<tr>
				<td class="form-label"><?php echo $label_email; ?></td>
				<td class="form-input">
					<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $placeholder_email; ?>" />
				</td>
				<td class="form-info"><?php if($valid_email) { ?><span class="error"><?php echo $valid_email; ?></span><?php } else { ?><span class="notice"><?php echo $info_email; ?></span><?php } ?></td>
			</tr>
			<tr<?php if($valid_password) : ?> class="warning"<?php endif; ?>>
				<td class="form-label"><?php echo $label_password; ?></td>
				<td class="form-input">
					<input type="password" name="password" value="" placeholder="<?php echo $placeholder_password; ?>" />
				</td>
				<td class="form-info"><?php if($valid_password) { ?><span class="error"><?php echo $valid_password; ?><?php } else { ?><span class="notice"><?php echo $info_password; ?></span><?php } ?></td>
			</tr>
			<tr<?php if($valid_password_confirm) : ?> class="warning"<?php endif; ?>>
				<td class="form-label"><?php echo $label_password_confirm; ?></td>
				<td class="form-input">
					<input type="password" name="password_confirm" value="" placeholder="<?php echo $placeholder_password_confirm; ?>" />
				</td>
				<td class="form-info"><?php if($valid_password_confirm) { ?><span class="error"><?php echo $valid_password_confirm; ?></span><?php } else { ?><span class="notice"><?php echo $info_password_confirm; ?></span><?php } ?></td>
			</tr>
			<tr>
				<td colspan="3" class="form-submit"><input type="submit" value="<?php echo $submit; ?>" /></td>
			</tr>
		</table>
		</form>
	</div>
<?php echo $footer; ?>