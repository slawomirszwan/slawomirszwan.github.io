<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Strona doskonała</title>

  <meta name="description" content="super strona"
  <meta name="keyword" content="ala,ola">
  <meta name="author" content="slawomir">
                                                 
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="naglowek">   
    Tytuł
  </div>
  
  <div id="lewa">
    <a href="text.txt">Link do pliku txt</a><br>
    <a href="strona2.html">Link do strony2</a>
  </div> 
  

  <div id="prawa"> 
<?php
  $serwer="localhost";
  $user="root";
  $password="beetroot";
  $database="sakila";
  
  $conn = new mysqli($serwer,$user,$password,$database);  
  //var_dump($conn);
  if ($conn->connect_error) {
    die("problem połączenia z bazą danych:" . $conn->connect_error);
  } 
  
  $conn->set_charset("utf8");
  
  $sql = "select * from aktor;";
  
  $result= $conn->query($sql);
  //var_dump($result);
  if ($result==false) {
    die("Błąd zapytania:".$conn->error);
  }              
  
  //var_dump($result);       
  $num_rows = $result->num_rows;
  if ($num_rows>0) {
    echo "<table>"; 
    echo "<tr><th>aktor_id</th><th>Imię</th><th>Nazwisko</th></tr>"; 
    while ( $row = $result->fetch_assoc()) {
      //var_dump($row);

      echo "<tr>";      
      echo "<td>".$row["aktor_id"]."</td>";           
      echo "<td>".$row["imie"]."</td>";           
      echo "<td>".$row["nazwisko"]."</td>";           
      echo "</tr>";
    
    }              
    echo "</table>";
      
  }
  else {
    echo "brak wyników";
  } 
  echo "<br>";
?>  
  </div>
  
  <div id="srodek">
  text
  </div>
  
  <div id="stopka"> 
  <br>
    Stopka &copy; 2017
  </div>

  <script>
  </script>
</body>
</html>