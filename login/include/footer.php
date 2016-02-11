<?php
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 2.010413 Dated 20/March/2013
 * Rev: 14-Apr-2014 (2.140413)
 * HMI Technologies Mumbai (2013-14)
 *
 * Include: Displays the footer
 * 
 */

// Fetch the site stats
$stats = $dbh->query('SELECT COUNT(DISTINCT `url`) as `ispublished` from `pages` where `published`=1')->fetch(PDO::FETCH_ASSOC);
?>
<div class="clearfix"></div>
<div id="footer">
  <div class="container">
    <div class="row-fluid" style="text-align:center; font-size:0.9em; ">
      <div class="span3"><a target="_blank" href="http://www.hmi-tech.net/">&copy; HMI Technologies</a> 
	  </div>
      <div class="span6"> 
  	    <a href="../sitemap.xml"><strong><?php echo $stats['ispublished']; ?></strong> published page(s)</a>	  
	  </div>
      <div class="span3"> <a target="_blank" href="http://www.hmi-tech.net/">ezCMS Version: <strong>4.160210</strong></a> </div>
    </div>
  </div>
</div>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.treeview/jquery.treeview.js"></script>
<script type="text/javascript">
	$('.tooltipme2').tooltip();
	$("#left-tree").treeview({
		collapsed: true,
		animated: "medium",
		unique: true
	});	
</script>