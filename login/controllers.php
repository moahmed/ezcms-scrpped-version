<?php
/*
 * ezCMS Code written by mo.ahmed@hmi-tech.net & mosh.ahmed@gmail.com
 *
 * Version 4.160210
 * HMI Technologies Mumbai
 *
 * View: ezCMS Controller Management
 * 
 */

// **************** ezCMS CONTROLLER CLASS ****************
require_once ("class/controller.class.php"); 

// **************** ezCMS CONTROLLER HANDLE ****************
$cms = new ezController(); 

?><!DOCTYPE html><html lang="en"><head>

	<title>Controller : ezCMS Admin</title>
	<?php include('include/head.php'); ?>
	
</head><body>
  
	<div id="wrap">
		<?php include('include/nav.php'); ?>  
		<div class="container"><div class="white-boxed">
		  <form id="frmHome" action="controllers.php" method="post" enctype="multipart/form-data">
			<div class="navbar">
				<div class="navbar-inner">
					<input type="submit" name="Submit" value="Save Changes" class="btn btn-inverse">
				</div>
			</div>
			<?php echo $cms->msg; ?>
			<textarea name="txtContents" id="txtContents" class="input-block-level"><?php echo $cms->content; ?></textarea>
		  </form>
		</div></div> 
	</div>

<?php include('include/footer.php'); ?>
<script type="text/javascript">
	$("#top-bar li").removeClass('active');
	$("#top-bar li:eq(0)").addClass('active');
	$("#top-bar li:eq(0) ul li:eq(1)").addClass('active');
</script>
</body></html>