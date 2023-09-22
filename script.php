<?php
    if(isset($_POST["carne"]) || isset($_POST["cipolla"]) || isset($_POST["ketchup"]) || isset($_POST["cetriolini"]) || isset($_POST["patatine"])){
        echo "Ordine effetuato con successo";
    }else{
        header("Location: index.php");
        exit;
    }
?>