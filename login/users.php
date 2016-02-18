<?php
/*
 * ezCMS Code written by mo.ahmed@hmi-tech.net & mosh.ahmed@gmail.com
 *
 * Version 4.160210
 * HMI Technologies Mumbai
 *
 * View: Displays the users in the site
 *
 


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
	
} else {
	if (!$_SESSION['edituser']) {
		// permission denied
		header("Location: users.php?flg=noperms");
		exit;
	}	
}

if (isset($_GET["flg"])) $msg = getErrorMsg($_GET["flg"]); else $msg = ""; 
 
 */
 
 // **************** ezCMS USERS CLASS ****************
require_once ("class/users.class.php"); 

// **************** ezCMS USERS HANDLE ****************
$cms = new ezUsers();

?><!DOCTYPE html><html lang="en"><head>

	<title>Users &middot; ezCMS Admin</title>
	<?php include('include/head.php'); ?>

</head><body>

	<div id="wrap">
		<?php include('include/nav.php'); ?>
		<div class="container">
			<div class="container-fluid">
			  <div class="row-fluid">
				<div class="span3 white-boxed"><?php echo $cms->treehtml; ?></div>
				<div class="span9 white-boxed">
					<form id="frmUser" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
					  <div class="navbar">
							<div class="navbar-inner">
								<input type="submit" name="Submit" class="btn btn-inverse" style="padding:5px 12px;"
									value="<?php echo $cms->addNewBtn; ?>">
								<?php
									if ($cms->id != 'new') echo
										'<a href="?id=new" class="btn btn-inverse">New User</a> ';
									if (($cms->id != 'new') && ($cms->id != 1)) echo '<a href="scripts/del-user.php?delid=' . $cms->id .
										'" onclick="return confirm(\'Confirm Delete ?\');" class="btn btn-danger">Delete</a>';
								?>
							</div>
						</div>

						<?php echo $cms->msg; ?>

						<div class="row" style="margin-left:0">
							<div class="span4">
								<label for="inputName">User Name</label>
								<input type="text" id="txtusername" name="txtusername"
									placeholder="Enter the full name"
									title="Enter the full name of the user here."
									data-toggle="tooltip"
									value="<?php echo $cms->thisUser['username']; ?>"
									data-placement="top"
									class="input-block-level tooltipme2">
							</div>
							<div class="span4">
								<label for="inputEmail">Email Address</label>
								<input type="text" id="txtemail" name="txtemail"
									placeholder="Enter the full email address"
									title="Enter the full email address of the user here."
									data-toggle="tooltip"
									value="<?php echo $cms->thisUser['email']; ?>"
									data-placement="top"
									class="input-block-level tooltipme2">
							</div>
							<div class="span4">
								<label for="txtpsswd">Password</label>
								<input type="text" id="txtpsswd" name="txtpsswd"
									placeholder="<?php if ($cms->id=='new') echo 'Enter the password'; else echo 'Leave blank to keep unchanged';?>"
									title="<?php if ($cms->id=='new') echo 'Enter the password here'; else echo 'Enter a new password or leave blank to keep unchanged';?>"
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
										value="checkbox" <?php echo $cms->thisUser['activeCheck']; ?>>
									Active</label><?php echo $cms->thisUser['activeMsg']; ?>
								<hr>
								<label class="checkbox">
									<input name="ckeditpage" type="checkbox" id="ckeditpage" 
										value="checkbox" <?php echo $cms->thisUser['editpageCheck']; ?>>
									Manage Pages</label><?php echo $cms->thisUser['editpageMsg']; ?>
								<br><br>
								<label class="checkbox">
									<input name="ckdelpage" type="checkbox" id="ckdelpage" value="checkbox" 
										<?php echo $cms->thisUser['delpageCheck']; ?>>
									Delete Pages</label><?php echo $cms->thisUser['delpageMsg']; ?>
								<hr>
							</div>
							<div class="span4">
								<label class="checkbox">
									<input name="ckedituser" type="checkbox" id="ckedituser" value="checkbox" <?php echo $cms->thisUser['edituserCheck']; ?>>
									Manage Users</label><?php echo $cms->thisUser['edituserMsg']; ?>

								<br><br>
								<label class="checkbox">
									<input name="ckdeluser" type="checkbox" id="ckdeluser" value="checkbox" <?php echo $cms->thisUser['deluserCheck']; ?>>
									Delete Users</label><?php echo $cms->thisUser['deluserMsg']; ?>

								<hr>
								<label class="checkbox">
									<input name="ckeditsettings" type="checkbox" id="ckusemailer" value="checkbox" <?php echo $cms->thisUser['editsettingsCheck']; ?>>
									Manage Settings</label><?php echo $cms->thisUser['editsettingsMsg']; ?>

								<br><br>
								<label class="checkbox">
									<input name="ckeditcontroller" type="checkbox" id="ckeditcontroller" value="checkbox" <?php echo $cms->thisUser['editcontCheck']; ?>>
									Manage Router</label><?php echo $cms->thisUser['editcontMsg']; ?>
									
								<hr>

							</div>
							<div class="span4">
								<label class="checkbox">
									<input name="ckeditlayout" type="checkbox" id="ckeditlayout" value="checkbox" <?php echo $cms->thisUser['editlayoutCheck']; ?>>
									Manage Layouts</label><?php echo $cms->thisUser['editlayoutMsg']; ?>

								<br><br>
								<label class="checkbox">
									<input name="ckeditcss" type="checkbox" id="ckeditcss" value="checkbox" <?php echo $cms->thisUser['editcssCheck']; ?>>
									Manage Styles</label><?php echo $cms->thisUser['editcssMsg']; ?>

								<br><br>
								<label class="checkbox">
									<input name="ckeditjs" type="checkbox" id="ckeditjs" value="checkbox" <?php echo $cms->thisUser['editjsCheck']; ?>>
									Manage Javascripts</label><?php echo $cms->thisUser['editjsMsg']; ?>

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
