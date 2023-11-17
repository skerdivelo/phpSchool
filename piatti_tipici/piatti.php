<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin-bottom: 1000px;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            background: url('pic.jpg');
        }

        .piatto {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: calc(33.33% - 20px);
            box-sizing: border-box;
        }

        .piatto:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transform: translateY(-3px);
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

if (isset($_GET['regione'])) {
    $regione = $_GET['regione'];
    $sql = "SELECT * FROM pietanza WHERE fkRegione = (SELECT id FROM regione WHERE nome = ?)";
    $stmt = $mydb->prepare($sql);
    $stmt->bind_param("s", $regione);
} elseif (isset($_GET['ingrediente'])) {
    $ingrediente = $_GET['ingrediente'];
    $sql = "SELECT * FROM pietanza WHERE id IN (SELECT fkPietanza FROM utilizza WHERE fkIngrediente = (SELECT id FROM ingrediente WHERE nome = ?))";
    $stmt = $mydb->prepare($sql);
    $stmt->bind_param("s", $ingrediente);
} else {
    $sql = "SELECT * FROM pietanza";
    $stmt = $mydb->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{
    echo "<div class='piatto'>" . $row['nome'] . "</div>";
}
?>
</body>
</html>