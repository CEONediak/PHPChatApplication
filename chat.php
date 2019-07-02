<?php
    session_start();



    $from_username = $_SESSION["usr_username"];
    

    $usr_no ="";

    if(isset($_GET["usr_no"])){

        $usr_no = trim($_GET["usr_no"]);
    }

    $usr_no = intval($_GET["usr_no"]);

   require_once 'inc/DB_FUNCTIONS.php';
   $database = new DB_FUNCTIONS();
   $result = $database->get_user_by_id($usr_no);

   
   $to_username = $result["usr_username"];

   if(isset($_POST["submit"])){

        $message = trim($_POST["message"]);

        $database->insert_message($to_username,$message,$from_username);
        echo 'chat sent.';

   }

   

?>

<form method="post">
    <label>From:</label>
    <input type="text" name="to_username" value="<?php echo $from_username; ?>" disabled><br><br>
    <label>To:</label>
    <input type="text" name="to_username" value="<?php echo $to_username; ?>" disabled><br><br>
    <textarea type="text" name="message" placeholder="Message"></textarea>
    <button name="submit">Send</button>
</form>