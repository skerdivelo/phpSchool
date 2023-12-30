<?php
session_start();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esempio di login</title>
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
			flex-direction: column;	
        }

        h1 {
            color: #333;
            text-align: center;
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
			cursor: pointer;
        }

		input:disabled {
			cursor: not-allowed;
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
    <?php
    if (isset($_SESSION["id"])) {
        ?>
        <h1>Ciao <?php echo $_SESSION["nome"]; ?></h1>
        <p><a href="cambia_password.script.php">Cambia Password</a></p>
        <p><a href="logout.script.php">Clicca per il logout</a></p>
        <?php
        if (isset($_SESSION["passwordCambiate"]) && $_SESSION["passwordCambiate"] == true) {
            echo "<script>alert('Accedi Nuovamente')</script>";
            unset($_SESSION["passwordCambiate"]);
            header("Location: logout.script.php");
            exit();
        }
    } else {
        ?>
        <form id="loginForm" name="login" method="post" action="login.script.php">

            <label for="usr">Nome utente</label>
            <input type="text" placeholder="Inserisci username" name="usr" id="usr" required>

            <label for="pwd">Password</label>
            <input type="password" placeholder="Inserisci password" name="pwd" id="pwd" required>

            <input type="submit" name="submit" value="Login" id="loginBtn" disabled>
            <p>Non hai un account? <a href="signup.php">Registrati</a></p>
        </form>

        <script>
            document.getElementById('usr').addEventListener('input', updateLoginButton);
            document.getElementById('pwd').addEventListener('input', updateLoginButton);

            function updateLoginButton() {
                var usrValue = document.getElementById('usr').value;
                var pwdValue = document.getElementById('pwd').value;

                var loginBtn = document.getElementById('loginBtn');
                loginBtn.disabled = !(usrValue.trim() !== '' && pwdValue.trim() !== '');
            }
        </script>

        <?php
        //comunico anche l'eventuale tentativo errato di login
        if (isset($_SESSION["errore_login"]) && $_SESSION["errore_login"] == true) {
            echo "<p>Nome utente o password errati! Ritenta!</p>";
            unset($_SESSION["errore_login"]);
        }
    }
    ?>
</body>

</html>
