<?php
	
	require_once 'includes/init.php';

	if(isset($_GET['task'])){
		$task = $_GET['task'];

		$sql="DELETE FROM items WHERE id=:task";
		$q = $db->prepare($sql);
		$q->execute(array(':task'=>$task));
	}

	header('Location: index.php');