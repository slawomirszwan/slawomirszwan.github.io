<?php
  ini_set( 'display_errors', 'On' ); 
  error_reporting( E_ALL );
?>

<?php
  print_r($_POST); // wyswietlanie ksiazki telefonicznej

  // nawiazanie polaczenia
  mysql_connect ("mypl", "d", "") or die ("<b>Nie można połączyć się z bazą danych!</b>");
  
  //wybór bazy danych
  mysql_select_db ("db") or die ("<b>Nie można się połączyć z bazą <i>db</i></b>");

  //=======================================  
  //dodawanie wpisów
  if ($_POST['action'] =='add') {
    $imie_f=$_POST['imie'];
    $nazw_f=$_POST['nazwisko'];
    $tele_f=$_POST['telefon'];
    if ( $imie_f && $nazw_f && $tele_f ) {
      $query="INSERT INTO ksiazka (imie,nazwisko,telefon) VALUES ('$imie_f', '$nazw_f', '$tele_f')";
      $wynik=mysql_query($query) or die(mysql_error());
      
      if ($wynik) {
        print ("<b>Dane zostały poprawnie dodane do bazy!</b>");
      }
      else {
        print ("Nie udało się dodać danych do bazy!");
      }
    }
    else {
      print ("<b>Proszę wypełnić wszystkie pola formularza.</b>");
    }
  } 

  //=======================================  
  //Edycja wpisów
  if ($_POST['action'] =='popraw') {
    $imie_f=$_POST['imie'];
    $nazw_f=$_POST['nazwisko'];
    $tele_f=$_POST['telefon'];
    $nr_f=$_POST['id'];
    
    if ( $imie_f && $nazw_f && $tele_f ) {
      $query = "UPDATE ksiazka SET imie='$imie_f', nazwisko='$nazw_f', telefon='$tele_f' WHERE nr='$nr_f';";
      $wynik = mysql_query($query);
      
      if($wynik) {
        print("<b>Dane zaktualizowano poprawnie!</b>");
      }
      else {
        print("<b>Niestety nie udało się zaktualizować danych!</b>");
      }
    }
  }
  elseif ($_GET['action'] =='edytuj') {
    $query = "SELECT * FROM ksiazka WHERE nr='".$_GET['id']."';";
    $wynik = mysql_query($query);
    $rekrod = mysql_fetch_assoc($wynik);
    $nr = $rekord['nr'];
    $imie = $rekord['imie'];
    $nazwisko = $rekord['nazwisko'];
    $telefon = $rekord['telefon']; 
    print '<FORM METHOD="POST">Edycja danych:
    <INPYT TYPE="hidden" NAME="action" VALUE="popraw">
    <INPUT TYPE="hidden" NAME="id" VALUE="'.$nr.'">
    <TABLE>
    <TR><TD>Imie:</TD><TD><INPUT TYPE="text" NAME="imie" VALUE="'.$imie.'"></TD></TR>
    <TR><TD>Nazwisko:</TD><TD><INPUT TYPE="text" NAME="nazwisko" VALUE="'.$nazwisko.'"></TD></TR>
    <TR><TD>Telefon:</TD><TD><INPUT TYPE="text" NAME="telefon" VALUE="'.$telefon.'"></TD></TR>
    </TABLE>
    <INPUT TYPE="submit" VALUE="Popraw"></FORM>';   
  }

  //==========================================
  // usuwanie wpisów
  if ($_GET['action'] =='skasuj') {
    $wynik = mysql_query ("DELETE FROM ksiazka WHERE nr='".$_GET['id']."';");
  } 
  
  //=========================================
  //pytanie do bazy 
  $wynik = mysql_query ("SELECT * FROM ksiazka;") or die ("<b>Wystąpił błąd</b>");
  print ("<TABLE CELLPADDING=5 BORDER=1>");
  print ("<TR><TD><b>Imię</b></TD><TD><b>Nazwisko</b></TD>");
  print ("<TD><b>Telefon</b></TD><TD><b>Akcja</b></TD></TR>");

  //odczyt danych z bazy i wyswietlenie ich
  while ($rekord = mysql_fetch_assoc($wynik))
  {
    $nr = $rekord['nr'];
    $imie = $rekord['imie'];
    $nazwisko = $rekord['nazwisko'];
    $telefon = $rekord['telefon'];
    print ("<TR><TD>$imie</TD><TD>$nazwisko</TD>");
    print ("<TD>$telefon</TD>");
    print ("<TD><a href=\"1.php?action=skasuj&id=$nr\" TITLE=\"Skasuj wpis!\">usuń</a>");
    print ("</TD></TR>");
  }
  print ("</TABLE");
  print '<FORM METHOD="POST">Dodaj:
  <INPUT TYPE="hidden" NAME="action" VALUE="add">
  <TABLE>
  <TR><TD>Imię:</TD><TD><INPUT TYPE="text" NAME="imie"></TD></TR>
  <TR><TD>Nazwisko:</TD><TD><INPUT TYPE="text" NAME="nazwisko"></TD></TR>
  <TR><TD>Telefon:</TD><TD><INPUT TYPE="text" NAME="telefon"></TD></TR>
  </TABLE>
  <INPUT TYPE="submit" VALUE="dodaj">
  </FORM>';
?>