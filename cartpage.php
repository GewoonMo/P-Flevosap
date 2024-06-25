<?php
include "partials/header.php";
include "partials/nav.php";
// include "config/dbh.classes.php";
include "classes/cart-contr.classes.php";

$winkelwagen = new winkelwagen();
$winkelwageninfo = $winkelwagen->getCart();
?>

<!DOCTYPE html>
<html lang="NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/cartpage.css" rel="stylesheet">
    <title>Hmmm - Flevosap</title>
    <!-- <meta http-equiv="refresh" content="10"> -->

</head>
<img src="./assets/images/algemeen/achtergrond_hmmm.png" alt="banner" style="width: 100%; height: 100%;">

<body>

    <div class="container h-100  p-3 mb-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <p><span class="h2">Winkelwagen </span> <span class="h5">(<span id="cartCount">
                            <?php
                            echo count($winkelwageninfo);
                            ?></span> producten)</span></p>
                </p>
                <?php
                if (!empty($winkelwageninfo)) {
                    $productID = $_SESSION["cart"];

                    foreach ($productID as $key => $value) {
                        $aantal = $value;
                        $productID = $key;
                        $producten = $winkelwagen->getstockitemdetails($productID);

                        foreach ($producten as $product) {

                ?>
                            <br>
                            <div class="card mb-4">

                                <div class="card-body p-4">

                                    <div class="row align-items-center">

                                        <div class="col-md-2 d-flex justify-content-center">
                                            <div>
                                                <!-- <p class="small text-muted mb-4 pb-2">Product verwijderen</p> -->
                                                <!-- <a href="#!" class="text-muted"><i class="fas fa-times"></i></a> -->
                                                <form action="cartpage.php" method="post" id="removeForm">
                                                    <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                                                    <!-- <input type="submit" name="submit" value="Remove Product from Cart">
                                                    <a href="cartpage.php" class="text-muted" name="submit" onclick="document.getElementById('removeForm').submit();">
                                                        <i class="fas fa-times"></i>
                                                    </a> -->
                                                    <button type="submit" name="submit" class="btn  bg-transparent rounded-circle ">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>


                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            if ($product['productCategoryID'] == 1) {
                                                echo '<img src=assets/images/sappen/vruchtensap/' . $product['image'] . ' alt="vruchtensap" class="img-fluid bg-transparent"/>';
                                            } elseif ($product['productCategoryID'] == 2) {
                                                echo '<img src=assets/images/sappen/groentensap/' . $product['image'] . ' alt="groentensap" class="img-fluid bg-transparent" />';
                                            } elseif ($product['productCategoryID'] == 3) {
                                                echo '<img src=assets/images/horeca/vruchtensap/' . $product['image'] . ' alt="groentensap" class="img-fluid bg-transparent" />';
                                            } elseif ($product['productCategoryID'] == 4) {
                                                echo '<img src=assets/images/horeca/smoothiesap/' . $product['image'] . ' alt="groentensap" class="img-fluid bg-transparent" />';
                                            } elseif ($product['productCategoryID'] == 5) {
                                                echo '<img src=assets/images/horeca/ijsjes/' . $product['image'] . ' alt="groentensap" class="img-fluid bg-transparent" />';
                                            }

                                            ?>

                                        </div>
                                        <div class="col-md-2 d-flex justify-content-center">
                                            <div>
                                                <p class="small text-muted mb-4 pb-2">Productnaam</p>
                                                <p class="lead fw-normal mb-0"><?php echo  $product['productname'] ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-2 d-flex justify-content-center">
                                            <div>
                                                <p class="small text-muted mb-4 pb-2">Aantal</p>

                                                <!-- <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                </button> -->
                                                <form action="cartpage.php" method="post" id="updateForm">
                                                    <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                                                    <input id="form1" min="1" max="50" name="aantal" value="<?php print $aantal ?>" type="number" class="form-control form-control-sm" />


                                                </form>
                                                <!-- <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                </button> -->
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex justify-content-center">
                                            <div>
                                                <p class="small text-muted mb-4 pb-2">Prijs</p>
                                                <p class="lead fw-normal mb-0"><?php echo "€ " . $product['price']  ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-2 d-flex justify-content-center">
                                            <div>
                                                <p class="small text-muted mb-4 pb-2">Totaal</p>
                                                <p class="lead fw-normal mb-0"> <?php echo "€ " . $product['price'] * $aantal; ?></p>
                                            </div>

                                        </div>


                                    </div>

                                </div>

                            </div>
                            <!-- <br> -->
                            <?php
                            $totaal = $winkelwagen->getTotalExcBtw($product['price'], $aantal);
                            $btw = $winkelwagen->getBtw($product['price'], $product['btw'], $aantal);
                            $totaalIncBtw = $winkelwagen->getTotalIncBtw($totaal, $btw);
                            $verzendkosten = $winkelwagen->calculateCosts($totaalIncBtw);
                            $totaalprijs = $winkelwagen->getTotalPrice($totaal, $verzendkosten);

                            if (isset($_POST['submit'])) {
                                $productID = $_POST['productID'];
                                $winkelwagen->removeProductFromCart($productID);
                            ?>

                                <script>
                                    window.location.href = "cartpage.php";
                                </script>
                            <?php
                            }


                            if (isset($_POST['aantal'])) {
                                $productID = $_POST['productID'];
                                $aantal = $_POST["aantal"];
                                $winkelwagen->updateProductInCart($productID, $aantal);
                            ?>

                                <script>
                                    window.location.href = "cartpage.php";
                                </script>
                    <?php
                            }
                        }
                    }

                    ?>

                    <div class="card mb-5">
                        <div class="card-body p-4">
                            <div class="float-end">
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>Aantal btw(9%)</span>
                                    <strong><?php print sprintf("€ %0.2f", $btw) ?></strong>
                                </li>
                                <br>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>Totaal inc btw: </span>
                                    <strong><?php print sprintf("€ %0.2f",     $totaalIncBtw) ?></strong>
                                </li>
                                <br>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>Verzendkosten: </span>
                                    <strong><?php print sprintf("€ %0.2f",  $verzendkosten) ?></strong>
                                </li>
                                <br>
                                <li class="list-group-item d-flex justify-content-between">

                                    <span>Totaal bedrag: </span>
                                    <strong><?php print sprintf("€ %0.2f", $totaalprijs) ?></strong>
                                </li>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="products-vsap.php" class="btn btn-light btn-lg me-2">Verder met winkelen</a>
                        <a href="checkout.php" class="btn btn-custom-color btn-lg me-2">Betalen</a>
                    </div>

            </div>
        </div>
    </div>

<?php

                    // print  $btw . "<br>";
                    // print   $totaal . "<br>";
                    // print  $totaalIncBtw . "<br>";
                    // print  $verzendkosten . "<br>";
                    // print  $totaalprijs . "<br>";
                } else {
?>
    <div class="emptycart" style=" text-align:center; margin-top:5%;">
        <img src="assets/images/algemeen/leeg_winkelwagen.jpg" alt="winkelwagen leeg" style="width: 20%; height: 20%;">
        <h3 class="font-weight-bold">Uw winkelwagentje is leeg</h3>
        <h6> Op zoek naar ideeën?</h6> <br>
        <div class="col-50">
            <input type="button" class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='sappen.php';" value="Zoek door onze producten heen" />
        </div>
    </div>
    </div>
    </div>
    </div>
<?php
                }
?>


</body>
<footer>
    <?php

    include "partials/footer.php";
    ?>
</footer>

</html>