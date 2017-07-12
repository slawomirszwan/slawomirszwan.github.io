 <!doctype html>
 <html> 
 <head>
 <meta charset="utf-8">
 <title>Rzut oszczepem</title>
 <link rel="stylesheet" href="styl_oszczep.css">
 </head>
 <body>
 <header>
 <h1>Klub sportowy: rzut oszczepem</h1>
 </header>
 
 <main>
	<h1>Nasz rekord
<?php
//

$p = @mysqli_connect("localhost","root","beetroot","sportowcy");
@mysqli_set_charset($p,"utf8");

$w = mysqli_query($p," SELECT max(wynik )
FROM `wyniki` 
WHERE  dyscyplina_id=3;");
$r= mysqli_fetch_row($w);

echo $r[0];

?>
 m</h1>

<table border="1" >
<?php

$w = @mysqli_query($p," SELECT count(*) FROM `sportowiec` ;");
$r = @mysqli_fetch_row($w);

//var_dump($r);
$ile = $r[0];

//echo $ile;

$ile_row=2;

echo "<tr>";
//================================
for($i=1; $i<=$ile; $i++) {


echo "<td>";
$w = @mysqli_query($p,"SELECT imie,nazwisko FROM `sportowiec` Where id=".$i.";");

$r = @mysqli_fetch_row($w);

echo "<h3>".$r[0]." ".$r[1]."</h3>";

$w = @mysqli_query($p," SELECT avg(wynik )
FROM `wyniki` 
WHERE sportowiec_id=1 and dyscyplina_id=".$i.";");

$r = @mysqli_fetch_row($w);

echo "<p>sredni wynik ".$r[0]."</p>";

echo "</td>";



$x = ($i-1)%$ile_row ==$ile_row-1;
	if  ( $x){
		echo "</tr><tr>";
	}	

}
//================================
echo "</tr>";

@mysqli_close($p);

?>


<?php
/*
$p = @mysqli_connect("localhost","root","beetroot","sportowcy");
$r = @mysqli_query($p,"select imie,nazwisko FROM sportowiec");

while( $w=@mysqli_fetch_row($r)   ) {
  echo "<tr>";
  echo "<td>".$w[0]."</td>";
  echo "<td>".$w[1]."</td>";
  echo "</tr>";  
}
@mysqli_close();
*/ 
?>





</table>	
 </main>
 
 <div id="footer">
<p>Klub sportowy</p>
Stronę opracował: 000000
 </div>
 
 </body>
 </html>