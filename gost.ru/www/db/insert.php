<?php

if($_GET['count'] != ''){

	include '/../bd.php';

	$Name = file('Name.txt');
	$Email = file('Email.txt');
	$Tegs = file('Tegs.txt');
	$Message = file('Message.txt');

	for($i = 0; $i < $_GET['count']; $i++){
		$Random1 = rand(0,count($Name));
		$Rname = $Name[$Random1];
		$Random2 = rand(0,count($Email));
		$Remail = $Email[$Random2];
		$Random3 = rand(0,count($Tegs));
		$Rtegs = $Tegs[$Random3];
		$Random4 = rand(0,count($Message));
		$Rmessage = $Message[$Random4];
		$Rdate = ''.rand(2018,2019).'.'.rand(1,12).'.'.rand(1,31).' '.rand(0,24).'.'.rand(0,60).'.'.rand(0,60).'';

		mysqli_query($link,"INSERT INTO chat (name, email, tegs, message, dateT) VALUES ('$Rname', '$Remail', '$Rtegs', '$Rmessage', '$Rdate')");
	}
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>insert</title>
</head>
<body>
<center>
	<h1>Заполнение базы данных</h1>
	<form action="insert.php" method="get">
		<label for="">Укажите количество записей, которое вы хотите добавить</label><br><br>
		<input name="count" type="text">
		<input type="submit" value="Добавить"><br><br>
		<a href="/../index.php"><input type="button" value="Вернуться на главную страницу"></a>
	</form>
</center>
</body>
</html>