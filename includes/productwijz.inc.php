<?php

include "../classes/adminpanel-contr.classes.php";

if (isset($_POST["submit"])) {
    // POST DE WOORD UID PWD IN DATABASE   
    $productId =  $_POST["id"];
    $productname = $_POST["productname"];
    $productdesc = $_POST["productdesc"];
    $price = $_POST["price"];
    $btw = $_POST["btw"];
    $voorraad = $_POST["voorraad"];

    $gegevenswijzigen = new Adminpanel();
    $gegevenswijzigen->changeProductdata($productId, $productname, $productdesc, $price, $btw, $voorraad);

    // Word terug gestuurd naar voorkant pagina
    header("Location: ../adminproducts.php?changed=success");
    exit();
}

$gegevenswijzigen = new Adminpanel();
$productid = $_GET["id"];
$gegevenswijzigen->deleteProductAdmin($productid);
header("Location: ../adminproducts.php?changed=success");
exit();
