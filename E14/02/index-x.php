<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        Hello
    </title>

    <meta name="description"    content="Free Web tutorials">
    <meta name="keywords"       content="HTML,CSS,XML,JavaScript">
    <meta name="author"         content="John Doe">
    <meta name="viewport"       content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="naglowek">
        nagłówek
    </div>
    <div id="lewa">
        lewa
    </div>
    <div id="prawa">
<?php
    //phpinfo();

    //https://www.w3schools.com/php/php_mysql_connect.asp
    echo "<hr><p>MySQLi Object-Oriented</p>";

    //----------------------------------
    $servername = "localhost";
    $username = "root";
    $password = "beetroot";
    $database = "sakila";

    $sql = "SELECT * FROM aktor;";

    //===============================================
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully"  . "<br>";
    //--------------
//
//    if ($conn->query($sql) === TRUE) {
//        echo "successfully";
//    } else {
//        echo "Error : " . $conn->error;
//    }


//ustawianie transmisji kodowanie znaków
//$conn->query("SET NAMES utf8;");
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

$conn->set_charset("utf8");

$result = $conn->query($sql);

if($result===false) {
    die("Error: " . $conn->error);
}

//echo "<pre>";
//var_dump($result);
//echo "</pre>";

$num_rows = $result->num_rows;
echo "Row count: ".$num_rows."<br>";
if ($num_rows > 0) {
    echo "\n<table border='1'>\n<tr><td>id</td><td>Imię</td><td>Nazwisko</td></tr>\n";

    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td>" . $row["aktor_id"] . "</td>\n";
        echo "<td>" . $row["imie"] . "</td>\n";
        echo "<td>" . $row["nazwisko"] . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";
} else {
    echo "0 results";
}

    $conn->close();

?>
    </div>
    <div id="stopka">
        stopka
    </div>


<?php
////=================================================================================
//
//    echo "<hr>MySQLi Procedural<br>";
//    $conn = mysqli_connect($servername,$username,$password, $database);
//    // Check connection
//    if (!$conn) {
//        die("Connection failed: " . mysqli_connect_error());
//    }
//    echo "Connected successfully";
//    //---------
//
//    if (mysqli_query($conn,$sql) === TRUE) {
//        echo "successfully";
//    } else {
//        echo "Error : " . mysqli_error($conn);
//    }
//
//      mysqli_set_charset($conn,"utf8");
//
//
//    //---------------
//    $result = mysqli_query($conn,$sql);
//
//    if($result===false) {
//        die("Error: " . mysqli_error($conn));
//    }
//
//    $num_rows = mysqli_num_rows($result);
//    echo "Row count: ".$num_rows."<br>";
//    if ($num_rows > 0) {
//        echo "<table border='1'><tr><td>id</td><td>Imię</td><td>Nazwisko</td></tr>";
//
//        // output data of each row
//        while($row = mysqli_fetch_assoc($result)) {
//            echo "<tr>";
//            echo "<td>" . $row["aktor_id"] . "</td>";
//            echo "<td>" . $row["imie"] . "</td>";
//            echo "<td>" . $row["nazwisko"] . "</td>";
//            echo "</tr>";
//        }
//        echo "</table>";
//    }
//    else {
//        echo "brak wyników";
//    }
//
//    mysqli_close($conn);
////----------------------------------
//
?>
</body>
</html>
