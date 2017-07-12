  <!doctype html>
 <html>
 <head>
	<meta charset="utf-8">
	<title>Nasze hobby</title>
	<link rel="stylesheet" href="hobby.css">
 </head>
 <body>
	<section id="baner">
		<h1>FORUM HOBBYSTYCZNE</h1>
	</section>
	
	<section id="lewy">
		<h3>FORMULARZ REJESTRACJI DO FORUM</h3>
<?php

//var_dump($_POST);

echo "Konto ".$_POST['nick']. " zostało zarejestrowane na forum hobbystycznym";


$p = @mysqli_connect("localhost","root","Alibaba1!","forum");

mysqli_set_charset($p,"utf8");


$q="INSERT INTO `uzytkownicy`
( `nick`, `zainteresowania`, `zawod`, `plec`) 
VALUES ('".$_POST['nick']."','".$_POST['hobby']."','".$_POST['zawod']."','".$_POST['plec']."');";


$wynik = @mysqli_query($p,$q);

$q = "INSERT INTO `konta`
( `login`, `haslo`) 
VALUES 
('".$_POST['login']."','".$_POST['haslo']."');";
$wynik = @mysqli_query($p,$q);

@mysqli_close($p);
?>
	</section>
	
	<section id="prawy">
		<h3>TEMATYKA FORUM</h3>
		<ul>
			<li>
				Hodowla zwierząt
				<ul>
					<li>psy</li>
					<li>koty</li>
				</ul>
			</li>
			<li>Muzyka</li>
			<li>Gry komputerowe</li>
		</ul>
	</section>
 </body>
 </html>