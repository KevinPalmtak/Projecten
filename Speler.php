<?php
require_once 'Dice.php';

class Speler 
{
    private $dice;
    private $throwCount;
    private $history;
    private $result;
    public $play;
    public $drawDice;

public function __construct()
{
    // Maak een lege lijst voor de dobbelstenen.
    $this->dice = array();

    // Maak 5 dobbelsteenobjecten aan.
    for ($i = 0; $i < 5; $i++) {
        $this->dice[] = new Dice();
    }

    // Begin met 0 worpen.
    $this->throwCount = 0;

    // Begin met een lege worpgeschiedenis.
    $this->history = array();
}

public function drawDice($value)
{
    // Posities van de stippen per dobbelsteenwaarde.
    $dots = [
        1 => [[50, 50]],
        2 => [[25, 25], [75, 75]],
        3 => [[25, 25], [50, 50], [75, 75]],
        4 => [[25, 25], [75, 25], [25, 75], [75, 75]],
        5 => [[25, 25], [75, 25], [50, 50], [25, 75], [75, 75]],
        6 => [[25, 25], [75, 25], [25, 50], [75, 50], [25, 75], [75, 75]]
    ];

    // Begin met het tekenen van de dobbelsteen.
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">';

    // Teken het vierkant van de dobbelsteen.
    $svg .= '<rect x="5" y="5" width="90" height="90" rx="10" fill="white" stroke="black" stroke-width="3"/>';

    // Teken de stippen.
    foreach ($dots[$value] as $dot) {
        $svg .= '<circle cx="' . $dot[0] . '" cy="' . $dot[1] . '" r="6" fill="black"/>';
    }

    // Sluit de SVG af.
    $svg .= '</svg>';

    // Geef de getekende dobbelsteen terug.
    return $svg;
}

// Laat de speler de dobbelstenen gooien.
public function play()
{
    // Stop als er al 3 worpen zijn gedaan.
    if ($this->throwCount >= 3) {
        return;
    }

    // Bewaar de waarden van de vijf dobbelstenen.
    $result = array();

    // Gooi iedere dobbelsteen.
    foreach ($this->dice as $dice) {
        $dice->throwDice();

        // Voeg de waarde van deze dobbelsteen toe aan het resultaat.
        $result[] = $dice->getFaceValue();
    }

    // Bewaar het resultaat van deze worp in de geschiedenis.
    $this->history[] = $result;

    // Verhoog het aantal uitgevoerde worpen met één.
    $this->throwCount++;
}


    public function getThrowCount()
    {
        return $this->throwCount;
    }

    public function getHistory() 
    { 
        return $this->history;
    }

    public function isFinished()
    {
        return $this->throwCount >= 3;
    }

    public function reset()
    {
        $this->throwCount = 0;
        $this->hisotry = array();
    }
    

     public function genereerSvgVoorWorp($waarde)
    {
        $svg = "<svg width='60' height='60'
            viewBox='0 0 100 100'
            xmlns='http://www.w3.org/2000/svg'
            style='margin:5px;border:1px solid black'>";

        $svg .= "<rect width='100' height='100' fill='white'/>";

        $ogenPosities = array(
            1 => array(array(50, 50)),
            2 => array(array(30, 30), array(70, 70)),
            3 => array(array(30, 30), array(50, 50), array(70, 70)),
            4 => array(
                array(30, 30), array(30, 70),
                array(70, 30), array(70, 70)
            ),
            5 => array(
                array(30, 30), array(30, 70),
                array(50, 50), array(70, 30), array(70, 70)
            ),
            6 => array(
                array(30, 30), array(30, 50), array(30, 70),
                array(70, 30), array(70, 50), array(70, 70)
            )
        );

        foreach ($ogenPosities[$waarde] as $positie) {
            $svg .= "<circle cx='{$positie[0]}'
                cy='{$positie[1]}'
                r='8' fill='black'/>";
        }

        $svg .= "</svg>";

        return $svg;
    }
}