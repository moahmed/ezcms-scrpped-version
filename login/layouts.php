<?php
/*
 * ezCMS Code written by mo.ahmed@hmi-tech.net & mosh.ahmed@gmail.com
 *
 * Version 4.160210
 * HMI Technologies Mumbai
 *
 * View: Displays the layouts in the CMS
 * 
 */
 
// **************** ezCMS CONTROLLER CLASS ****************
require_once ("class/layouts.class.php"); 

// **************** ezCMS CONTROLLER HANDLE ****************
$cms = new ezLayouts(); 
 
?><!DOCTYPE html><html lang="en"><head>

	<title>Layouts : ezCMS Admin</title>
	<?php include('include/head.php'); ?>
	<link rel="stylesheet" href="codemirror/addon/fold/foldgutter.css" />
	<link rel="stylesheet" href="codemirror/theme/liquibyte.css">
	
</head><body>
  
	<div id="wrap">
		<?php include('include/nav.php'); ?>  
		<div class="container">
			<div class="container-fluid">
			  <div class="row-fluid">
				<div class="span3 white-boxed">
				
					<ul id="left-tree">
					  <li class="open" ><i class="icon-list-alt icon-white"></i> 
					  	<a class="<?php echo $cms->homeclass; ?>" href="layouts.php">layout.php</a>
						<?php echo $cms->treehtml; ?>
					  </li>					
					</ul>
					
				</div>
				<div class="span9 white-boxed">
					<form id="frmlayout" action="layouts.php" method="post" enctype="multipart/form-data">
						<div class="navbar">
							<div class="navbar-inner">


								<div class="btn-group">
								  <a class="btn dropdown-toggle btn-inverse" data-toggle="dropdown" href="#"> New <span class="caret"></span></a>
									
								  <div class="dropdown-menu subddmenu">
									<blockquote>
									  <p>New layout name</p>
									  <small>Only Alphabets and Numbers, no spaces</small>
									</blockquote>
									<div class="input-append">
									  <input id="txtNew" name="txtSaveAs" type="text" class="appendedInput">
									  <span class="add-on">.php</span>
									</div><br>
									<p><a id="btnnew" href="#" class="btn btn-large btn-info">Create New</a></p>
								  </div>
								  
								</div>
								
								<input type="submit" name="Submit" id="Submit" value="Save" class="btn btn-inverse"> 
								<div class="btn-group">
								  <a class="btn dropdown-toggle btn-inverse" data-toggle="dropdown" href="#">
									Save As <span class="caret"></span></a>
									
								  <div class="dropdown-menu subddmenu">
									<blockquote>
									  <p>Save layout as</p>
									  <small>Only Alphabets and Numbers, no spaces</small>
									</blockquote>
									<div class="input-append">
									  <input id="txtSaveAs" name="txtSaveAs" type="text" class="appendedInput">
									  <span class="add-on">.php</span>
									</div><br>
									<p><a id="btnsaveas" href="#" class="btn btn-large btn-info">Save Now</a></p>
								  </div>
								  
								</div>
								<?php echo $cms->deletebtn; ?>
							</div>
						</div>
						<?php echo $cms->msg; ?>
						<input type="hidden" name="txtName" id="txtName" value="<?php echo $cms->filename; ?>">
						<textarea name="txtContents" id="txtContents" class="input-block-level"><?php echo $cms->content; ?></textarea>
					</form>
				</div>
				
			  </div>
			</div>
		</div> 
	</div>

<?php include('include/footer.php'); ?>

<script src="codemirror/lib/codemirror.js"></script>
<script src="codemirror/mode/javascript/javascript.js"></script>
<script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="codemirror/addon/edit/matchbrackets.js"></script>
<script src="codemirror/mode/xml/xml.js"></script>
<script src="codemirror/addon/fold/foldcode.js"></script>
<script src="codemirror/addon/fold/foldgutter.js"></script>
<script src="codemirror/addon/fold/brace-fold.js"></script>
<script src="codemirror/addon/fold/xml-fold.js"></script>
<script src="codemirror/addon/fold/markdown-fold.js"></script>
<script src="codemirror/addon/fold/comment-fold.js"></script>
<script src="codemirror/mode/css/css.js"></script>
<script src="codemirror/mode/clike/clike.js"></script>
<script src="codemirror/mode/php/php.js"></script>

<script type="text/javascript">

	var myCode = CodeMirror.fromTextArea(document.getElementById("txtContents"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true,
		theme: 'liquibyte',
		lineWrapping: true,
		extraKeys: {"Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); }},
		foldGutter: true,
		gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
        viewportMargin: Infinity
	});


	$("#top-bar li").removeClass('active');
	$("#top-bar li:eq(0)").addClass('active');
	$("#top-bar li:eq(0) ul li:eq(3)").addClass('active');
	$('.subddmenu').click(function (e) {
		e.stopPropagation();
	});	
	$('#btnsaveas').click( function () {
		var saveasfile = $('#txtSaveAs').val().trim();
		if (saveasfile.length < 1) {
			alert('Enter a valid filename to save as.');
			$('#txtSaveAs').focus();
			return false;
		}
		if (!saveasfile.match(/^[a-z0-9]+$/ig)) {
			alert('Enter a valid filename with lower case alphabets and numbers only.');
			$('#txtSaveAs').focus();
			return false;		
		}
		$('#txtName').val('layout.'+saveasfile+'.php');		
		$('#Submit').click();
		return false;
	});
			
</script>
</body></html>