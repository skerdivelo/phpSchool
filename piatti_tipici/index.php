<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('pic.jpg') center/cover no-repeat; /* Replace 'your-background-image.jpg' with your image file */
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        select {
            margin-top: 23px;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #6c757d;
            background-color: #e9ecef;
            font-size: 16px;
            font-weight: bold;
            color: #495057;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        select:hover {
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
            transform: translateY(-2px);
        }

        .piatto {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            opacity: 0.9;
        }

        .piatto:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transform: translateY(-3px);
        }

        .piatto a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        #pText {
            font-weight: bold;
            margin-left: 20px;
            text-align: center;
            color: white;
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

$regioni = array(
    1 => 'Lombardia',
    2 => 'Veneto',
    3 => 'Puglia'
);

$ingredienti = array(
    1 => 'Pomodoro',
    2 => 'Melanzana',
    3 => 'Peperone',
    4 => 'Cipolla',
    5 => 'Olio'
);

echo "<form action='index.php' method='get'>";
echo "<select name='tipo' onchange='this.form.submit()'>";
echo "<option value=''>Seleziona...</option>";
echo "<option value='regione'>Regioni</option>";
echo "<option value='ingrediente'>Ingredienti</option>";
echo "</select>";
echo "</form>";

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];

    if ($tipo == 'regione') {
        foreach ($regioni as $id => $regione) {
            echo "<div class='piatto'><a href='piatti.php?regione=$regione'>$regione</a></div>";
        }
    } elseif ($tipo == 'ingrediente') {
        foreach ($ingredienti as $id => $ingrediente) {
            echo "<div class='piatto'><a href='piatti.php?ingrediente=$ingrediente'>$ingrediente</a></div>";
        }
    }
} else {
    echo "<p id='pText'>Nessuna selezione effettuata.</p>";
}
?>
</body>
</html>