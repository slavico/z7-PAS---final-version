<?php
session_start();
require_once '/LAB8/db_connection.php';

	//setcookie("Login", "");
	//echo $_COOKIE['Login'];
	
	
/*
$filename = 'http://102651.panda5.pl/LAB7/slawek/moj%20katalog/historia2.php';//wybieramy plik do ściągnięcia
header('Content-Type:application/force-download');//ustawiamy mu uniwersalny typ mime (można bawić się w nadawanie mu application/msword, image/gif, itd...
header('Content-Disposition: attachment; filename='.basename($filename).';');//tutaj podajemy nazwę pliku - domyślnie ustawiłem, aby plik nazywał się tak jak oryginał
header('Content-Length:'.@filesize($filename));//dodajemy wielkość pliku
@readfile($filename)or die('File not found.');//czytamy plik           
*/

?>

<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Chmura prywatna.</title>
	<meta charset="UTF-8">
	<script src="/LAB8/ckeditor/ckeditor.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<style>
	#container
	{
		width: 1000px;
		margin-left: auto;
		margin-right: auto;
	}
	#logo
	{
		background-color: grey;
		color: white;
		text-align: center;
		padding: 15px;
	}
	#nav
	{
		float: left;
		background-color: lightgray;
		width: 150px;
		min-height: 500px;
		padding: 10px;
	}
	#content
	{
		float: left;
		padding: 20px;
		width: 520px;
	}
	#ad
	{
		float: left;
		width: 250px;
		min-height: 500px;
		padding: 10px;
		background-color: lightgray;
	}
	#footer
	{
		clear: both;
		background-color: black;
		color: white;
		text-align: center;
		padding: 20px;
	}	
	</style>

</head>

<body>

	<div id="container">
	
		<div id="logo">

		</div>
		
		<div id="nav">
		<?php
         echo "<a href='historia_logowan.php'>Historia logowań.</a>";
		 echo "<br><br>";
		 echo "Kliknij na plik, aby go pobrać.";
		?>
			
		
			
		</div>
		
		<div id="content">
			
			<?
// echo $_COOKIE['Login'];
 ECHO "FOLDERY i PLIKI w KATALOGU  ".$_COOKIE['Login'];
 ECHO "<br><br>";
 

$path='../LAB7/'.$_COOKIE['Login'].'/';
$dir = array_diff(scandir($path), array('.', '..'));
foreach($dir as $x)
{
	$x1=rawurlencode($x);
	if(is_dir('../LAB7/'.$_COOKIE['Login'].'/'.$x))
	{
		 echo '<li><b><a href='.'../LAB7/'.$_COOKIE['Login'].'/'.$x1.' target=_blank>'.$x.'(folder)</a></b></li>';
		 $directory='../LAB7/'.$_COOKIE['Login'].'/'.$x;
		 $dir1=array_diff(scandir($directory), array('.', '..'));
		 echo "<ul>";
		 foreach($dir1 as $y)
		 {
			 $y1=rawurlencode($y);
			 $directory1=$directory.'/'.$y1;
			 if(is_dir($directory1))
			 {
			 echo '<li><b><a href="'.$directory1.'" target=_blank>'.$y.'(folder)</a></b></li>';
			 }
			 else
			 {
			 //echo '<li><a href="'.$directory1.'" target=_blank>'.$y.'(plik)</a></li>';
			 echo '<li><a href="'.$directory1.'" download>'.$y.'(plik)</a></li>'; //pobieranie po kliknieciu
			 }
		 }
		 echo "</ul>";
	}
	else
	{
		echo '<li><a href='.'../LAB7/'.$_COOKIE['Login'].'/'.$x1.' target=_blank>'.$x.'(plik)</a></li>';
	}
}
 
?>
</div>
				
<div id="ad">
		<br>
		<b>STWÓRZ NOWY KATALOG:</b>
		<br>
		<form method="POST">
		<br>
		Podaj nazwę:
		<input type="text"  name="nazwa" maxlength="20" size="20"><br>
		<input type="submit" value="Stwórz katalog." name="Check"/>
		</form>

	<?php
		$tmp=$_COOKIE['Login'];
		if(isset($_POST['Check']))
		{
		$folder = $_POST['nazwa'];
		mkdir ("../LAB7/$tmp/$folder", 0777); echo "<br><br>";
		echo "<b>Folder o nazwie: <i>$folder</i> został stworzony na serwerze!</b>";
		echo "<meta http-equiv='refresh' content='2'>";
		}
	?>
		<br>
		<b>PRZEŚLIJ PLIK NA SERWER:</b>
		<br><br>
		<form action="" method="POST" ENCTYPE="multipart/form-data">
		
		Wybierz plik do przesłania:
		<input type="file" name="plik"/> 
		<br><br>
		Możesz wybrać folder (jeśli nie wybierzesz, plik trafi do katalogu domyślnego):
		<br>
		<select name='directory'>
			<?php
			echo '<option selected="$path"></option>';
			$path=$_COOKIE['Login'];
			$dir = array_diff(scandir($path), array('.', '..'));
			foreach($dir as $folder)
			{
			if(is_dir($path.'/'.$folder))
			{
				echo '<option value="'.$folder.'" >'.$folder.'</option>';
			}}
			?>
		</select>
	    <br><br>
	    <input type="submit" value="Wyślij plik na serwer!" name="Send"/> 
		</form>
		
		
		
	<?php
		if(isset($_POST['Send']))
		{
		if (is_uploaded_file($_FILES['plik']['tmp_name'])) 
		{ 
		echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>'; 
		echo "Plik zapisany do folderu:  ".$_POST['directory'].".";
		move_uploaded_file($_FILES['plik']['tmp_name'], '../LAB7/'.$_COOKIE['Login'].'/'.$_POST['directory'].'/'.$_FILES['plik']['name']); 
		echo "<meta http-equiv='refresh' content='2'>";
		}
		else 
		{
		echo 'Błąd przy przesyłaniu danych!';
		} 
		}
	?>
</div>
	
		<div id="footer">
			Chmura. &copy; Wszelkie prawa zastrzeżone
			<a href='index.php'>Wyloguj się.</a><br>
		</div>
	
	</div>

</body>
</html>