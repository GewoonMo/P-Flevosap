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
    <title>Sappen - Flevosap</title>
</head>
<img src="./assets/images/sappen/vruchtensap/image.png" alt="banner" style="width: 100%; height: 100%;">

<body>
    <?php include 'classes/products.classes.php';
    include 'classes/search.classes.php';
    $search = new Search();

    if (isset($_GET['search'])) {
        $result = $_GET['search'];
        $producten = $search->searchProduct($result);
    } elseif (isset($_GET['error'])) {
        $producten = [];
    ?>
        <div class="emptycart" style=" text-align:center;">
            <img src="assets/images/algemeen/leeg_winkelwagen.jpg" alt="winkelwagen leeg" style="width: 20%; height: 20%;">
            <h3 class="font-weight-bold">Het gezochte product is niet gevonden.</h3>
            <div class="col-50 mt-5 mb-5">
                <input type="button" class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='sappen.php';" value="Zoek door onze producten heen" />
            </div>
        </div>
    <?php
    } elseif (!isset($_GET['search'])) {
        $producten = new getproduct();
        $producten = $producten->products();
    } else {
        $producten = [];
        print "Er is iets fout gegaan";
    }
    ?>
    <?php
    foreach ($producten as $product) {
    ?>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-3 mt-1">
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
                        <div class="col-md-6 mt-1">
                            <h5><?php echo $product['productname'] ?> </h5>

                            <div class="mt-1 mb-1 spec-1"><?php echo $product['productdesc']; ?></span></div>
                            <button class="btn btn-outline-success " value="voor meer informatie"><a class="btn-custom-infoproduct" href="sappendetails.php?productid=<?php echo $product['productID'] ?>">Voor meer informatie</a></button>

                        </div>
                        <div class="align-items-center align-content-center col-md-3  mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1">€<?php echo $product['price']; ?></h4>
                            </div>
                            <h6 class="text">Bestel nu morgen in huis</h6>
                            <div class="d-flex flex-column mt-4">
                                <!-- <button class="btn btn-outline-success btn-sm mt-2 bi bi-cart d-flex align-items-center"
                                type="button"><i class="fas fa-shopping-cart"></i> Voeg to aan winkelwagen</button> -->
                                <form action="includes/cart.inc.php" method="post">
                                    <input type="hidden" value="<?php echo $product['productID'] ?>" name="id">
                                    <input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Voeg toe aan winkelwagen" name="submit">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }
    include "partials/footer.php";
    ?>
</body>

</html>