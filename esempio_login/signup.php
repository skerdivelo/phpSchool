<?php
session_start();

if (isset($_SESSION["id"])) {
    ?>
    <html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <h1>Ciao <?php echo $_SESSION["nome"]; ?></h1>
        <p><a href="logout.script.php">Clicca per il logout</a></p>
    </body>
    </html>
    <?php
    exit();
}

?>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <form id="signup" name="signup" method="post" action="signup.script.php">
        <label for="usr">Nome utente</label>
        <input type="text" placeholder="Inserisci username" name="usr" required>

        <label for="pwd">Password</label>
        <input type="password" placeholder="Inserisci password" name="pwd" required>

        <input type="submit" name="submit" value="Registrati">
    </form>

    <form action="login.php">
        <button type="submit">Login</button>
    </form>

    <?php
    if (isset($_SESSION["errore_login"]) && $_SESSION["errore_login"] == true) {
        echo "<p>Nome utente o password errati! Ritenta!</p>";
        unset($_SESSION["errore_login"]);
    }
    ?>
</body>
</html>
