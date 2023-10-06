<?php
session_start();

// Funzione per calcolare il valore di una mano di carte
function calcolaValoreMano($mano) {
    $valore = 0;
    $carteSetteMezzo = ['1', '2', '3', '4', '5', '6', '7', 'fante', 'cavallo', 're'];

    foreach ($mano as $carta) {
        $cartaValore = explode('_', $carta)[0]; // Estrarre il valore dalla stringa della carta
        if (in_array($cartaValore, $carteSetteMezzo)) {
            if ($cartaValore == 'fante' || $cartaValore == 'cavallo' || $cartaValore == 're') {
                $valore += 0.5;
            } else {
                $valore += floatval($cartaValore);
            }
        }
    }

    return $valore;
}

if (!isset($_SESSION['mano'])) {
    $_SESSION['mano'] = [];
}

if (!isset($_SESSION['punteggio'])) {
    $_SESSION['punteggio'] = 0;
}

if (isset($_POST['nuova_carta'])) {
    $carteSetteMezzo = ['1', '2', '3', '4', '5', '6', '7', 'fante', 'cavallo', 're'];
    $mazzo = [];
    foreach ($carteSetteMezzo as $carta) {
        $mazzo[] = $carta . '_di_denari';
        $mazzo[] = $carta . '_di_spade';
        $mazzo[] = $carta . '_di_coppe';
        $mazzo[] = $carta . '_di_bastoni';
    }

    shuffle($mazzo);

    $cartaPescata = array_shift($mazzo);
    $_SESSION['mano'][] = $cartaPescata;
    $_SESSION['punteggio'] = calcolaValoreMano($_SESSION['mano']);
    $points = $_SESSION['punteggio'];
    if($_SESSION['punteggio'] == 7.5){
        echo "Hai vinto! Il tuo punteggio è " . $_SESSION['punteggio'];
        session_unset();
        session_destroy();
    }else if ($_SESSION['punteggio'] > 7.5) {
        echo "Hai perso! Il tuo punteggio è " . $_SESSION['punteggio'];
        session_unset();
        session_destroy();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sette e Mezzo</title>
</head>
<body>
    <h1>Sette e Mezzo</h1>
    <p>Il tuo punteggio: <?php echo $points; ?></p>
    
    <form method="post">
        <input type="submit" name="nuova_carta" value="Pesca una nuova carta">
    </form>
</body>
</html>
