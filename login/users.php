<?php
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 2.010413 Dated 20/March/2013
 * Rev: 14-Apr-2014 (2.140413)
 * HMI Technologies Mumbai (2013-14)
 *
 * View: Displays the users in the site
 *
 */
 
 
// **************** ezCMS CLASS ****************
require_once ("class/ezcms.class.php"); // CMS Class for database access
$cms = new ezCMS(); // create new instance of CMS Class with loginRequired = true



// this function will echo the user tree
function getUserTreeHTML($id) {
	return false;
	$sql = 'select `id` , `username` , `active` from `users` where id<>1 order by id;';		
    $rs = mysql_query($sql) or die("Unable to Execute  Select query");
    echo '<ul id="left-tree">';
	if ($id==1) $myclass = 'class="label label-info"'; else $myclass='';
	echo '<li class="open"><i class="icon-globe"></i> <a '.$myclass.' href="users.php?id=1">Webmaster</a>';
		echo '<ul>';
		while ($row = mysql_fetch_assoc($rs)) {
			echo '<li><i class="icon-user"></i> '  ;
			if ( $row["id"] == $id)  
				echo '<a class="label label-info" href="users.php?id=' . $row["id"] . '"> ' . $row["username"];
			else
				echo '<a href="users.php?id=' . $row["id"] . '"> ' . $row["username"];
				if ($row['active']!=1) echo ' <i class="icon-ban-circle" title="User is not active, cannot login"></i> ';
			echo '</a></li>';
		}
		echo '</ul>';
	echo '</li></ul>';
}

// this function will return the error html if any
function getErrorMsg($flg) {
	$msg = "";

	if ($flg=="red") 
		$msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Save Failed!</strong> An error occurred and the user was NOT saved.</div>';
	if ($flg=="green")
		$msg = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Saved!</strong> You have successfully saved the page.</div>';	
					
	if ($flg=="pink") 
		$msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Add Page Failed!</strong> An error occurred and the user was NOT added.</div>';
	if ($flg=="added")
		$msg = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Added!</strong> You have successfully added the user.</div>';			

	if ($flg=="delfailed") 
		$msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Delete Failed!</strong> An error occurred and the user was NOT deleted.</div>';
	if ($flg=="deleted")
		$msg = '<div class="alert"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Deleted!</strong> You have successfully deleted the user.</div>';

	if ($flg=="noname") 
		$msg = '<div class="alert"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Invalid User Name!</strong> Please check the user name, lenght must be more that FOUR.</div>';
	if ($flg=="noemail") 
		$msg = '<div class="alert"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Invalid Email!</strong> Please check the email, lenght must be more that FOUR.</div>';					
	if ($flg=="nopass") 
		$msg = '<div class="alert"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Invalid Password!</strong> Please check the password, lenght must be more that FOUR.</div>';
	if ($flg=="noperms") 
		$msg = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Permission Denied!</strong> You do not have permissions for this action.</div>';

	if ($flg=="yell") 
		$msg = '<div class="alert"><button type="button" class="close" data-dismiss="alert">x</button>
					<strong>Not Found!</strong> You have requested a user which does not exist.</div>';	
					
	return $msg;
} 

if (isset($_REQUEST["id"])) $id =  $_REQUEST["id"] ; else $id = 1;
$username = '';
$email = '';
$active = '';
$viewstats = '';
$edituser = '';
$deluser = '';
$editpage = '';
$delpage = '';
$editsettings = '';
$editcontroller = '';
$editlayout = '';
$editcss = '';
$editjs = '';



