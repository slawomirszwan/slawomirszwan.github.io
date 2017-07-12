<?php

/*
  Przykład tworzenia klasy Produkt zawierającej nazwę i cenę
 */

//Klasa produkt
class Produkt {
    //dwie prywatne właściwości widoczne tylko wewnątrz klasy
    private $nazwa;
    private $cena;
    
    //metoda ustawiająca nazwę produktu
    public function setNazwa($nazwa) {
        //sprawdza czy przekazany parametr $nazwa jest napisem
        if (is_string($nazwa)) {
            //usuwa zastrzeżony znak ';'
            $nazwa = str_replace(';', '', $nazwa);            
            $this->nazwa = $nazwa;
            return true;
        } else {
            return false;
        }
    }
    
    //metoda zwracająca nazwę produktu
    public function getNazwa(){
        return $this->nazwa;
    }
    
    //metoda zwracająca cenę produktu
    public function getCena(){
        return $this->cena;
    }
    
    //metoda ustawiająca cenę
    public function setCena($cena) {
        //próba zamiany napisu $cena na liczbę rzeczywistą
        $cena = floatval($cena);
        //jeżeli przekazany parametr $cena jest liczbą
        if (is_numeric($cena)) {
            //ustawiamy właściwość $this->cena
            $this->cena = $cena;
        } else {
            // ustawiamy właściwość $this->cena
            $this->cena = 0;
        }
    }
    
    //tworzymy konstruktor - to ta metoda będzie wywoływana przy tworzeniu 
    //każdego obiektu new Produkt('Nazwa', 0.00);
    function __construct($nazwa, $cena) {
        //wywołujemy wcześniej utworzoną metodę setNazwa
        $this->setNazwa($nazwa);
        //wywołujemy wcześniej utworzoną metodę setCena
        $this->setCena($cena);
    }
    
    //metoda pobierająca opis produktu w formacie CSV:
    //nazwaProduktu;cenaProduktu
    public function getProdukt() {
        return $this->nazwa . ';' . $this->cena;
    }

    //metoda pobierająca opis produktu w formacie JSON:
    //{["nazwa" : "nazwaProduktu"],
    // ["cena" : cenaProduktu]}    
    public function getProduktJSON() {
        //tworzymy tymczasową tablicę asocjacyjną
        $tablica = array();
        //wypełniamy tablicę asocjacyjną nazwą produktu
        $tablica['nazwa'] = $this->nazwa;
        //i ceną produktu
        $tablica['cena'] = $this->cena;
        //tworzymy zmienną JSON
        return json_encode($tablica);
    }

}

$produkty = array();
/*
  $produkty['Bigos'] = new Produkt('Bigos', 10.50);
  $produkty['Golonka']  = new Produkt('Golonka', 12.30);
  $produkty['Schabowy']  = new Produkt('Schabowy', 9.50);
  $produkty['Mielone']  = new Produkt('Mielone', 7.50);
  $produkty['deVolay']  = new Produkt('deVolay', 11.50);
  $produkty['Karkowka']  = new Produkt('Karkówka', 12.30);
  $produkty['Ołówek']  = new Produkt('Ołówek', 1.10);
  $produkty['Drukarka']  = new Produkt('Drukarka', 450.00);
  $produkty['Telefon']  = new Produkt('Telefon', 879.99);

  zapiszTablice('produkty.txt', $produkty);
 */

//funkcja zapisująca dane z tablicy do pliku
function zapiszTablice($nazwaPliku, $produkty) {
    //otwieramy plik do zapisu (parametr "w")
    //od tej pory plik jest reprezentowany przez $uchwyt
    $uchwyt = fopen($nazwaPliku, 'w');
    //jeżeli otwarcie się powiodło $uchwyt!=null
    if ($uchwyt) {
        //z tabeli $produkty pobieramy jeden po drugim:
        //indeksy ($nazwaProduktu) i elemnty ($produkt)
        foreach ($produkty as $produkt) {
            //każdy element jest tablicą z ceną, czasem i dodatkami 
            //za pomocą funkcji implode tworzymy z tej tablicy
            //napis oddzielony średnikami: cena;czas;dodatki 
            $linijka = $produkt->getProdukt();
            //dodajemy znak nowej linii
            $linijka .= "\r\n";
            //zapisujemy linijke do pliku
            fputs($uchwyt, $linijka);
        }
        //zamykamy plik
        fclose($uchwyt);
    }
}

