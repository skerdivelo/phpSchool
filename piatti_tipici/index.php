<?php
require("config.php");  //file di config con i parametri di connessione
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
    exit();  //termina la pagina
}

// Preparazione della query SQL
$sql = "SELECT * FROM pietanza";

if (isset($_GET['regione'])) {
    $regione = $_GET['regione'];
    $sql .= " WHERE fkRegione = (SELECT id FROM regione WHERE nome = ?)";
} elseif (isset($_GET['ingrediente'])) {
    $ingrediente = $_GET['ingrediente'];
    $sql .= " WHERE id IN (SELECT fkPietanza FROM utilizza WHERE fkIngrediente = (SELECT id FROM ingrediente WHERE nome = ?))";
}

$stmt = $mydb->prepare($sql);

// Esecuzione della query SQL
if (isset($regione)) {
    $stmt->bind_param("s", $regione);
    $stmt->execute();
} elseif (isset($ingrediente)) {
    $stmt->bind_param("s", $ingrediente);
    $stmt->execute();
} else {
    $stmt->execute();
}

$result = $stmt->get_result();

// Stampa dei risultati
while ($row = $result->fetch_assoc())
{
    echo $row['nome'] . "<br>";
}
?>