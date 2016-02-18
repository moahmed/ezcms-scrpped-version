<?php
/*
 * ezCMS Code written by mo.ahmed@hmi-tech.net & mosh.ahmed@gmail.com
 *
 * Version 4.160210
 * HMI Technologies Mumbai
 *
 * View: Allows the user to update the password
 *
 */
 
 // **************** ezCMS USERS CLASS ****************
require_once ("class/profile.class.php"); 

// **************** ezCMS USERS HANDLE ****************
$cms = new ezProfile();

?><!DOCTYPE html><html lang="en"><head>

	<title>Profile &middot; ezCMS Admin</title>
	<?php include('include/head.php'); ?>

</head><body>

	<div id="wrap">
		<?php include('include/nav.php'); ?>
		<div class="container">
			<div class="container-fluid">
			  <div class="row-fluid">
			    <div class="span4"></div>
				<div class="span4 white-boxed">
					<blockquote>
					  <p>Change your password</p>
					  <small>Remember to change your password often.</small>
					</blockquote>
					<?php echo $cms->msg; ?>
					<form id="frmPass" action="profile.php" method="post" enctype="multipart/form-data">
						<label class="control-label" for="inputTitle">Current Password</label>
						<input type="password" id="txtcpass" name="txtcpass"
							placeholder="Existing password"
							title="Enter your existing password here"
							data-toggle="tooltip" data-placement="top"
							class="input-block-level tooltipme2">
						<label class="control-label" for="inputTitle">New Password</label>
						<input type="password" id="txtnpass" name="txtnpass"
							placeholder="New password"
							title="Enter the new password here"
							data-toggle="tooltip" data-placement="top"
							class="input-block-level tooltipme2">
						<label class="control-label" for="inputTitle">Repeat New Password</label>
						<input type="password" id="txtrpass" name="txtrpass"
							placeholder="Repeat new password"
							title="Repeat the new password here"
							data-toggle="tooltip" data-placement="top"
							class="input-block-level tooltipme2">
						<input type="submit" name="Submit" class="btn btn-inverse" value="Change password">
					</form>
				</div>
				<div class="span4"></div>
			  </div>
			</div>
		</div>
	</div>

<?php include('include/footer.php'); ?>
<script type="text/javascript">
	$("#top-bar li").removeClass('active');
	$("#top-bar li:eq(11)").addClass('active');
</script>
</body></html>
