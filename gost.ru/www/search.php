<?php session_start();

include 'bd.php';
			if($_GET['page']==''){
				$start=0;
			}else{
				$start=(($_GET['page'])-1)*16;
			}
			$end=16;
			if($_GET['page'] != '' || $_GET['email'] != '' || $_GET['dateT'] != '' || $_GET['name'] != '' || $_GET['tegs'] != ''){
				$flag=0;
			if($_GET['name']==''){
				if($_GET['date']!=''){
					$search = $_GET['dateT'];
					$query = "SELECT * FROM chat WHERE dateT=".$search." ORDER BY dateT DESC LIMIT ".$start." , ".$end." ";
					$hod=1;
					$flag=1;
					$query1 = "SELECT id FROM chat WHERE dateT=".$search." ";
				}else if($_GET['email'] != ''){
					$search = $_GET['email'];
					$query = "SELECT * FROM chat WHERE email LIKE '%".$search."%' ORDER BY dateT DESC LIMIT ".$start." , ".$end." ";
					$hod=0;
					$flag=2;
					$query1 = "SELECT id FROM chat WHERE email LIKE '%".$search."%' ";
				}else if($_GET['tegs'] != ''){
					$search = $_GET['tegs'];
					$query = "SELECT * FROM chat WHERE tegs LIKE '%".$search."%' ORDER BY dateT DESC LIMIT ".$start." , ".$end." ";
					$hod=0;
					$flag=4;
					$query1 = "SELECT id FROM chat WHERE tegs LIKE '%".$search."%' ";
				}else{
					$flag=5;
					$query = "SELECT * FROM chat ORDER BY dateT DESC LIMIT ".$start." , ".$end." ";
					$query1 = "SELECT id FROM chat ";
				}
			}else{
				$search = $_GET['name'];
				$query = "SELECT * FROM chat WHERE name LIKE '%".$search."%' ORDER BY dateT DESC LIMIT ".$start." , ".$end." ";
				$hod=3;
				$flag=3;
				$query1 = "SELECT id FROM chat WHERE name LIKE '%".$search."%' ";
			}
				}
				else{
					$flag=5;
					$query = "SELECT * FROM chat ORDER BY dateT DESC LIMIT ".$start." , ".$end." ";
					$query1 = "SELECT id FROM chat ";
				}
$res=mysqli_query($link,$query) or die('error');
$message=array();
while($row = mysqli_fetch_assoc($res)){
	$message[]=$row;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Гостевая книга</title>
	<link rel="stylesheet" href="styles.css" type="text/css">
	<script src="jquery.js"></script>
	<script type="text/javascript" src="scripts.js"></script>
</head>
<body>
	<header>
	<h1>Поиск на сайте</h1>
	</header>
	
	<form id="formSabmit" action="search.php" method="get">
		<label for="">Сортировка по:</label>
		<select name="" id="check">
			<option value="name">Имени</option>
			<option value="email">Эл. почте</option>
			<option value="date">Дате</option>
			<option value="tegs">Тегам</option>
		</select><br><br>
		<label id="name1" class="formIn" for="name">Имя</label>
		<input id="name2" class="formIn" type="text" name="name">
		<label id="email1" class="formIn" for="email">Еmail</label>
		<input id="email2" class="formIn" type="email" name="email">
		<label id="date1" class="formIn" for="date">Дата</label>
		<input id="date2" class="formIn" type="text" name="date">
		<label id="tegs1" class="formIn" for="tegs">Теги</label>
		<input id="tegs2" class="formIn" type="text" name="tegs"><br><br>
		<input type="submit" class="submit1" value="Поиск">
		<a href="index.php"><input type="button" class="submit1" value="Назад"></a>
	</form>
	<table id="content" border="1px">
	<?php foreach ($message as $article): ?>
        <tr>
        <td class="name"><b><?= $article['name']; ?></b><br/><?= $article['email']; ?></td>
        <td class="message"><b><?= $article['tegs']; ?></b><br/><br/><?= $article['message']; ?></td>
        <td class="date"><?= $article['dateT']; ?></td>
        </tr>
	<?php endforeach; ?>
	</table>
			<div class="str">
				<ul>
					<?php 
			switch ($flag){
				case 1:
					$poisk = '&dateT='.$search;
					break;
				case 2:
					$poisk = '&email='.$search;
					break;
				case 3:
					$poisk = '&name='.$search;
					break;
				case 4:
					$poisk = '&tegs='.$search;
					break;
				case 5:
					$poisk = '';
					break;
			}


			$result = mysqli_query($link, $query1) or die (mysqli_error($link));
			$data = Array();
			while($row = $result->fetch_assoc()) {
  	  	$data[] = $row;
  		}
  			$st=1;
  			$schet=1;
  			$count_str = ceil((count($data))/16);
  			if($count_str<=10){
  				for($i=1;$i<=$count_str;$i++){
  				echo '<a href="?page='.$st.''.$poisk.'"><li class="stranica">'.$i.'</li></a>';
  				$st++;
  				}
  			}else{
  				for($i=1;$i<=$count_str;$i++){
  					if($_GET['page']<6){
  						if($schet==8){
  						echo '<li class="stranica">...</li>';
  						}else if($schet==9){
  						echo '<a href="?page='.$count_str.''.$poisk.'"><li class="stranica">'.$count_str.'</li></a>';
  						break;
  						}else{
  						echo '<a href="?page='.$st.''.$poisk.'"><li class="stranica">'.$i.'</li></a>';
  						}
  					}else if($_GET['page']>=6 && $_GET['page']<($count_str-4)){
  						if($schet==8){
  						echo '<li class="stranica">...</li>';
  						}else if($schet==2){
  						echo '<li class="stranica">...</li>';
  						$i= ($_GET['page']-3);
  						$st= ($_GET['page']-3);
  						}else if($schet==9){
  						echo '<a href="?page='.$count_str.''.$poisk.'"><li class="stranica">'.$count_str.'</li></a>';
  						break;
  						}else{
  						echo '<a href="?page='.$st.''.$poisk.'"><li class="stranica">'.$i.'</li></a>';
  						}
  					}else{
  						if($i==2){
  						echo '<li class="stranica">...</li>';
  						$i= ($count_str-7);
  						$st= ($count_str-7);
  						}else{
  						echo '<a href="?page='.$st.''.$poisk.'"><li class="stranica">'.$i.'</li></a>';
  					}
  					}
  				$st++;
  				$schet++;
  				}
  			}
  		?>
  		</ul>
  	</div>
	<footer>
		<p>&copy <?= date('Y'); ?> Gost.ru</p>
	</footer>
</body>
</html>
<?php
mysqli_close($link);
?>