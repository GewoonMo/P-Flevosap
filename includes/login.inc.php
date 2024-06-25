<?php

if (isset($_POST["submit"])) {
    // POST DE WOORD UID PWD IN DATABASE
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    include "../config/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($email, $pwd);
    $login->loginUser();

    include "../classes/cart-contr.classes.php";

    $winkelwagen = new winkelwagen();
    $winkelwageninfo = $winkelwagen->getCart();

    // Word terug gestuurd naar voorkant pagina
    if (!empty($winkelwageninfo)) {
        header("Location: ../cartpage.php?login=success");
    } else {
        header("Location: ../index.php?login=success");
    }
    exit();
}
