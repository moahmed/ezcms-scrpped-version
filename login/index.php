<?php 
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 2.010413 Dated 20/March/2013
 * Rev: 14-Apr-2014 (2.140413)
 * HMI Technologies Mumbai (2013-14)
 *
 * View: Login page to ezCMS (index.php)
 * 
 */
 
// Start SESSION if not started 
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start(); 
}

// Set SESSION ADMIN Login Flag to false if not set
if (!isset($_SESSION['LOGGEDIN'])) {
	$_SESSION['LOGGEDIN'] = false;
}

// Redirect the user if already logged in
if ($_SESSION['LOGGEDIN'] == true) { 
	header("Location: pages.php"); 
	exit; 
}		
		
// **************** DATABASE ****************
require_once ("../config.php"); // PDO Class for database access
$dbh = new db; // database handle

// Check if userid is set in the request
$userid = ""; // Reset Login
if (isset($_GET["userid"])) {
	$userid = $_GET["userid"]; 
}

// If userid is not set check session for it.
if ( ($userid == '') && (isset($_SESSION['userid'])) ) { 
	$userid = $_SESSION['userid']; 
}

// Check if Messahe Flag is set
$flg = ""; // Set the error message flag to none
if (isset($_GET["flg"])) { 
	$flg = $_GET["flg"];
}

// Set the HTML to display for this flag
switch ($flg) {
	case "failed":
		$msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Login Failed !</strong><br>Incorrect email or password</div>';
		break;
	case "expired":
		$msg = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Session Expired !</strong><br>Your session has expired</div>';	
		break;
	case "logout":
		$msg = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Logged Out !</strong><br>You have successfully logged out</div>';	
		break;
	case "inactive":
		$msg = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Account Inactive !</strong><br>Your status is NOT Active.</div>';	
		break;
	default:
		$msg = '';
		
} 
?><!DOCTYPE html><html lang="en"><head>

	<title>Login :: ezCMS Admin</title>
	<?php include('include/head.php'); ?>
	<style type="text/css">    
		.form-signin {
			max-width: 300px;
			padding: 19px 29px 29px;
			margin: 60px auto 10px;
			background: rgba(0,0,0,0.75);
		}
		.form-signin .form-signin-heading{
			margin-bottom: 10px; 
			text-align:center; 
		}
		.form-signin input[type="text"],
		.form-signin input[type="password"],
		.form-signin select {
			font-size: 14px;
			margin-bottom: 15px;
			padding: 7px 9px;}
		@media (max-width: 767px) {
			.form-signin {
				padding: 10px 20px 20px;
				margin: 10px auto 10px;}      
		}
	</style>
	
</head><body>
  
	<div id="wrap">
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
			  <a class="brand" href="/">ezCMS &middot; <?php echo $_SERVER['HTTP_HOST']; ?></a>
			  <div class="pull-right" style="color: #FFFFFF;margin: 10px 10px 2px 2px;">Your IP <strong>
				<?php echo $_SERVER['REMOTE_ADDR']; ?></strong> is Logged</div>
			  <div class="clearfix"></div>
		  </div>
		</div>
		<div class="container">
			<form id="frm-login" class="form-signin" method="post" action="scripts/login.php">
				<h3 class="form-signin-heading"><img src="../site-assets/logo.jpg" ><br>Please sign in</h3>
				<?php echo $msg; ?>
				<input type="text" id="txtemail" name="userid"
					class="input-block-level tooltipme2" 
 					data-toggle="tooltip" 
					value="<?php echo $userid; ?>"
					data-placement="top" 
					title="Enter your full email address here."
					placeholder="Email address">
				<input type="password" id="txtpass" name="passwd"
					class="input-block-level tooltipme2" 
 					data-toggle="tooltip" 
					data-placement="top" 
					title="Enter your password here."					
					placeholder="Password">				
				<button class="btn btn-large btn-inverse" type="submit">Sign in</button>
				<p class="pull-right">
					<a id="lnk-restpass" href="#" class="tooltipme2"
						data-toggle="tooltip" 
						data-placement="top" 
						style="display:none;"
						title="Password Lost, recover your password here.">Lost your password?</a><br>
					<a href="/" class="tooltipme2"
						data-toggle="tooltip" 
						data-placement="top" 
						title="Are you lost? Go back to the main site."><< Back to Site</a>
				</p>
				<p class="clearfix"></p>
			</form>
		</div> 
	</div>
<?php include('include/footer.php'); ?>

</body></html>