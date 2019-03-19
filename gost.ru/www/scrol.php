<?php

	include 'bd.php';

	$start = $_POST['start'];

	$res = mysqli_query($link,"SELECT * FROM chat ORDER BY id DESC LIMIT {$start}, 10") or die('error');

		$articles = array();

		while ($row = mysqli_fetch_assoc($res)){

   		 $articles[] = $row;

			}

		echo json_encode($articles);
		
		mysqli_close($link);
?>