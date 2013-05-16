<?php include('header.php') ?>
<div class="pageWrapper wrapper clearfix">
	<div class="pageContent">
		<h3>Account Settings</h3>
		<hr>
		<div id="accountTabsContainer" class="clearfix">
			<ul class="tabs">
				<li nr="1" class="tab gear  <?php if ((isset($_POST['account_info'])) || (empty($_POST)) ) echo 'active'; ?>" >
					<a>Account Info</a>
				</li>
				<li nr="2" class="tab lock <?php if (isset($_POST['change_password'])) echo 'active'; ?>">
					<a>Change Password</a>
				</li>
				<li nr="3" class="tab speech <?php if (isset($_POST['notifications'])) echo 'active'; ?>">
					<a>Notifications</a>
				</li>
			</ul>
			<div id="tabs-1" class="tabContent <?php if ((isset($_POST['account_info'])) || (empty($_POST)) ) echo 'tabContentActive'; ?>">
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="avatarContainer">
						<label>Change Avatar:</label>
						<img id="avatar" src="<?php echo URL.get_user_meta($_SESSION['id'], 'avatar'); ?>" width="150px" height="150px" alt="">
						<input id="file_upload" name="file_upload" type="file">
						<?php if(is_error($errors, 'account_info', 'file_upload')): ?>
							<p class="error">
								<?php echo $errors['account_info']['file_upload']; ?>
							</p>
						<?php endif; ?>
						<?php if (isset($success['account_info']['file_upload'])): ?>
							<p class="success">
								<?php echo $success['account_info']['file_upload']; ?>
							</p>
						<?php endif; ?>
					</div>
					<div class="separator dotted"></div>
					<label>Name:</label>
					<div>
						<input type="text" name="name" value="<?php echo $_SESSION['name']; ?>">
					</div>
					<?php if(is_error($errors, 'account_info', 'name')): ?>
						<p class="error">
							<?php echo $errors['account_info']['name']; ?>
						</p>
					<?php endif; ?>
					<?php if (isset($success['account_info']['name'])): ?>
						<p class="success">
							<?php echo $success['account_info']['name']; ?>
						</p>
					<?php endif; ?>
					<div class="separator dotted"></div>
					<input type="submit" name="account_info" value="Update Settings">
				</form>
			</div>
			<div id="tabs-2" class="tabContent <?php if (isset($_POST['change_password'])) echo 'tabContentActive'; ?>">
				<form action="" method="POST">
					<label>Current Password:</label>
					<div>
						<input type="password" name="current_password">
					</div>
					<?php if(is_error($errors, 'change_password', 'current_password')): ?>
						<p class="error">
							<?php echo $errors['change_password']['current_password']; ?>
						</p>
					<?php endif; ?>
					<div class="separator dotted"></div>
					<label>New Password, twice:</label>
					<div>
						<input type="password" name="new_password">
					</div><br>
					<?php if(is_error($errors, 'change_password', 'new_password')): ?>
						<p class="error">
							<?php echo $errors['change_password']['new_password']; ?>
						</p>
					<?php endif; ?>
					<div>
						<input type="password" name="new_password2">
					</div>
					<?php if(is_error($errors, 'change_password', 'new_password2')): ?>
						<p class="error">
							<?php echo $errors['change_password']['new_password2']; ?>
						</p>
					<?php endif; ?>
					<?php if (isset($success['change_password']['change'])): ?>
						<p class="success">
							<?php echo $success['change_password']['change']; ?>
						</p>
					<?php endif; ?>
					<div class="separator dotted"></div>
					<input type="submit" name="change_password" value="Change Password">
				</form>
			</div>
			<div id="tabs-3" class="tabContent <?php if (isset($_POST['notifications'])) echo 'tabContentActive'; ?>">
				<form action="" method="POST">
					<label>E-mails:</label>
					<div class="row">
						<input type="checkbox" name="alerts">
						<label>Send me newsletter e-mails</label>
					</div>
					<div class="row">
						<input type="checkbox" name="alerts" checked>
						<label>Lorem ipsum dolor sit amet.</label>
					</div>
					<div class="separator dotted"></div>
					<label>Alerts:</label>
					<div class="row">
						<input type="radio" name="other" checked>
						<label>Lorem ipsum dolor sit amet.</label>
					</div>
					<div class="row">
						<input type="radio" name="other">
						<label>Lorem ipsum dolor sit amet.</label>
					</div>
					<div class="separator dotted"></div>
					<input type="submit" name="notifications" value="Update Notifications">
				</form>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php') ?>