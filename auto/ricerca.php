<link rel="stylesheet" href="ricerca.css">

<?php
require("config.php");  //file di config con i parametri di connessione
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();  //termina la pagina
}

//input field for search
echo "<form action='ricerca.php' method='get'>";
echo "<input type='text' name='search' placeholder='Cerca'>";
echo "<input type='submit' value='Cerca'>";
echo "</form>";

//search
if (isset($_GET["search"])) {
    $search = htmlspecialchars($_GET["search"]);
    $sql = "SELECT * FROM auto WHERE marca LIKE '%$search%' OR modello LIKE '%$search%' OR anno LIKE '%$search%' OR alimentazione LIKE '%$search%' OR cambio LIKE '%$search%' OR kw LIKE '%$search%' OR prezzo LIKE '%$search%'";
    $result = $mydb->query($sql);
    if ($result->num_rows > 0) {
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
        while ($row = $result->fetch_assoc()) {
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
        }
        echo "</table>";
    } else {
        echo "0 results for " .$search;
    }
}