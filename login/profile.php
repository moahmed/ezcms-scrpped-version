<?php
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 2.010413 Dated 20/March/2013
 * Rev: 14-Apr-2014 (2.140413)
 * HMI Technologies Mumbai (2013-14)
 *
 * View: Allows the user to update the password
 *
 */
 
// **************** ezCMS CLASS ****************
require_once ("ezcms.class.php"); // CMS Class for database access
$cms = new ezCMS(); // create new instance of CMS Class with loginRequired = true
 
// Class to handle post data
class cmsProfile {
	
	// Message to display if any.
	public $msg;	
	
	// Consturct the class
	public function __construct() {
	
		// Set message to empty
		$this->msg = "";
		
		// If form is posted then process it
		if (isset($_REQUEST['Submit'])) {
			$this->update();
		}
 
 	}
	
	// this function will check and update the password
	private function update() {
	
		// Get handle to database
		global $cms;
		
		// check all the variables are posted
		if ( (!isset($_POST['txtcpass'])) || (!isset($_POST['txtnpass'])) || (!isset($_POST['txtrpass'])) ) {
			header('HTTP/1.1 400 BAD REQUEST');
			die('Invalid Request');
		}
		
		// Get the POST data
		$curpass = trim($_POST['txtcpass']); 
		$newpass = trim($_POST['txtnpass']);
		$reppass = trim($_POST['txtrpass']);
		
		// check password match
		if ($newpass != $reppass) {
			$this->setMsgHTML('error','Password Mismatch !',
				'The new password and repeat password do not match.');
			return;
		} 
		
		// check password len
		if (strlen($newpass)<8) {
			$this->setMsgHTML('error','Password Too Short !',
				'The new password must be more than 8 characters in lenght.');
			return;
		}
		
		// Prepare SQL to fetch user's record from dataabse
		$id = $_SESSION['USERID'];
		$stmt = $cms->prepare("SELECT `id` FROM `users` WHERE `id` = $id AND `passwd` = SHA2( ? , 512 ) LIMIT 1");
		$stmt->execute( array($curpass) );

		// Check if User Record is present and returned from the database
		if ($stmt->rowCount()) {
		
			// update the password  here
			$stmt = $cms->prepare("UPDATE `users` SET `passwd` = SHA2( ? , 512 ) WHERE `id` = $id ");
			if ($stmt->execute( array($newpass) ) ) {
				// Database update done
				$this->setMsgHTML('success','New Password Saved !',
					'You have successfully changed your password.');
			} else {
				// Database update failed
				$this->setMsgHTML('error','Current Password Mismatch !',
					'Your current password is incorrect.');
			}
			
			return;
		}
		
		// Current password failed
		$this->setMsgHTML('error','Current Password Mismatch !',
			'Your current password is incorrect.');

	}
	
}

// Create an instance of the handler
$profile = new cmsProfile;

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

					<?php echo $profile->msg; ?>

					<form id="frmPass" action="profile.php" method="post" enctype="multipart/form-data">

						<label class="control-label" for="inputTitle">Current Password</label>
						<input type="text" id="txtcpass" name="txtcpass"
							placeholder="Existing password"
							title="Enter your existing password here"
							data-toggle="tooltip" data-placement="top"
							class="input-block-level tooltipme2">

						<label class="control-label" for="inputTitle">New Password</label>
						<input type="text" id="txtnpass" name="txtnpass"
							placeholder="New password"
							title="Enter the new password here"
							data-toggle="tooltip" data-placement="top"
							class="input-block-level tooltipme2">

						<label class="control-label" for="inputTitle">Repeat New Password</label>
						<input type="text" id="txtrpass" name="txtrpass"
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
</script>
</body></html>
