<?php
  require_once 'includes/init.php';

  $itemsQuery = $db->prepare("
        SELECT id, task, done
        FROM items
        WHERE user = :user
        ORDER BY id DESC
    ");

  $itemsQuery->execute([
        'user' => $_SESSION['user_id']
    ]);

  $items = $itemsQuery->rowCount() ?  $itemsQuery : [];

  // foreach ($items as $item ) {
  //   echo $item['name'], '<br/>';
  // }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png">

    <title>Todo List</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/font-awesome/font-awesome.min.css">
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">To Do List</a>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <div class="list">
          <h1>To Do List</h1>
          <?php if (!empty($items)): ?>
          <ul class="items">
            <?php foreach ($items as $item ): ?>
              <li>
                <span class="item <?php echo $item['done'] ? 'done' : '' ?>"><?php echo $item['task']; ?></span>
                <?php if(!$item['done']): ?>
                <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as done</a>
                <?php endif; ?>
                <?php if($item['done']): ?>
                <a href="trash.php?task=<?php echo $item['id']; ?>" class="done-button"><i class="fa fa-key"></i> Delete</a>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>  
          </ul>
          <?php else: ?>
              <p>You haven't added any items yet</p>
          <?php endif; ?>
          <form  class="item-add" action="add.php" method="post">
            <input type="text" name="task" placeholder="Type a new item here." class="input" autocomplete="off" required/>
            <input  type="submit" name="todo" value="Add" class="btn btn-default" />
          </form>
        </div>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
