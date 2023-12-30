<?php
session_start();
$_SESSION["errore_login"] = true; 

if (isset($_POST["submit"])) {
    require("config.php"); 
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);

    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
        exit();
    }
    
    $checkUserStmt = $mydb->prepare("SELECT id FROM utenti WHERE nome = (?)");
    $user = htmlspecialchars($_POST["usr"]);
    $checkUserStmt->bind_param("s", $user);
    $checkUserStmt->execute();
    $checkUserStmt->store_result();

    if ($checkUserStmt->num_rows > 0) {
        
        echo "User already exists!";
        exit();
    }

    $hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    $insertStmt = $mydb->prepare("INSERT INTO utenti (nome, hash) VALUES (?, ?)");
    $insertStmt->bind_param("ss", $user, $hash);
    $insertStmt->execute();
    $insertStmt->close();


    $userId = $mydb->insert_id;
    $_SESSION["nome"] = $user;
    $_SESSION["id"] = $userId;
    unset($_SESSION["errore_login"]);

    $mydb->close();
}

header("Location: login.php");
exit();
?>
