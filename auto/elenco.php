<?php
    require("config.php");  //file di config con i parametri di connessione
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();  //termina la pagina
    }

    /*`id` int(11) NOT NULL,
    `marca` varchar(30) DEFAULT NULL,
    `modello` varchar(30) DEFAULT NULL,
    `allestimento` varchar(30) DEFAULT NULL,
    `anno` int(11) DEFAULT NULL,
    `chilometri` int(11) DEFAULT NULL,
    `alimentazione` varchar(10) DEFAULT NULL,
    `cambio` varchar(10) DEFAULT NULL,
    `kw` int(11) DEFAULT NULL,
    `prezzo` decimal(8,2) DEFAULT NULL */
    $sql = "SELECT * FROM auto";
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
        while($row = $result->fetch_assoc()) {
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
        echo "0 results";
    }
?>