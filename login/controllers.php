<?php
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 2.010413 Dated 20/March/2013
 * Rev: 14-Apr-2014 (2.140413)
 * HMI Technologies Mumbai (2013-14)
 *
 * View: Displays the php controller of the site
 * /index.php
 */

// **************** ezCMS CLASS ****************
require_once ("ezcms.class.php"); // CMS Class for database access
$cms = new ezCMS(); // create new instance of CMS Class with loginRequired = true

$filename = "../index.php";
$content = @fread(fopen($filename, "r"), filesize($filename));
$content =  htmlspecialchars($content);
if (isset($_GET["flg"])) $flg = $_GET["flg"]; else $flg = "";
$msg = "";
if ($flg=="red") 
	$msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
				<strong>Failed!</strong> An error occurred and the controller were NOT saved.</div>';
if ($flg=="green")
	$msg = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button>
				<strong>Saved!</strong> You have successfully saved the controller.</div>';
if ($flg=="pink") 
	$msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
				<strong>Failed!</strong> The controller file is NOT writeable.
				You must contact HMI Tech Support to resolve this issue.</div>';
if ($flg=="noperms") 
	$msg = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">x</button>
				<strong>Permission Denied!</strong> You do not have permissions for this action.</div>';

?><!DOCTYPE html><html lang="en"><head>

	<title>Controller &middot; ezCMS Admin</title>
	<?php include('include/head.php'); ?>
	
</head><body>
  
	<div id="wrap">
		<?php include('include/nav.php'); ?>  
		<div class="container">
				
				<div class="white-boxed">
					<form id="frmHome" action="scripts/set-controller.php" method="post" enctype="multipart/form-data">
					<div class="navbar">
						<div class="navbar-inner">
							<input type="submit" name="Submit" value="Save Changes" class="btn btn-inverse">
						</div>
					</div>
					<?php echo $msg; ?>
					<textarea name="txtContents" id="txtContents" class="input-block-level"
				  		style="height: 420px; width:100%"><?php echo $content; ?></textarea>
					</form>
					
				</div>
			  </div>

		</div> 
	</div>

<?php include('include/footer.php'); ?>
<script type="text/javascript">
	$("#top-bar li").removeClass('active');
	$("#top-bar li:eq(0)").addClass('active');
	$("#top-bar li:eq(0) ul li:eq(1)").addClass('active');
</script>
</body></html>
