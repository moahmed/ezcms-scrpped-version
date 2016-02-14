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
	<link rel="stylesheet" href="codemirror/addon/fold/foldgutter.css" />
	<link rel="stylesheet" href="codemirror/theme/liquibyte.css">
	<style>
		.CodeMirror {
		  height: auto;
		}	
	</style>
	
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
        mode: "text/x-php",
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
	$("#top-bar li:eq(0) ul li:eq(1)").addClass('active');
</script>
</body></html>