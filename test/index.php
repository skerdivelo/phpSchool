<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="script.php" method="post" enctype="multipart/form-data">
        <ul>
            <h2>Modifica il tuo Hamburger</h2>
            <p>
                Carne
                <input type="checkbox" name="carne" id="carne" checked>
            </p>
            <p>
                Cipolla
                <input type="checkbox" name="cipolla" id="cipolla" checked>
            </p>
            <p>
                Ketchup
                <input type="checkbox" name="ketchup" id="ketchup" checked>
            </p>
            <p>
                Insalata
                <input type="checkbox" name="insalata" id="insalata" checked>
            </p>
            <p>
                Cetriolini
                <input type="checkbox" name="cetriolini" id="cetriolini" checked>
            </p>
            <p>
                Patatine
                <input type="checkbox" name="patatine" id="patatine" checked>
            </p>
            </ul>
            <input type="submit" value="Conferma">
        </form>
</body>
</html>