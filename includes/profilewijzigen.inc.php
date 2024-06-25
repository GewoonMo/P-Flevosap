<?php

if (isset($_POST["submit"])) {
    // POST DE WOORD UID PWD IN DATABASE
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

    include "../config/dbh.classes.php";
    include "../classes/profile.classes.php";
    include "../classes/profile-contr.classes.php";

    $gegevenswijzigen = new Account($voornaam, $achternaam, $email, $telefoonnummer, $straat, $huisnumer, $postcode,  $plaats, $land);
    $gegevenswijzigen->changeCustomerdata($id, $voornaam, $achternaam, $email, $telefoonnummer, $straat, $huisnumer, $postcode, $plaats, $land);


    // Word terug gestuurd naar voorkant pagina
    header("Location: ../myaccount.php?changed=success");
    exit();
}
