<?php
    require("config.php");  //file di config con i parametri di connessione
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();  //termina la pagina
    }

    
?>