//funkcja odczytująca produkty z pliku i zwracająca tablicę produktów
function odczytajTablice($nazwaPliku) {
    //tworzymy pustą tablicę z produktami
    $produkty = array();
    //otwieram plik do odczytu (parametr "r")
    $uchwyt = fopen($nazwaPliku, 'r');
    //podczas gdy nie napotkano na koniec pliku (!feof)
    while (!feof($uchwyt)) {
        //ofczytuję jedną linijkę z pliku
        $linijka = fgets($uchwyt);
        //sprawdzam czy linijka nie jest pusta
        if (strlen(trim($linijka)) > 0) {
            //linijka ma postać: produkt;cena
            //tworzę z tej linijki dwuelementową tablicę:
            //produkt |cena
            $nazwaProduktuCena = explode(';', $linijka);
            //nazwa produktu jest pierwszym elementam
            $nazwaProduktu = $nazwaProduktuCena[0];
            //cena to drugi element
            $cenaProduktu = $nazwaProduktuCena[1];
            //dopisuję do tablicy produktów produkt o kluczu $nazwaProduktu
            //opisując go ceną produktu: $cenaProduktu
            $produkty[$nazwaProduktu] = new Produkt($nazwaProduktu, $cenaProduktu);
        }
    }
    //zamykam plik do odczytu
    fclose($uchwyt);
    //zwracam utworzoną tablicę produkty
    return $produkty;
}

//odczytuję tablicę $produkty z pliku:
$produkty = odczytajTablice('produkty.txt');

if (isset($_GET)) {
    //sprawdzamy czy do webserwisu zostało wysłane żądanie dopisz
    if (isset($_GET['dopisz'])) {
        //sprawdzamy czy została wysłana nazwa produktu oraz jego cena
        if (isset($_GET['produkt']) &&
                isset($_GET['cena'])
        ) {
            //jeżeli tak, to pobieramy wysłane wartości z $_GET
            $produktNazwa = $_GET['produkt'];
            $produktCena = $_GET['cena'];
            //tworzę nowy obiekt produkt 
            $produkt = new Produkt($produktNazwa, $produktCena);
            //dopisuję produkt do tabeli z produktami
            $produkty[$produktNazwa] = $produkt;

            //linijkę z opisem dodanengo produktu wysyłam jako informację 
            //zwrotną do strony: nazwaProduktu;cenaProduktu
            echo $produkt->getProdukt();
            //zapisuję całą tablicę z produktami, przy okazji
            //dojdzie też nowa pozycja
            zapiszTablice('produkty.txt', $produkty);
        } else {
            echo "Wypełnij poprawnie wszystkie pola";
        }
    } else
    //sprawdzam czy w $_GET znajduje się komórka o indeksie 'menu'
    //czy zostało wysłane żądanie o przesłanie listy menu
    if (isset($_GET['menu'])) {
        //ustawiamy listę menu na pustą
        $lista = '';
        do {
            //odczytuję klucze z tabeli $produkty 
            $klucz = key($produkty);
            //dopisuję nazwę produktu (z klucza)  do listy
            $lista .= '<option>' . $klucz . '</option>';
            //przesuwam kursor w tabeli $produkty do następnej wartości
        } while (next($produkty));
        //zwracam listę produktów w postaci tagów HTML
        echo $lista;
    } else
    //sprawdzam czy w $_GET znajduje się komórka o indeksie 'produkt'     
    if (isset($_GET['produkt'])) {
        //Nazwa produktu przekazana z formularza znajdzie się w tablicy $_GET
        $produktNazwa = $_GET['produkt'];
        //nazwy produktu używam jako indeksu tablicy        
        //zwracam informację o produkcie w formacie JASON
        //"{cena:$cena ,czas: $czas, dodatki: $dodatki}";
        $produkt = $produkty[$produktNazwa];
        echo $produkt->getProduktJSON();
    }
} else {
    echo "nic nie wybrano";
}
if (isset($_POST)) {
    //sprawdzam czy w $_GET znajduje się komórka o indeksie 'menu'
    //czy zostało wysłane żądanie o przesłanie listy menu
    if (isset($_POST['produkty'])) {
        $produktyLista = $_POST['produkty'];
        $produktyTablica = explode(",", $produktyLista);
        $cenaRazem = 0;
        foreach ($produktyTablica as $produktNazwa) {
            //zabezpieczamy się przed wysłaniem nieistniejącej potrawy
            if (isset($produkty[$produktNazwa])) {
                $produkt = $produkty[$produktNazwa];
                $cenaRazem += $produkt->getCena();
            }
        }
        echo "<p><span> Do zapłaty: " . $cenaRazem . " zł</span></p>";
    }
}