<?php
session_start();
require_once 'inc/DB_FUNCTIONS.php';
$database = new DB_FUNCTIONS();

//get my username
    $myusername =   $_SESSION["username"];

    $reply_username = "";

    if(isset($_GET['reply_username'])){

        $reply_username = trim($_GET["reply_username"]);
    }
   
    if(isset($_POST["submit"])){

        $message = trim($_POST["message"]);
        $database->insert_message($reply_username,$message,$myusername);

      
        echo 'chat sent.';
    }

    
?>

<form method="post">
    <p>From: <?php echo $myusername; ?> </p>
    <p>To: <?php echo $reply_username; ?> </p>
    <textarea type="text" name="message" placeholder="Message"></textarea><br><br>
    <button name="submit">Send</button>
</form>