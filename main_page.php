<?php
session_start();
require_once 'inc/DB_FUNCTIONS.php';
$database = new DB_FUNCTIONS();


$usr_username = $_SESSION["usr_username"];
//count messages
$users = $database->get_messages_by_username($usr_username);

//Get online users
$result = $database->get_all_users($usr_username);



if (!isset($_SESSION["isloggedIn"])) {
    header('location:index.php');
    exit();
  }


  
  if(isset($_POST["submit"])){

    session_start();
    $_SESSION["usr_username"] = $username;

  }
  


?>
<html>
  <head>
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Chat App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="messages.php?username=<?php echo $usr_username; ?>">Messages
        <span class="badge badge-danger">
            <?php echo count($users); ?>
        </span></a>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Hi <?php echo $usr_username; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php" onclick="return confirm('Are you sure?');">logout</a>
        </div>
      </li>
    
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class="container">
  <h3>There are <?php echo count($result); ?> Active Users</h3>
  <?php if(count($result)>0):  ?>
    <table class="table table-stripe table-responsive">
      <tr>
        <th>LASTNAME</th>
        <th>FIRSTNAME</th>
        <th>Action</th>
      </tr>
      <?php foreach($result as $val): ?>  
        <tr>
          <td><?php echo $val["usr_lname"] ?></td>
          <td><?php echo $val["usr_fname"] ?></td>
          <td>
            <form method="post">
              <a class="btn btn-success" href="chat.php?usr_no=<?php echo $val["usr_no"];?>">Chat</a>
            </form>
            
          </td>
        </tr>
      <?php endforeach ?>  
    </table>
  <?php endif ?>
</div>
</html>