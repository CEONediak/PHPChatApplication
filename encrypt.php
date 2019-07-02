<!DOCTYPE html>
<html>
<head>
	<title>Encryptor</title>
</head>
<body>
	<form action='encrypt.php' method="POST">
		<label>Input Text to Encrypt: </label><input type="text" name="pass">
		<input type="submit" name="encrypt" value="ENCRYPT THIS TEXT">
	</form>
</body>
</html>


<?php //encryptor
	if (isset($_POST['encrypt'])) {
		extract($_POST);

		$salt1 = "Silent";$salt2 = '_T_T';
		$encry_pass = hash('ripemd128', "$salt1$pass$salt2");

		echo "<br>The Encrypted Text: ".$encry_pass;
		echo "<br><br>Kindly insert this to the password column in the database for access. Thanks";

	}
	
?>