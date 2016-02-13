<?php 
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 2.010413 Dated 20/March/2013
 * Rev: 14-Apr-2014 (2.140413)
 * HMI Technologies Mumbai (2013-14)
 *
 * Class: ezCMS Class 
 * 
 */

// **************** DATABASE ****************
require_once ("../config.php"); // PDO Class for database access

// Class to handle post data
class ezCMS extends db {

	
	public $flg = ''; // Set the error message flag to none
	public $msg = ''; // Message to disaply if any
	public $usr; // Logged in user record

	// Consturct the class
	public function __construct ( $loginRequired = true ) {
	
		// call parent constuctor
		parent::__construct();
		
		// Start SESSION if not started 
		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start(); 
		}
		
		// Set SESSION ADMIN Login Flag to false if not set
		if (!isset($_SESSION['LOGGEDIN'])) {
			$_SESSION['LOGGEDIN'] = false;
		}
		
		// Redirect the user if NOT logged in
		if ((!$_SESSION['LOGGEDIN']) && ($loginRequired) ) { 
			header("Location: index.php?flg=expired"); 
			exit; 
		}
		
		// Fetch the Logged in users details if login is required
		if ($loginRequired) { 
			$this->usr = $this->query('SELECT * FROM `users` WHERE `id` = '.
				$_SESSION['USERID'].' LIMIT 1')->fetch(PDO::FETCH_ASSOC); // get the user details
		}
		
		// Check if Message Flag is set
		if (isset($_GET["flg"])) { 
			$this->flg = $_GET["flg"];
		}
		
	}

	// this function will set the formatted html to display
	public function setMsgHTML ($class, $caption, $subcaption ) {
		$this->msg = '<div class="alert alert-'.$class.'">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<strong>'.$caption.'</strong><br>'.$subcaption.'</div>';
	}

}
?>