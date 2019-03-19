<?php
	session_start();
	include 'bd.php';

	$name = mysql_real_escape_string(trim(htmlspecialchars(strip_tags($_POST['name']))));
	$email = mysql_real_escape_string(trim(htmlspecialchars(strip_tags($_POST['email']))));
	$tegs = mysql_real_escape_string(trim(htmlspecialchars(strip_tags($_POST['tegs']))));
	$message = mysql_real_escape_string(trim(htmlspecialchars(strip_tags($_POST['message']))));
	$dateT = mysql_real_escape_string(trim(htmlspecialchars(strip_tags($_POST['date']))));
	$captcha = mysql_real_escape_string(trim(htmlspecialchars(strip_tags($_POST['captcha']))));

if($_SESSION['secpic']==strtolower($captcha)){
	$res = mysqli_query($link,"INSERT INTO chat (name, email, tegs, message, dateT) VALUES ('$name', '$email', '$tegs', '$message', '$dateT')");
	if($res==true){
		echo json_encode(array('name' => $name, 'email' => $email, 'message' => $message, 'dateT' => $dateT, 'tegs' => $tegs));
	}
}
else{
		echo "captcha введена неверно";
	}

		mysqli_close($link);
?>