<?php

/*
 * Klasa przechowująca dane
 */
class Dane {
    protected $dane;

    /**
     * Dane constructor.
     */
    public function __construct()
    {
        $this->dane = array();
    }

    /**
     * @return array
     */
    public function getDane()
    {
        return $this->dane;
    }

    /**
     * @param array $dane
     */
    public function setDane($dane)
    {
        $this->dane = $dane;
    }

    /**
     * @param $key
     * @param $value
     *
     * dodajemy informację
     */
    public function addInfo($key, $value) {
        $this->dane[$key] = $value;
    }

    /**
     * pobieramy wybrana informację
     * @param $key
     * @return mixed
     */
    public function getInfo($key) {
        return $this->dane[$key];
    }

    /**
     * Sprawdzamy czy w danych istnieje informacja
     * @param $key
     * @return bool
     */
    public function infoExist($key) {
        return array_key_exists($key, $this->dane);
    }

}

class MagazynPlikowy {

    protected $nazwaPliku;

    /**
     * Magazyn constructor.
     */
    public function __construct($nazwaPliku) {
        $this->nazwaPliku = $nazwaPliku;
    }

    public function skladujDane($dane){


    }

    /*
     * odczytuje dane z magazynu danych
     */
    public function pobierzDane() {

        $dane = new Dane();


        $daneTekst = file_get_contents( $this->nazwaPliku );


        //otwieram plik do odczytu (parametr "r")
        $uchwyt = fopen($this->nazwaPliku,'r');

        //podczas gdy nie napotkano na koniec pliku (!feof)
        while(!feof($uchwyt)){
            //odczytuję jedną linijkę z pliku
            $linijka =fgets($uchwyt);

            //sprawdzam czy linijka nie jest pusta
            if (strlen(trim($linijka))>0){

                //linijka ma postać: potrawa;cena;czas;dodatki
                //tworzę z tej linijki czteroelementową tablicę:
                //potrawa;cena;czas;dodatki
                $potrawy[$nazwa]= $potrawa;
            }
        }
        //zamykam plik do odczytu
        fclose($uchwyt);
        //zwracam utworzoną tablicę potraw

        $dane = new Dane();

        return $potrawy;
    }


    /*
     * funkcja zapisująca dane z tablicy do pliku
     */
    private function zapiszTablice($dane){
        //otwieramy plik do zapisu (parametr "w")
        //od tej pory plik jest reprezentowany przez $uchwyt
        $uchwyt = fopen($this->nazwaPliku,'w');
        //jeżeli otwarcie się powiodło $uchwyt!=null
        if($uchwyt){
            //z tabeli $potrawy pobieramy jeden po drugim:
            //indeksy ($nazwaPotrawy) i elemnty ($potrawa)
            foreach($potrawy  as $potrawa){
                //za pomocą metody getProdukt() pbieramy opis potrawy w formacie CSV
                //napis oddzielony średnikami: nazwa;cena;czas;dodatki
                $linijka = $potrawa->getProdukt();
                //do linijki dodajemy jeszcze przejście do nowej linii
                $linijka .= "\r\n";
                //zapisujemy linijke do pliku
                fputs($uchwyt, $linijka);
            }
            //zamykamy plik
            fclose($uchwyt);
        }
    }

}


/*
  Przykład tworzenia klasy potomnej Potrawa do klasy 
 * Produkt, która dziedziczy po niej właściwości $nazwa, $cena 
 * i metody setNazwa, setCena, getNazwa, getCena.
 * Nadpisując metosy getProdukt i getJSON oraz konstruktor
 */

//Klasa produkt
class Produkt {
    //dwie prywatne właściwości widoczne tylko wewnątrz klasy
    protected $nazwa;
    protected $cena;
    
    //metoda ustawiająca nazwę roduktu
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

class Potrawa extends Produkt{
    //dwie nowe prywatne właściwości, będą widoczne tylko wewnątrz tej klasy
    //czas oczekiwania na potrawę
    private $czas;
    //dodatki do potrawy
    private $dodatki;
    
    public function getCzas() {
        return $this->czas;
    }

    public function getDodatki() {
        return $this->dodatki;
    }

    public function setCzas($czas) {
        $czas = intval($czas);
        //jeżeli przekazany parametr $cena jest liczbą
        if (is_int($czas)){ 
            $this->czas = $czas;
        }
        else{
            $this->czas = 0;
        }            
    }

