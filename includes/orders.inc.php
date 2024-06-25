<?php


include "../config/dbh.classes.php";
include "../classes/orders.classes.php";
include "../classes/orders-contr.classes.php";

$gegevenswijzigen = new Orders;
$gegevenswijzigen->profileOrderDetails($id, $voornaam, $achternaam, $email, $telefoonnummer, $straat, $huisnumer, $postcode);


// Word terug gestuurd naar voorkant pagina
header("Location: ../myorders.php");
exit();
