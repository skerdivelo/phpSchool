<?php
if (isset($_POST["carne"]) || isset($_POST["cipolla"]) || isset($_POST["ketchup"]) || isset($_POST["cetriolini"]) || isset($_POST["patatine"])) {
    echo "Ordine effettuato con successo. Elementi selezionati: <br>";

    if (isset($_POST["carne"])) {
        echo "Carne <br>";
    }
    if (isset($_POST["cipolla"])) {
        echo "Cipolla <br>";
    }
    if (isset($_POST["ketchup"])) {
        echo "Ketchup <br>";
    }
    if (isset($_POST["insalata"])) {
        echo "Insalata <br>";
    }
    if (isset($_POST["cetriolini"])) {
        echo "Cetriolini <br>";
    }
    if (isset($_POST["patatine"])) {
        echo "Patatine <br>";
    }
} else {
    header("Location: index.php");
    exit;
}
?>
