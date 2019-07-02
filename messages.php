<?php
    $my_username = "";

    if(isset($_GET["username"])){

        $my_username = trim($_GET["username"]);
    }

   
  //  echo $my_username;

    require_once 'inc/DB_FUNCTIONS.php';
    $database = new DB_FUNCTIONS();

    $messages = $database->get_messages_by_username($my_username);

    

  if(isset($_POST["submit"])){
      session_start();
      $_SESSION["username"] = $my_username;
      
      header('location:reply.php');

  }

?>

<html>
    <head>
        <title>Messages</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>

    <br>

<div  class"cotainer">
    <div class="page-header">
        <h3>Messages</h3>
        <table align="center" class="table table-responsive table-striped">
            <tr>
                <th>
                    FROM
                </th>
                <th>
                    MESSAGE
                </th>
                <th>
                    CREATED_AT
                </th>
                <th>
                    ACTIONS
                </th>
            </tr>
            <?php foreach($messages as $value): ?>
                <tr>
                    <td>
                        <?php echo htmlentities($value["from_username"]); ?>
                    </td>
                    <td>
                         <?php echo htmlentities($value["message"]); ?>    
                    </td>

                    <td>
                    <?php echo htmlentities($value["created_at"]); ?>
                    </td>
                    <form method="post">
                        <td>
                            <button name="submit">
                                <a href="reply.php?reply_username=<?php echo htmlentities($value["from_username"]); ?>">Reply</a>
                            </button>
                            
                        </td>
                    </form>
                    
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    
</div>   
</html>