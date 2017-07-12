<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wynajmujemy samochody</title>
	<link rel="stylesheet" href="styl.css">
</head>
<body>

<section id="baner">
	<h1>Wynajem Samochodów</h1>
</section>

<section id="lewy">
	<h2>DZIŚ POLECAMY TOYOTĘ ROCZNIK 2014</h2>
<?php
//skrypt1
$p = @mysqli_connect("localhost","root","Alibaba1!","wynajem");
$wynik = @mysqli_query($p,"SELECT `id`,`model`,`kolor` FROM `samochody` WHERE `marka`='Toyota' and `rocznik`=2014 ;");
while($row=@mysqli_fetch_row($wynik)) {
//	for($i=0;$i<count($row);$i++){
//		echo $row[$i]. " ";
//	}
	echo $row[0] . " Toyota ". $row[1] .". Kolor: ".$row[2];
	echo "<br>";
}
@mysqli_close($p);
?>	

<h2>WSZYSTKIE DOSTĘPNE SAMOCHODY</h2>
<?php
//skrypt2
$p = @mysqli_connect("localhost","root","Alibaba1!","wynajem");
$wynik = @mysqli_query($p,"SELECT `id`,`marka`,`model` FROM `samochody`;");
while($row=@mysqli_fetch_row($wynik)) {
	for($i=0;$i<count($row);$i++){
		echo $row[$i]. " ";
	}
	echo "<br>";
}
@mysqli_close($p);
?>	

</section>


<section id="srodek">
	<h2>ZAMÓWIONE AUTA Z NUMERAMI TELEFONÓW KLIENTÓW</h2>
<?php
//skrypt3
$p = @mysqli_connect("localhost","root","Alibaba1!","wynajem");
$wynik = @mysqli_query($p,"select samochody.id, samochody.model, zamowienia.telefon from samochody inner join zamowienia on zamowienia.samochody_id=samochody.id ;");
while($row=@mysqli_fetch_row($wynik)) {
	for($i=0;$i<count($row);$i++){
		echo $row[$i]. " ";
	}
	echo "<br>";
}
@mysqli_close($p);
?>	

</section>

<section id="prawy">
<h2>NASZA OFERTA</h2>
<ul>
<li>Fiat</li>
<li>Toyota</li>
<li>Opel</li>
<li>Mercedes</li>
</ul>
<p>Tu pobierzesz naszą <a href="komis.sql">bazę danych</a></p>
<p>autor strony: 0000000</p>
</section>





</body>
</html>