    public function setDodatki($dodatki) {
     //sprawdza czy przekazany parametr $dodatki jest napisem
        if (is_string($dodatki)) {
            //usuwa zastrzeżony znak ';'
            $dodatki = str_replace(';', '', $dodatki);            
            $this->dodatki = $dodatki;            
        } else {
            $this->dodatki = "brak dodatków";
        }
    }
    //nadpisany konstruktor ojaca - to ta metoda będzie wywoływana przy tworzeniu 
    //każdego obiektu new Potrawa('Nazwa', 0.00, 10, 'Jakieś dodatki');    
    function __construct($nazwa, $cena, $czas, $dodatki) {
        //wywołujemy konstruktor ojca
        Produkt::__construct($nazwa, $cena);        
        //ustawiamy czas oczekiwania  wcześniej dodaną metodą
        $this->setCzas($czas);
        //ustawiamy dodatki potrawy wcześniej opisaną metodą
        $this->setDodatki($dodatki);
    }
    
    //nadpisana metoda ojca pobierająca opis potrawy w formacie CSV:
    //nazwaPotrawy;cenaPotrawy;czasOczekiwania;dodatkiPotrawy
    public function getProdukt() {
        return $this->nazwa . ';' . $this->cena . ';' . $this->czas . ';' . $this->dodatki;
    }

