<?php
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 2.010413 Dated 20/March/2013
 * Rev: 14-Apr-2014 (2.140413)
 * HMI Technologies Mumbai (2013-14)
 *
 * View: Displays the default setting of the site
 *
 */
 
// **************** ezCMS CLASS ****************
require_once ("ezcms.class.php"); // CMS Class for database access
$cms = new ezCMS(); // create new instance of CMS Class with loginRequired = true

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

?><!DOCTYPE html><html lang="en"><head>

	<title>Settings &middot; ezCMS Admin</title>
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
					</div>
				</div>
				<?php echo $msg; ?>

				<div class="tabbable tabs-top">
				<ul class="nav nav-tabs" id="myTab">
				  <li class="active"><a href="#d-main">Main</a></li>
				  <li><a href="#d-header">Header</a></li>
				  <li><a href="#d-sidebar">Sidebar A</a></li>
				  <li><a href="#d-siderbar">Sidebar B</a></li>
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
									value="<?php echo $title; ?>"
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
									class="input-block-level tooltipme2"><?php echo $description; ?></textarea><br>

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
									class="input-block-level tooltipme2"><?php echo $keywords; ?></textarea><br>

							</div>
						  </div>

					</div>
					<div class="tab-pane" id="d-header">
						<textarea name="txtHeader" id="txtHeader" style="width:98%; height:300px"><?php echo $header; ?></textarea>
					</div>
					<div class="tab-pane" id="d-sidebar">
						<textarea name="txtSide" id="txtSide" style="width:98%; height:300px"><?php echo $sidebar; ?></textarea>
					</div>
					<div class="tab-pane" id="d-siderbar">
						<textarea name="txtrSide" id="txtrSide" style="width:98%; height:300px"><?php echo $siderbar; ?></textarea>
					</div>
					<div class="tab-pane" id="d-footer">
						<textarea name="txtFooter" id="txtFooter" style="width:98%; height:300px"><?php echo $footer; ?></textarea>
					</div>
				</div>
				</div>
			  </form>
			</div>
		</div>
	</div>
<?php include('include/footer.php'); ?>
<script type="text/javascript">
	var txtHeader_loaded = true;
	var txtFooter_loaded = true;
	var txtSide_loaded = true;
	var txtSider_loaded = true;
	$("#top-bar li").removeClass('active');
	$("#top-bar li:eq(0)").addClass('active');
	$("#top-bar li:eq(0) ul li:eq(0)").addClass('active');
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
</script>
</body></html>
