<?php 
/*
 * ezCMS Code written by mo.ahmed@hmi-tech.net & mosh.ahmed@gmail.com
 *
 * Version 4.160210
 * HMI Technologies Mumbai
 *
 * Class: ezCMS Users Class 
 * 
 */

// **************** ezCMS CLASS ****************
require_once ("ezcms.class.php"); // CMS Class for database access

class ezUsers extends ezCMS {

	public $id = 1;
	
	public $treehtml = '';
	
	public $addNewBtn;
	
	public $thisUser;
	
	// Consturct the class
	public function __construct () {
	
		// call parent constuctor
		parent::__construct();
		
		// Update the Controller of Posted
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->update();
		}
		
		// Check if file to display is set
		if (isset($_GET['id'])) {
			$this->id = $_GET['id'];
		} 
		
		if ($this->id <> 'new' ) {
			$this->thisUser = $this->query('SELECT * FROM `users` WHERE `id` = '.$this->id.' LIMIT 1')
				->fetch(PDO::FETCH_ASSOC); // get the selected user details
			
			$this->setOptions('active', 'User is Active.', 'Inactive user cannot login.');
			$this->setOptions('editpage', 'Page management available.', 'Page management blocked.');
			$this->setOptions('delpage', 'Page delete available.', 'Page delete blocked.');
			$this->setOptions('edituser', 'User can manage other users.', 'User cannot manage other users.');
			$this->setOptions('deluser', 'User can delete other users.', 'User cannot delete other users.');
			$this->setOptions('editsettings', 'Template Settings management available.', 'Template Settings management blocked.');
			$this->setOptions('editcont', 'Template Controller management available.', 'Template Controller management blocked.');
			$this->setOptions('editlayout', 'Template Layout management available.', 'Template Layout management blocked.');
			$this->setOptions('editcss', 'Stylesheet management available.', 'Stylesheet management blocked.');
			$this->setOptions('editjs', 'Javascript management available.', 'Javascript management blocked.');
			
		}

		//Build the HTML Treeview
		$this->buildTree();
		
		// Get the Message to display if any
		$this->getMessage();

	}

	protected function setOptions($itm, $msgOn, $mgsOff) {
		if ($this->thisUser[$itm]) {
			$this->thisUser[$itm.'Check'] = 'checked';
			$this->thisUser[$itm.'Msg'] = '<span class="label label-info">'.$msgOn.'</span>';
		} else {
			$this->thisUser[$itm.'Check'] = '';
			$this->thisUser[$itm.'Msg'] = '<span class="label label-important">'.$mgsOff.'</span>';
		}
	}	

	// Function to Build Treeview HTML
	private function buildTree() {
		$this->treehtml = '<ul id="left-tree">';
		foreach ($this->query("SELECT `id`, `username`, `active` FROM `users` ORDER BY id;") as $entry) {
			$myclass = ($entry["id"] == $this->id) ? 'label label-info' : '';
			$this->treehtml .= '<li><i class="icon-user icon-white"></i> <a href="users.php?id='.
				$entry['id'].'" class="'.$myclass.'">'.$entry["username"].'</a></li>';
			
			
		}
		$this->treehtml .= '</ul>';		
		
/*    echo '<ul id="left-tree">';
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
*/
	}
	

	// Function to Update the Controller
	private function update() {
	
		// Check all the variables are posted
		if ( (!isset($_POST['Submit'])) || (!isset($_POST['txtContents'])) ) {
			header('HTTP/1.1 400 BAD REQUEST');
			die('Invalid Request');
		}

		// Check permissions
		if (!$this->usr['editcont']) {
			header("Location: controllers.php?flg=noperms");
			exit;
		}
		
	}
	
	// Function to Set the Display Message
	private function getMessage() {

		// Set the HTML to display for this flag
		switch ($this->flg) {
			case "failed":
				$this->setMsgHTML('error','Save Failed !','An error occurred and the controller was NOT saved.');
				break;
			case "saved":
				$this->setMsgHTML('success','Controller Saved !','You have successfully saved the controller.');
				break;
			case "unwriteable":
				$this->setMsgHTML('error','Not Writeable !','The controller file is NOT writeable.');
				break;
			case "noperms":
				$this->setMsgHTML('info','Permission Denied !','You do not have permissions for this action.');
				break;
		}

	}

}
?>