if ($id <> 'new') {
	/*
	$qry = "SELECT * FROM `users` WHERE `id` = " . $id;
	$rs = mysql_query($qry);
	if (!mysql_num_rows($rs))
		header("Location: users.php?show=&flg=yell");
	$arr = mysql_fetch_array($rs);
	$username= $arr["username"];
	$email= $arr["email"];
	if ($arr["active"] == 1) $active= "checked";
	if ($arr["viewstats"] == 1) $viewstats= "checked";
	if ($arr["edituser"] == 1) $edituser= "checked";
	if ($arr["deluser"] == 1) $deluser= "checked";
	if ($arr["editpage"] == 1) $editpage= "checked";
	if ($arr["editpage"] == 1) $editpage= "checked";
	if ($arr["delpage"] == 1) $delpage= "checked";
	if ($arr["editsettings"] == 1) $editsettings= "checked";
	if ($arr["editcont"] == 1) $editcontroller= "checked";
	if ($arr["editlayout"] == 1) $editlayout= "checked";
	if ($arr["editcss"] == 1) $editcss= "checked";
	if ($arr["editjs"] == 1) $editjs= "checked";
	mysql_free_result($rs);
	*/
} else {
	if (!$_SESSION['edituser']) {
		// permission denied
		header("Location: users.php?flg=noperms");
		exit;
	}	
}

if (isset($_GET["flg"])) $msg = getErrorMsg($_GET["flg"]); else $msg = "";

?><!DOCTYPE html><html lang="en"><head>

	<title>Users &middot; ezCMS Admin</title>
	<?php include('include/head.php'); ?>

