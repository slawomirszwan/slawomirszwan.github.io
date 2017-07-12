<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Komis samochodowy</title>
	<link rel="stylesheet" href="auto.css">
</head>
<body>

<section id="baner">
<h1>SAMOCHODY</h1>
</section>

<section id="lewy">
<h2>Wykaz samochodów</h2>
<?php
/*
$p = @mysqli_connect("localhost","root","Alibaba1!","komis");
if($p==false) {
	die( "nie polaczono");
}
$wynik = @mysqli_query($p,"SELECT `id`,`marka`,`model` FROM `samochody` ;");

//$liczba= mysqli_num_rows($wynik);
//var_dump($liczba);

echo "<table border=\"1\">";
while($wiersz=@mysqli_fetch_row($wynik)) {
//var_dump($wiersz);
	echo "<tr>";
	for($i=0; $i<count($wiersz);$i++) {
		echo "<td>".$wiersz[$i]."</td>";
	}
	echo "</tr>";
}
echo "</table>";

@mysqli_close($p);
*/
?>

<ul>
<?php
$p = @mysqli_connect("localhost","root","Alibaba1!","komis");
if($p==false) {
	die( "nie polaczono");
}
$wynik = @mysqli_query($p,"SELECT `id`,`marka`,`model` FROM `samochody` ;");

//$liczba= mysqli_num_rows($wynik);
//var_dump($liczba);


while($wiersz=@mysqli_fetch_row($wynik)) {
	echo "<li>";
	for($i=0; $i<count($wiersz);$i++) {
		echo $wiersz[$i]." ";
	}
	echo "</li>";
}

@mysqli_close($p);
?>
</ul>

<h2>Zamówienia</h2>
<ul> 
<?php
$p = @mysqli_connect("localhost","root","Alibaba1!","komis");

$wynik = @mysqli_query($p,"SELECT `Samochody_id`,`Klient` FROM `zamowienia`;");

while($row=@mysqli_fetch_row($wynik)){
	echo "<li>";
	for($i=0;$i<count($row);$i++){
		echo $row[$i] . " ";
	}
	
	echo "</li>";
}
@mysqli_close($p);
?>
</ul>

</section>


<section id="prawy">
<h2>Pełne dane: Fiat</h2>
<?php

$p = @mysqli_connect("localhost","root","Alibaba1!","komis");

$wynik = @mysqli_query($p,"SELECT * FROM `samochody` WHERE marka='Fiat' ;");

while($row=@mysqli_fetch_row($wynik)) {
	for($i=0;$i<count($row);$i++){
		echo $row[$i]."  ";
	}
	echo "<br>";
}
@mysqli_close($p);
?>
</section>


<section id="stopka">
<table>
<tr>
<td>
<a href="kwerendy.txt" alt="kwerendy">Kwerendy</a>
</td>
<td>
Autor: 00000000
</td>
<td>
<img src="auto.png" alt="komis samochodowy"
</td>
</tr>
</table>
</section>

</body>
</html>