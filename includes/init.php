<?php
	session_start();

	$_SESSION['user_id'] = 1;

	$db = new PDO('mysql:dbname=todo;host=localhost', 'root', '');

	// Redirect if not logged in
	if(!isset($_SESSION['user_id'])){
		die('You are not signed in.');
	}