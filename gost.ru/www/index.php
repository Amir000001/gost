<?php session_start();

include 'bd.php';
if($_GET['page']==''){
				$start=0;
			}else{
				$start=(($_GET['page'])-1)*16;
			}
			$end=16;
$query = "SELECT * FROM chat ORDER BY dateT DESC LIMIT ".$start." , ".$end." ";
$query1 = "SELECT id FROM chat ";
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
	<h1>Гостевая книга</h1>
	</header>
	<form id="formSabmit">
		<label for="">Имя пользователя</label><br />
		<input id="name" class="formInput" type="text" name="name" pattern="^[a-zA-Zа-яА-Я]+$" required><br />
		<label for="">E-mail</label><br />
		<input id="email" class="formInput" type="text" name="email" required><br />
		<label for="">Ключевые слова</label><br />
		<input id="tegs" class="formInput" type="text" name="tegs" pattern="^[a-zA-Zа-яА-Я]+$" required><br />
		<label for="">Ваш текст</label><br />
		<textarea name="message" id="textarea" pattern="^[a-zA-Zа-яА-Я]+$" required></textarea><br />
		<p> <img src="secpic.php" alt="защитный код"></p><br/>
		<input id="captcha" name="captcha" type="text"><br/><br/>
		<input id="date" name="date" type="text" hidden value="<?= date('Y.m.d H.i.s'); ?>">
		<input type="button" class="submit" value="Отправить">
		<a href="search.php"><input type="button" class="submit1" value="Поиск"></a>
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
  				echo '<a href="?page='.$st.'"><li class="stranica">'.$i.'</li></a>';
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
  						echo '<a href="?page='.$st.'"><li class="stranica">'.$i.'</li></a>';
  						}
  					}else if($_GET['page']>=6 && $_GET['page']<($count_str-4)){
  						if($schet==8){
  						echo '<li class="stranica">...</li>';
  						}else if($schet==2){
  						echo '<li class="stranica">...</li>';
  						$i= ($_GET['page']-3);
  						$st= ($_GET['page']-3);
  						}else if($schet==9){
  						echo '<a href="?page='.$count_str.'"><li class="stranica">'.$count_str.'</li></a>';
  						break;
  						}else{
  						echo '<a href="?page='.$st.'"><li class="stranica">'.$i.'</li></a>';
  						}
  					}else{
  						if($i==2){
  						echo '<li class="stranica">...</li>';
  						$i= ($count_str-7);
  						$st= ($count_str-7);
  						}else{
  						echo '<a href="?page='.$st.'"><li class="stranica">'.$i.'</li></a>';
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