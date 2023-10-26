<?php
require("config.php");  //file di config con i parametri di connessione
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();  //termina la pagina
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM auto WHERE id = $id";
    $result = $mydb->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<table>";
        echo "<tr>";
        echo "<th>Marca</th>";
        echo "<th>Modello</th>";
        echo "<th>Allestimento</th>";
        echo "<th>Anno</th>";
        echo "<th>Chilometri</th>";
        echo "<th>Alimentazione</th>";
        echo "<th>Cambio</th>";
        echo "<th>KW</th>";
        echo "<th>Prezzo</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $row["marca"] . "</td>";
        echo "<td>" . $row["modello"] . "</td>";
        echo "<td>" . $row["allestimento"] . "</td>";
        echo "<td>" . $row["anno"] . "</td>";
        echo "<td>" . $row["chilometri"] . "</td>";
        echo "<td>" . $row["alimentazione"] . "</td>";
        echo "<td>" . $row["cambio"] . "</td>";
        echo "<td>" . $row["kw"] . "</td>";
        echo "<td>" . $row["prezzo"] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "0 results";
    }
}

$mydb->close();
?>