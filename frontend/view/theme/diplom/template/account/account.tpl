<?php echo $header; ?>
<?php echo $column_left; ?>
	<div class="content-wrapper">
		<form id="account-form" class="account-form" action="<?php echo $action; ?>" method="post">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td class="form-label"><?php echo $label_username; ?></td>
				<td class="form-input">
					<input type="text" name="username" value="<?php echo $username; ?>" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<td class="form-label"><?php echo $label_email; ?></td>
				<td class="form-input">
					<input type="text" name="email" value="<?php echo $email; ?>" />
				</td>
			</tr>
			<tr>
				<td class="form-label"><?php echo $label_password; ?></td>
				<td class="form-input">
					<input type="password" name="password" value="<?php echo $password; ?>" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td class="form-label"><?php echo $label_password_confirm; ?></td>
				<td class="form-input">
					<input type="password" name="password_confirm" value="<?php echo $password_confirm; ?>" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td class="form-label"><?php echo $label_friends; ?></td>
				<td class="form-input input-area">
					<table cellpadding="0" cellspacing="0">
					<?php foreach($users as $user) : ?>
						<tr>
							<td class="input">
								<input type="checkbox" name="friends[]" value="<?php echo $user["user_id"]; ?>"<?php if(in_array($user["user_id"], $friends)) : ?> checked="checked"<?php endif; ?> />
							</td>
							<td><?php echo $user["username"]; ?></td>
						</tr>
					<?php endforeach; ?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="form-submit"><input type="submit" value="<?php echo $label_submit; ?>" /></td>
			</tr>
		</table>
		</form>
	</div>
<?php echo $footer; ?>