<?php

if (isset($_POST["submit"])) {
    // POST DE WOORD UID PWD IN DATABASE
    $id = $_POST["id"];

    include "../partials/header.php";
    include "../config/dbh.classes.php";
    include "../classes/cart-contr.classes.php";

    $winkelwagen = new winkelwagen();
    $winkelwagen->addProductToCart($id);
    $cart = $winkelwagen->getCart();
    $savecart = $winkelwagen->saveCart($cart);


    // Word terug gestuurd naar voorkant pagina
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}
