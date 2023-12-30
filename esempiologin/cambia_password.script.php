<?php
session_start();

if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit();
}

require("config.php"); //parametri di connessione
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
    exit();
}

if(isset($_POST["vecchia"]) && isset($_POST["nuova"]) && isset($_POST["conferma"])){
    $vecchia = $_POST["vecchia"];
    $nuova = $_POST["nuova"];
    $conferma = $_POST["conferma"];

    // Verifica se la nuova password corrisponde alla password di conferma
    if($nuova != $conferma){
        echo "Le password non corrispondono";
        exit();
    }

    // Recupera la password corrente dell'utente dal database
    $query = "SELECT hash FROM utenti WHERE id = ?";
    $stmt = $mydb->prepare($query);
    $stmt->bind_param("s", $_SESSION["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifica se la vecchia password corrisponde a quella nel database
    if(!password_verify($vecchia, $user["hash"])){
        echo "La vecchia password non è corretta";
        exit();
    }

    // Aggiorna la password dell'utente nel database
    $nuova = password_hash($nuova, PASSWORD_DEFAULT);
    $query = "UPDATE utenti SET hash = ? WHERE id = ?";
    $stmt = $mydb->prepare($query);
    $stmt->bind_param("ss", $nuova, $_SESSION["id"]);
    $stmt->execute();

    echo "Password aggiornata con successo";
    $passwordCambiate = true;
    $_SESSION["passwordCambiate"] = $passwordCambiate;
    header("Refresh: 2; URL=login.php"); // Redirect dopo 2 secondi
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambia Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="cambia_password.script.php" method="post">
        <input type="text" name="vecchia" placeholder="Inserisci Vecchia Password">
        <br>
        <input type="text" name="nuova" placeholder="Inserisci Nuova Password">
        <br>
        <input type="text" name="conferma" placeholder="Conferma Nuova Password">
        <br>
        <button type="submit">Cambia</button>
    </form>
</body>
</html>