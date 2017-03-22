<?php
	
	require_once  'includes/init.php';

	if(isset($_POST['todo'])) {
		$task = trim($_POST['task']);

		if(!empty($task)) {
			$addedQuery = $db->prepare("
				INSERT INTO items (task, user, done, created)
				VALUES (:task, :user, 0, NOW())
			");

			$addedQuery->execute([
				'task' => $task,
				'user' => $_SESSION['user_id']
			]);
		}
	}

	header('Location: index.php');