</head><body>

	<div id="wrap">
		<?php include('include/nav.php'); ?>
		<div class="container">
			<div class="container-fluid">
			  <div class="row-fluid">
				<div class="span3 white-boxed"><?php getUserTreeHTML($id); ?></div>
				<div class="span9 white-boxed">
					<form id="frmUser" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
					  <div class="navbar">
							<div class="navbar-inner">
								<input type="submit" name="Submit" class="btn btn-inverse" style="padding:5px 12px;"
									value="<?php if ($id == 'new') echo 'Add New'; else echo 'Save Changes';?>">
								<?php
									if ($id != 'new') echo
										'<a href="?id=new" class="btn btn-inverse">New User</a> ';
									if (($id != 'new') && ($id != 1)) echo '<a href="scripts/del-user.php?delid=' . $id .
										'" onclick="return confirm(\'Confirm Delete ?\');" class="btn btn-danger">Delete</a>';
								?>
							</div>
						</div>

						<?php echo $msg; ?>

						<div class="row" style="margin-left:0">
							<div class="span4">
								<label for="inputName">User Name</label>
								<input type="text" id="txtusername" name="txtusername"
									placeholder="Enter the full name"
									title="Enter the full name of the user here."
									data-toggle="tooltip"
									value="<?php echo $username; ?>"
									data-placement="top"
									class="input-block-level tooltipme2">
							</div>
							<div class="span4">
								<label for="inputEmail">Email Address</label>
								<input type="text" id="txtemail" name="txtemail"
									placeholder="Enter the full email address"
									title="Enter the full email address of the user here."
									data-toggle="tooltip"
									value="<?php echo $email; ?>"
									data-placement="top"
									class="input-block-level tooltipme2">
							</div>
							<div class="span4">
								<label for="txtpsswd">Password</label>
								<input type="text" id="txtpsswd" name="txtpsswd"
									placeholder="<?php if ($id=='new') echo 'Enter the password'; else echo 'Leave blank to keep unchanged';?>"
									title="<?php if ($id=='new') echo 'Enter the password here'; else echo 'Enter a new password or leave blank to keep unchanged';?>"
									data-toggle="tooltip"
									data-placement="top"
									class="input-block-level tooltipme2">
							</div>
						</div>
						<h4 style="margin:20px 0; padding:10px; background:rgba(0,0,0,0.5);">
							User privileges </h4>

						<div class="row" style="margin-left:0">
							<div class="span4">
								<label class="checkbox">
									<input name="ckactive" type="checkbox" id="ckactive"
										value="checkbox" <?php echo $active; ?>>
									Active</label>
								<?php if ($active == "checked") echo
										'<span class="label label-info">User is Active.</span>';
									else echo
										'<span class="label label-important">Inactive user cannot login.</span>';?>
								<br><br>
								<label class="checkbox">
									<input name="ckviewstats" type="checkbox" id="ckviewstats" value="checkbox" <?php echo $viewstats; ?>>
									Visitor Tracking</label>
								<?php if ($viewstats == "checked") echo
										'<span class="label label-info">Visitor tracking available.</span>';
									else echo
										'<span class="label label-important">Visitor tracking blocked.</span>';?>
								<hr>
								<label class="checkbox">
									<input name="ckeditpage" type="checkbox" id="ckeditpage" value="checkbox" <?php echo $editpage; ?>>
									Manage Pages</label>
								<?php if ($editpage == "checked") echo
										'<span class="label label-info">Page management available.</span>';
									else echo
										'<span class="label label-important">Page management blocked.</span>';?>
								<br><br>
								<label class="checkbox">
									<input name="ckdelpage" type="checkbox" id="ckdelpage" value="checkbox" <?php echo $delpage; ?>>
									Delete Pages</label>
								<?php if ($delpage == "checked") echo
										'<span class="label label-info">Page delete available.</span>';
									else echo
										'<span class="label label-important">Page delete blocked.</span>';?>
								<hr>
							</div>
							<div class="span4">
								<label class="checkbox">
									<input name="ckedituser" type="checkbox" id="ckedituser" value="checkbox" <?php echo $edituser; ?>>
									Manage Users</label>
								<?php if ($edituser == "checked") echo
										'<span class="label label-info">User can manage other users.</span>';
									else echo
										'<span class="label label-important">User cannot manage other users.</span>';?>
								<br><br>
								<label class="checkbox">
									<input name="ckdeluser" type="checkbox" id="ckdeluser" value="checkbox" <?php echo $deluser; ?>>
									Delete Users</label>
								<?php if ($deluser == "checked") echo
										'<span class="label label-info">User can delete other users.</span>';
									else echo
										'<span class="label label-important">User cannot delete other users.</span>';?>
								<hr>
								<label class="checkbox">
									<input name="ckeditsettings" type="checkbox" id="ckusemailer" value="checkbox" <?php echo $editsettings; ?>>
									Manage Settings</label>
								<?php if ($editsettings == "checked") echo
										'<span class="label label-info">Template Settings management available.</span>';
									else echo
										'<span class="label label-important">Template Settings management blocked.</span>';?>
								<br><br>
								<label class="checkbox">
									<input name="ckeditcontroller" type="checkbox" id="ckeditcontroller" value="checkbox" <?php echo $editcontroller; ?>>
									Manage Controller</label>
								<?php if ($editcontroller == "checked") echo
										'<span class="label label-info">Template Controller management available.</span>';
									else echo
										'<span class="label label-important">Template Controller management blocked.</span>';?>
								<hr>

							</div>
							<div class="span4">
								<label class="checkbox">
									<input name="ckeditlayout" type="checkbox" id="ckeditlayout" value="checkbox" <?php echo $editlayout; ?>>
									Manage Layouts</label>
								<?php if ($editlayout == "checked") echo
										'<span class="label label-info">Template Layout management available.</span>';
									else echo
										'<span class="label label-important">Template Layout management blocked.</span>';?>
								<br><br>
								<label class="checkbox">
									<input name="ckeditcss" type="checkbox" id="ckeditcss" value="checkbox" <?php echo $editcss; ?>>
									Manage Styles</label>
								<?php if ($editcss == "checked") echo
										'<span class="label label-info">Template Stylesheet management available.</span>';
									else echo
										'<span class="label label-important">Template Stylesheet management blocked.</span>';?>
								<br><br>
								<label class="checkbox">
									<input name="ckeditjs" type="checkbox" id="ckeditjs" value="checkbox" <?php echo $editjs; ?>>
									Manage Javascripts</label>
								<?php if ($editjs == "checked") echo
										'<span class="label label-info">Template Javascript management available.</span>';
									else echo
										'<span class="label label-important">Template Javascript management blocked.</span>';?>
								<hr>
							</div>
						</div>
				    </form>
				</div>
			  </div>
			</div>
		</div>
	</div>

<?php include('include/footer.php'); ?>
<script type="text/javascript">
	$("#top-bar li").removeClass('active');
	$("#top-bar li:eq(10)").addClass('active');
</script>
</body></html>
