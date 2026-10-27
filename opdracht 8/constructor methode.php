<?php
 #Opdracht 1
class Persoon {
    private $naam;
    private $leeftijd;

    public function __construct($naam, $leeftijd) {
        $this->naam= $naam;
        $this->leeftijd = $leeftijd;
    }

    public function toonInfo() {
        echo "Naam: " . $this->naam. "<br>";
        echo "Leeftijd: " . $this->leeftijd. "<br>";
    }
}

$p = new Persoon("Sanne", 25);
$p->toonInfo();




class Auto {
    private $merk;
    private $bouwjaar;

    public function __construct($merk, $bouwjaar) {
        $this->merk= $merk;
        $this->bouwjaar = $bouwjaar;
    }

    public function toonAuto() {
        echo "Merk: " . $this->merk . "<br>";
        echo "Bouwjaar: " . $this->bouwjaar . "<br>";
    }
}

$auto1 = new Auto("Tesla", 2028);
$auto1->toonAuto();








#Opdracht 2 en 

class Dier {
    public function geluid() {
        return "Onbekend geluid";
    }
}

class Hond extends Dier {
    public function geluid() {
        return "Blaff!";
    }
}

class Kat extends Dier {
    public function geluid() {
        return "Miauw!";
    }
}

$dieren = [new Hond(), new Kat(), new Dier()];

foreach ($dieren as $dier) {
    echo $dier->geluid() . "<br>";
}


class Vervoermiddel {
    public function geluid(){
        return "Onbekend geluid";
    }
}

class fiets extends Vervoermiddel {
    public function geluid() {
        return "tring tring!";
    }
}

class trein extends Vervoermiddel {
    public function geluid() {
        return "tjsoek tjsoek!";
    }
}

class vliegtuig extends Vervoermiddel {
    public function geluid() {
        return "Woosh!";
    }
}
//opdracht 3 
$vervoermiddelen = [new Fiets(), new Trein(), new Vliegtuig()];

foreach ($vervoermiddelen as $vervoermiddel) {
    echo $vervoermiddel->geluid() . "<br>";
}









#opdracht 4

abstract class Betaalmethode {
    abstract public function betaal($bedrag);
}

class Ideal extends Betaalmethode {
    public function betaal($bedrag) {
        echo "Betaal €$bedrag via iDEAL.<br>";
    }
}

class PayPal extends Betaalmethode {
    public function betaal($bedrag) {
        echo "Betaal €$bedrag via PayPal.<br>";
    }
}

class Creditcard extends Betaalmethode {
    public function betaal($bedrag) {
        echo "Betaal €$bedrag met Creditcard.<br>";
    }
}

$betalingen = [new Ideal(), new PayPal(), new Creditcard()];

foreach ($betalingen as $methode) {
    $methode->betaal(25);
}




class Converter {
    public static function kmNaarMiles($km) {
        return $km * 0.621371;
    }
}

echo Converter::kmNaarMiles(10);


?>