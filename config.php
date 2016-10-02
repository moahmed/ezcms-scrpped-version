<?php
/*
 * Code written by mo.ahmed@hmi-tech.net
 *
 * Version 4.0.0 Dated 06-Fec-2016
 * HMI Technologies Mumbai (2015-16)
 *
 * Include: ezCMS Configuration File - config.php
 * Provides database connection class for ezCMS
 */
class db extends PDO {
	
	public function __construct() {
	
		/**  MySQL database name */
		$DB_NAME = 'ezcms_db';
		
		/** MySQL database username */
		$DB_USER = 'root';
		
		/** MySQL database password */
		$DB_PASSWORD = '';
		
		/** MySQL hostname */
		$DB_HOST = 'localhost';		
		
		try {
		
			/** MySQL Connect */
			parent::__construct("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD );
						
		} catch (PDOException $e) { 
		
			/** MySQL Connection error message */ 
			header('HTTP/1.0 500 Internal Server Error');
			die("<h1>Site down for maintenance.</h1><p>Please visit us later !</p>");
			
		}

	}
	
} ?>