    //nadpisana metoda ojca pobierająca opis potrawy w formacie JSON:
    //{["nazwa" : "nazwaPotrawy"],
    // ["cena" : cenaPotrawy],
    // ["czas" : czasOczekiwania],
    // ["dodatki" : dodatkiPotrawy]}    
    public function getProduktJSON() {
        //tworzymy tymczasową tablicę asocjacyjną
        $tablica = array();
        //wypełniamy tablicę asocjacyjną nazwą potrawy,
        $tablica['nazwa'] = $this->nazwa;
        //ceną potrawy
        $tablica['cena'] = $this->cena;
        //czasem oczekiwania
        $tablica['czas'] = $this->czas;
        //dodatkami potrawy
        $tablica['dodatki'] = $this->dodatki;
        //tworzymy zmienną JSON
        return json_encode($tablica);
    }

}

$potrawy = array();
/*
$potrawy['Bigos'] = new Potrawa('Bigos', 10.50, 15, "ziemniaki, surówka");
$potrawy['Golonka'] = new Potrawa('Golonka', 12.30, 35, "ziemniaki w mundurkach, surówka");
$potrawy['Schabowy'] = new Potrawa('Schabowy', 9.50, 20, "frytki, ketchup");
$potrawy['Mielone'] = new Potrawa('Mielone', 7.50, 15, "ziemniaki, surówka");
$potrawy['deVolay'] = new Potrawa('deVolay', 11.50, 25, "frytki, ketchup, surówki");
$potrawy['Karkówka'] = new Potrawa('Karkówka', 12.00, 20, "ziemniaki w mundurkach, pomidorki");
zapiszTablice('potrawy.txt', $potrawy);
*/

//funkcja zapisująca dane z tablicy do pliku
function zapiszTablice($nazwaPliku, $potrawy){
    //otwieramy plik do zapisu (parametr "w")
    //od tej pory plik jest reprezentowany przez $uchwyt
    $uchwyt = fopen($nazwaPliku,'w');
    //jeżeli otwarcie się powiodło $uchwyt!=null
    if($uchwyt){
        //z tabeli $potrawy pobieramy jeden po drugim:
        //indeksy ($nazwaPotrawy) i elemnty ($potrawa)
        foreach($potrawy  as $potrawa){            
            //za pomocą metody getProdukt() pbieramy opis potrawy w formacie CSV
            //napis oddzielony średnikami: nazwa;cena;czas;dodatki             
            $linijka = $potrawa->getProdukt();            
            //do linijki dodajemy jeszcze przejście do nowej linii
            $linijka .= "\r\n";
            //zapisujemy linijke do pliku
            fputs($uchwyt, $linijka);            
        }
        //zamykamy plik
        fclose($uchwyt);
    }    
}

//funkcja odczytująca potrawy z pliku i zwracająca tablicę potraw
function odczytajTablice($nazwaPliku ){
    //tworzymy pustą tablicę z potrawami
    $potrawy = array();
    //otwieram plik do odczytu (parametr "r")
    $uchwyt = fopen($nazwaPliku,'r');
    //podczas gdy nie napotkano na koniec pliku (!feof)
    while(!feof($uchwyt)){
        //ofczytuję jedną linijkę z pliku
        $linijka =fgets($uchwyt);
        //sprawdzam czy linijka nie jest pusta
        if (strlen(trim($linijka))>0){        
            //linijka ma postać: potrawa;cena;czas;dodatki
            //tworzę z tej linijki czteroelementową tablicę:
            //potrawa;cena;czas;dodatki
            $potrawaTab = explode(';', $linijka);
            $nazwa = $potrawaTab[0];
            $cena = $potrawaTab[1];
            $czas = $potrawaTab[2];
            $dodatki = $potrawaTab[3];
            
            $potrawa = new Potrawa($nazwa, $cena, $czas, $dodatki);
            $potrawy[$nazwa]= $potrawa;            
        }           
    }
    //zamykam plik do odczytu
    fclose($uchwyt);  
    //zwracam utworzoną tablicę potraw
    return $potrawy;
}
//odczytuję tablicę $potrawy z pliku:
$potrawy = odczytajTablice('potrawy.txt');

if (isset($_GET)) {
    
    //sprawdzamy czy do webserwisu zostało wysłane żądanie dopisz
    if (isset($_GET['dopisz'])) {        
        //sprawdzamy czy została wysłana nazwa potrawy oraz jej opis
        //czyli: cena, czas, dodatki
        if (isset($_GET['potrawa']) &&
            isset($_GET['cena']) &&    
            isset($_GET['czas']) &&
            isset($_GET['dodatki']) 
        ){            
            //jeżeli tak, to pobieramy wysłane wartości z $_GET
            $potrawaNazwa = $_GET['potrawa'];
            $cena = $_GET['cena'];
            $czas = $_GET['czas'];
            $dodatki = $_GET['dodatki'];            
            
            //dopisuję potrawę do tabeli z potrawami
            $potrawa = new Potrawa($potrawaNazwa, $cena, $czas, $dodatki);
            $potrawy[$potrawaNazwa] = $potrawa;            
            //tworzę informację o dodanej potrawie w formacie CSV:
            $informacja = $potrawa->getProdukt();  
            //linijkę tę wysyłam jako informację zwrotną do strony
            echo $informacja;
            //zapisuję całą tablicę z potrawami, przy okazji
            //dojdzie też nowa pozycja
            zapiszTablice('potrawy.txt', $potrawy);                        
        }
        else{
            echo "Wypełnij poprawnie wszystkie pola";
        }
         
    } else
    //sprawdzam czy w $_GET znajduje się komórka o indeksie 'menu'
    //czy zostało wysłane żądanie o przesłanie listy menu
    if (isset($_GET['menu'])) {
        //ustawiamy listę menu na pustą
        $lista = '';        
         do{
            //odczytuję klucze z tabeli $potrawy
            $klucz = key($potrawy); 
            //dopisuję nazwę potrawy (z klucza)  do listy
            $lista .= '<option>' . $klucz . '</option>';
            //przesuwam kursor w tabeli $potrawy do następnej wartości
            
        }while (next($potrawy));
        //zwracam listę potraw w postaci tagów HTML
        echo $lista;
    } else
    //sprawdzam czy w $_GET znajduje się komórka o indeksie 'potrawa'     
    if (isset($_GET['potrawa'])) {
        //Nazwa potrawy przekazana z formularza znajdzie się w tablicy $_GET
        $potrawaNazwa = $_GET['potrawa'];        
        $potrawa = $potrawy[$potrawaNazwa];
        //nazwy potrawy używam jako indeksu tablicy        
        //zwracam informację o potrawie w formacie JASON
        //"{potrawa: $potrawa, cena:$cena ,czas: $czas, dodatki: $dodatki}";
         echo $potrawa->getProduktJSON();        
    } 
} else {
    echo "nic nie wybrano";
}
if (isset($_POST)) {
    //sprawdzam czy w $_GET znajduje się komórka o indeksie 'menu'
    //czy zostało wysłane żądanie o przesłanie listy menu
    if (isset($_POST['potrawy'])) {
        $potrawyLista = $_POST['potrawy'];
        $potrawyTablica = explode(",", $potrawyLista);
        $cenaRazem = 0;
        $czasOczekiwania = 0;
        foreach ($potrawyTablica as $potrawaNazwa){
            //zabezpieczamy się przed wysłaniem nieistniejącej potrawy
            if(isset($potrawy[$potrawaNazwa])){
                $potrawa = $potrawy[$potrawaNazwa];
                $cenaRazem += $potrawa->getCena();
                $czas = $potrawa->getCzas();
                //pobieramy maksymalny czas oczekiwania
                if($czas>$czasOczekiwania){
                    $czasOczekiwania=$czas;
                }            
            }    
        }
        echo "<p><span> Do zapłaty: ".$cenaRazem." zł</span>".
             "<span> Czas oczekiwania: ".$czasOczekiwania." minut</span></p>";        
    }
}