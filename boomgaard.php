<?php
include "partials/header.php";
include "partials/nav.php";
?>

<!DOCTYPE html>
<html lang="NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boomgaard - Flevosap</title>
</head>
<style>
    .banner {
        position: relative;
        width: 800px;
        height: 300px;
        background-color: #ccc;
    }

    .layer1 {
        position: absolute;
        z-index: 3;
        width: 100%;
        height: 100%;
        background-color: #f00;
        color: #fff;
        text-align: center;
    }

    .layer2 {
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 100%;
        background-color: #0f0;
        color: #fff;
        text-align: center;
    }

    .layer3 {
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        background-color: #00f;
        color: #fff;
        text-align: center;
    }
</style>

<img src="./assets/images/algemeen/banner_boomgaard.png" alt="banner" style="width: 100%; height: 100%;">



<body>
    <div class="container bg-image">
        <div class="container mx-auto">
            <div class="row">
                <div class="col-md-6  mt-10">
                    <h3>Fruit is het mooiste cadeautje van de natuur</h3>
                    <p>Familie Vermeulen maakt samen met een team van enthousiaste medewerkers Flevosap.
                        Ze zijn bijna iedere dag te vinden in de boomgaarden rondom hun boerderij en bij collega-kwekers die ook hun bijdrage leveren aan Flevosap.
                        Het fruit, dat is hun passie. Ze zijn er met hart en ziel aan verknocht.
                        Het maakt niet uit of je hen iets vraagt over appels, sinaasappels, aardbeien, citroenen, kersen, zwarte bessen, peren of cranberry’s: zij weten welk fruit in Flevosap mag, en welke niet.
                        Bij de appels zijn bijvoorbeeld de Elstar, Goudrenet en Jonagold favoriet.</p>
                </div>

                <div class="col-md-6">
                    <img src="./assets/images/algemeen/VruchtenB.png" alt="banner" style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include "partials/footer.php";
?>