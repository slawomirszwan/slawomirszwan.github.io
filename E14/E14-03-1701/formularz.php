  <!doctype html>
 <html>
 <head>
	<meta charset="utf-8">
	<title>Sklep muzyczny</title>
	<link rel="stylesheet" href="muzyka.css">
 </head>
 <body>
 
	<section id="baner">
		<h1>SKLEP MUZYCZNY</h1>
	</section>

	<section id="lewy">
		<h2>NASZA OFERTA</h2>
		<ol>
			<li>Instrumenty muzyczne</li>
			<li>Sprzęt audio</li>
			<li>Płyty CD</li>
		</ol>
	</section>

	<section id="prawy">
<?php
//działanie skryptu
//var_dump($_POST);
//["imie"]=> string(0) "" ["nazwisko"]=> string(0) "" ["adres"]=> string(0) "" ["telefon"]=> string(0) "" ["login"]=> string(0) "" ["haslo"]=> string(0) 

echo "Konto ". $_POST['imie'] . " ". $_POST['nazwisko'] . " zostało zarejestrowane w sklepie muzycznym";

$p = @mysqli_connect("localhost","root","Alibaba1!","sklep");

@mysqli_set_charset($p,"utf8");

$q = "INSERT INTO `uzytkownicy`
(`imie`, `nazwisko`, `adres`, `telefon`) 
VALUES 
('".$_POST['imie']."','".$_POST['nazwisko']."','".$_POST['adres']."','".$_POST['telefon']."');";

//echo $q;
$wynik = @mysqli_query($p,$q);

$q = "INSERT INTO `konta`
(`login`, `haslo`) VALUES 
('".$_POST['login']."','".$_POST['haslo']."');";

//echo $q;
$wynik = @mysqli_query($p,$q);

@mysqli_close();
?>	
	</section>

	
 </body>
 </html>