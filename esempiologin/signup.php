<?php
session_start();

if (isset($_SESSION["id"])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
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

            h1 {
                color: #333;
                text-align: center;
            }

            p {
                text-align: center;
            }

            a {
                color: #0066cc;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
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

        p {
            color: #333;
            text-align: center;
        }

        a {
            color: #0066cc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form id="signup" name="signup" method="post" action="signup.script.php">
        <label for="usr">Nome utente</label>
        <input type="text" placeholder="Inserisci username" name="usr" required>

        <label for="pwd">Password</label>
        <input type="password" placeholder="Inserisci password" name="pwd" required>

        <input type="submit" name="submit" value="Registrati">
        <p>Sei già registrato? <a href="login.php">Effettua il login</a></p>
    </form>

    <?php
    if (isset($_SESSION["errore_login"]) && $_SESSION["errore_login"] == true) {
        echo "<p>Nome utente o password errati! Ritenta!</p>";
        unset($_SESSION["errore_login"]);
    }
    ?>
</body>

</html>
