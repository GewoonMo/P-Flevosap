<?php
include "../config/dbh.classes.php";
include "../classes/checkout-contr.php";
// include "../classes/profile.classes.php";
// include "../classes/profile-contr.classes.php";
$totprijs = $_POST["totprijs"];
$productname = $_POST["productname"];

$id = $_POST["id"];
$voornaam = $_POST["voornaam"];
$achternaam = $_POST["achternaam"];
$email = $_POST["email"];
$straat = $_POST["straat"];
$huisnumer = $_POST["huisnummer"];
$postcode = $_POST["postcode"];
$plaats = $_POST["plaats"];
$land = $_POST["land"];
$telefoonnummer = $_POST["telefoonnummer"];

$amount = round($totprijs, 2) * 100;

$gegevenswijzigen = new StripePayment();
$gegevenswijzigen->insertCustomerDataCheckout($id, $voornaam, $achternaam, $email, $telefoonnummer, $straat, $huisnumer, $postcode, $plaats, $land);

$stripePayment = new StripePayment();
$stripePayment->createCheckoutSession($amount, $productname);
// $stripePayment->InsertIntoDatabase();
