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
    <title>Vruchtensap - Flevosap</title>
</head>
<img src="./assets/images/sappen/vruchtensap/image.png" alt="banner" style="width: 100%; height: 100%;">

<body>
    <?php include 'classes/products.classes.php';
    $result = $output->productsvtwee();

    ?>






    <?php
    foreach ($result as $producten) {
    ?>
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-md-3 mt-1">
                            <?php echo '<img src=assets/images/horeca/vruchtensap/' . $producten['image'] . ' alt="" class="img-fluid" />' ?>
                        </div>
                        <div class="col-md-6 mt-1">
                            <h5><?php echo $producten['productname'] ?> </h5>

                            <div class="mt-1 mb-1 spec-1"><?php echo $producten['productdesc']; ?></span></div>
                            <button class="btn btn-outline-success my-2 my-sm-0" value="voor meer informatie"><a class="btn-custom-infoproduct" href="sappendetails.php?productid=<?php echo $producten['productID'] ?>">Voor meer informatie</a></button>

                        </div>
                        <div class="align-items-center align-content-center col-md-3  mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1"><?php print sprintf("€%0.2f",$producten['price']); ?></h4>
                            </div>
                            <h6 class="text">Bestel nu morgen in huis</h6>
                            <div class="d-flex flex-column mt-4">
                                <!-- <button class="btn btn-outline-success btn-sm mt-2 bi bi-cart d-flex align-items-center"
                                type="button"><i class="fas fa-shopping-cart"></i> Voeg to aan winkelwagen</button> -->
                                <form action="includes/cart.inc.php" method="post">
                                    <input type="hidden" value="<?php echo $producten['productID'] ?>" name="id">
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