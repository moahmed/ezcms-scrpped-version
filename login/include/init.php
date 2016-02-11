<?php
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 2.010413 Dated 20/March/2013
 * Rev: 14-Apr-2014 (2.140413)
 * HMI Technologies Mumbai (2013-14)
 *
 * Include: starts the session and checks if user is logged in and connects db
 * To be included on all logged in pages of admin
 */
 
// Start SESSION if not started 
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start(); 
}

// Set SESSION ADMIN Login Flag to false if not set
if (!isset($_SESSION['LOGGEDIN'])) {
	$_SESSION['LOGGEDIN'] = false;
}

// Redirect the user if NOT logged in
if ($_SESSION['LOGGEDIN'] == false) { 
	header("Location: index.php?flg=expired"); 
	exit; 
}

// **************** DATABASE ****************
require_once ("../config.php"); // PDO Class for database access
$dbh = new db; // database handle

?>