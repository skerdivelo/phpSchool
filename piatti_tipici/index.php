<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .piatto {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php
require("config.php");
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
    exit();
}

$sql = "SELECT * FROM pietanza";

if (isset($_GET['regione'])) {
    $regione = $_GET['regione'];
    $sql .= " WHERE fkRegione = (SELECT id FROM regione WHERE nome = ?)";
} elseif (isset($_GET['ingrediente'])) {
    $ingrediente = $_GET['ingrediente'];
    $sql .= " WHERE id IN (SELECT fkPietanza FROM utilizza WHERE fkIngrediente = (SELECT id FROM ingrediente WHERE nome = ?))";
}

$stmt = $mydb->prepare($sql);

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

while ($row = $result->fetch_assoc())
{
    echo "<div class='piatto'>" . $row['nome'] . "</div>";
}
?>
</body>
</html>