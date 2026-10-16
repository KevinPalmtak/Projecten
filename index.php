
<?php
// Laad de klasse Speler in.
require_once 'Speler.php';

// Start de sessie.
session_start();

// Controleer of er al een Speler-object bestaat.
if (!isset($_SESSION['speler']) || !($_SESSION['speler'] instanceof Speler)) {
    // Maak een nieuwe speler aan als er nog geen bestaat.
    $_SESSION['speler'] = new speler();
}

// Haal het huidige spel op.
$speler = $_SESSION['speler'];

// Controleer of de speler op de gooi-knop heeft geklikt.
if (isset($_POST['roll'])) {
    // Voer een worp uit.
    $speler->play();

    // Bewaar de speler in de sessie.
    $_SESSION['speler'] = $speler;
}

// Controleer of de speler een nieuw spel wil starten.
if (isset($_POST['reset'])) {
    // Maak een nieuwe speler aan.
    $speler = new Speler();

    // Bewaar de nieuwe speler in de sessie.
    $_SESSION['speler'] = $speler;
}

// Haal de worpgeschiedenis op.
$history = $speler->getHistory();

// Haal het aantal uitgevoerde worpen op.
$throwCount = $speler->getThrowCount();

// Controleer of er nog gegooid mag worden.
$canThrow = $throwCount < 3;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <!-- Stel de tekencodering in. -->
    <meta charset="UTF-8">

    <!-- Zorg dat de pagina goed werkt op mobiele schermen. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titel van de webpagina. -->
    <title>Dobbelspel</title>

    <style>
        /* Stel het lettertype en de breedte van de pagina in. */
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 30px auto;
            padding: 0 16px;
        }

        /* Geef iedere worp wat ruimte. */
        .worp {
            margin: 20px 0;
            padding-bottom: 12px;
            border-bottom: 1px solid #cccccc;
        }

        /* Zet de dobbelstenen naast elkaar. */
        .dobbelstenen {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        /* Stel de grootte van de dobbelstenen in. */
        .dobbelstenen svg {
            width: 70px;
            height: 70px;
        }

        /* Maak de knoppen duidelijk klikbaar. */
        button {
            padding: 8px 12px;
            margin-right: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Titel van het dobbelspel. -->
    <h1>Dobbelspel</h1>

    <!-- Toon hoeveel worpen al zijn gebruikt. -->
    <p>
        Worpen gebruikt:
        <?= htmlspecialchars((string) $throwCount, ENT_QUOTES, 'UTF-8') ?>
        van 3
    </p>

    <!-- Formulier met de knoppen van het spel. -->
    <form method="post">

        <!-- Gooi de dobbelstenen. De knop wordt uitgeschakeld na 3 worpen. -->
        <button type="submit" name="roll" value="1"
            <?= $canThrow ? '' : 'disabled' ?>>
            Gooi de dobbelstenen
        </button>

        <!-- Start een nieuw spel. -->
        <button type="submit" name="reset" value="1">
            Nieuw spel
        </button>
    </form>

    <?php if (!$canThrow): ?>
        <!-- Toon een melding als alle worpen zijn gebruikt. -->
        <p>Je hebt alle 3 worpen gebruikt. Klik op 'Nieuw spel' om opnieuw te beginnen.</p>
    <?php endif; ?>

    <!-- Kop voor de worpgeschiedenis. -->
    <h2>Worpgeschiedenis</h2>

    <?php if (empty($history)): ?>
        <!-- Toon dit bericht als er nog niet gegooid is. -->
        <p>Je hebt nog niet gegooid. Klik op de knop hierboven om te beginnen.</p>
    <?php else: ?>

        <!-- Loop door alle worpen in de geschiedenis. -->
        <?php foreach ($history as $index => $values): ?>
            <section class="worp">

                <!-- Toon het nummer van de worp. -->
                <h3>
                    Worp
                    <?= htmlspecialchars((string) ($index + 1), ENT_QUOTES, 'UTF-8') ?>
                </h3>

                <!-- Toon de vijf dobbelstenen. -->
                <div class="dobbelstenen">
                    <?php foreach ($values as $value): ?>

                        <!-- Teken een dobbelsteen met de juiste waarde. -->
                        <?= $speler->drawDice((int) $value) ?>

                    <?php endforeach; ?>
                </div>

                <!-- Toon de gegooide getallen als tekst. -->
                <p>
                    Gegooid:
                    <?= htmlspecialchars(implode(', ', $values), ENT_QUOTES, 'UTF-8') ?>
                </p>
            </section>
        <?php endforeach; ?>

    <?php endif; ?>
</body>
</html>
