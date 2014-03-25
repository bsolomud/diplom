<?php echo $header; ?>
<?php echo $column_left; ?>
	<div class="content-wrapper">
		<form id="signin-form" class="signin-form" action="<?php echo $action; ?>" method="post">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td class="form-label"><?php echo $label_username; ?></td>
				<td class="form-input">
					<input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $placeholder_username; ?>" />
				</td>
			</tr>
			<tr>
				<td class="form-label"><?php echo $label_password; ?></td>
				<td class="form-input">
					<input type="password" name="password" value="<?php echo $password; ?>" autocomplete="off" placeholder="<?php echo $placeholder_password; ?>" />
				</td>
			</tr>
			<tr>
				<td colspan="2" class="form-submit"><input type="submit" value="<?php echo $label_submit; ?>" /></td>
			</tr>
		</table>
		</form>
	</div>
<?php echo $footer; ?>