<?php
/*
 * ezCMS Code written by mo.ahmed@hmi-tech.net & mosh.ahmed@gmail.com
 *
 * Version 4.160210
 * HMI Technologies Mumbai
 *
 * View: Displays the default setting of the CMS
 *

$site = $cms->query('SELECT * FROM `site` ORDER BY `id` DESC LIMIT 1')
		->fetch(PDO::FETCH_ASSOC); // get the site details
$title       = '';
$keywords    = '';
$description = '';
$header      = htmlspecialchars($site["headercontent" ]);
$sidebar     = htmlspecialchars($site["sidecontent"   ]);
$siderbar    = htmlspecialchars($site["sidercontent"  ]);
$footer      = htmlspecialchars($site["footercontent" ]);

if (isset($_GET["flg"])) $flg = $_GET["flg"]; else $flg = "";
$msg = "";
if ($flg=="red")
	$msg = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>
				<strong>Failed!</strong> An error occurred and the settings were NOT saved.</div>';
if ($flg=="green")
	$msg = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button>
				<strong>Saved!</strong> You have successfully saved the settings.</div>';
if ($flg=="noperms")
	$msg = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">x</button>
				<strong>Permission Denied!</strong> You do not have permissions for this action.</div>';
 
 */
 
// **************** ezCMS SETTINGS CLASS ****************
require_once ("class/settings.class.php"); 

// **************** ezCMS SETTINGS HANDLE ****************
$cms = new ezSettings();

?><!DOCTYPE html><html lang="en"><head>

	<title>Settings : ezCMS Admin</title>
	<?php include('include/head.php'); ?>

</head><body>

	<div id="wrap">
		<?php include('include/nav.php'); ?>
		<div class="container">
			<div class="white-boxed">
			  <form id="frmHome" action="scripts/set-defaults.php" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div class="navbar">
					<div class="navbar-inner">
						<input type="submit" name="Submit" value="Save Changes" class="btn btn-inverse">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Revisions <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">See more ...</a></li>
							</ul>
						</div>	

					</div>
				</div>
				<?php echo $cms->msg; ?>

				<div class="tabbable tabs-top">
				<ul class="nav nav-tabs" id="myTab">
				  <li class="active"><a href="#d-main">Main</a></li>
				  <li><a href="#d-header">Header</a></li>
				  <li><a href="#d-sidebar">Aside 1</a></li>
				  <li><a href="#d-siderbar">Aside 2</a></li>
				  <li><a href="#d-footer">Footer</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="d-main">

						  <div class="control-group">
							<label class="control-label" for="inputEmail">Site Title</label>
							<div class="controls">
								<input type="text" id="txtTitle" name="txtTitle"
									placeholder="Enter the title of the site"
									title="Enter the full title of the site here."
									data-toggle="tooltip"
									value=""
									data-placement="top"
									class="input-block-level tooltipme2"><br>

							</div>
						  </div>

						  <div class="control-group">
							<label class="control-label" for="inputEmail">Description</label>
							<div class="controls">
								<textarea name="txtDesc" rows="5" id="txtDesc"
									placeholder="Enter the description of the site"
									title="Enter the description of the site here, this is VERY IMPORTANT for SEO. Do not duplicate on all pages"
									data-toggle="tooltip"
									data-placement="top"
									class="input-block-level tooltipme2"></textarea><br>

							</div>
						  </div>

						  <div class="control-group">
							<label class="control-label" for="inputEmail">Keywords</label>
							<div class="controls">
							 	<textarea name="txtKeywords" rows="5" id="txtKeywords"
									placeholder="Enter the Keywords of the site"
									title="Enter list keywords of the site here, not so important now but use it anyways. Do not stuff keywords"
									data-toggle="tooltip"
									data-placement="top"
									class="input-block-level tooltipme2"></textarea><br>

							</div>
						  </div>

					</div>
					<div class="tab-pane" id="d-header">
						<textarea name="txtHeader" id="txtHeader" style="width:98%; height:300px"><?php echo $cms->header; ?></textarea>
					</div>
					<div class="tab-pane" id="d-sidebar">
						<textarea name="txtSide" id="txtSide" style="width:98%; height:300px"><?php echo $cms->sidebar; ?></textarea>
					</div>
					<div class="tab-pane" id="d-siderbar">
						<textarea name="txtrSide" id="txtrSide" style="width:98%; height:300px"><?php echo $cms->siderbar; ?></textarea>
					</div>
					<div class="tab-pane" id="d-footer">
						<textarea name="txtFooter" id="txtFooter" style="width:98%; height:300px"><?php echo $cms->footer; ?></textarea>
					</div>
				</div>
				</div>
			  </form>
			</div>
		</div>
	</div>
<?php include('include/footer.php'); ?>
<script type="text/javascript">

	$("#top-bar li").removeClass('active');
	$("#top-bar li:eq(0)").addClass('active');
	$("#top-bar li:eq(0) ul li:eq(0)").addClass('active');
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
</script>
</body></html>
