<?php
include "partials/header.php";
include "classes/session.classes.php";
Session::start();
include "partials/nav.php";
include "classes/aftercheckout-contr.php";
include "classes/cart-contr.classes.php";


$winkelwagen = new winkelwagen();
$winkelwageninfo = $winkelwagen->getCart();
$payment = new Payment();
$session_id = $_GET['session_id'];
$result = $payment->processPayment($session_id);
$customerData = $payment->getCustomerData();
$betaalMethode = $result['payment_method_types']['0'];
$status = $result['payment_status'];
$customerID = $customerData["customerID"];
$insertData = $payment->insertData($customerID, $status, $betaalMethode);
$orderIDD = $insertData;
$productID = $_SESSION["cart"];
foreach ($productID as $key => $value) {
  $aantal = $value;
  $productID = $key;
  $producten = $winkelwagen->getstockitemdetails($productID);
  foreach ($producten as $product) {
    $quantity = $aantal;
    $productid = $productID;

    $insertproduct = $payment->insertproductorder($orderIDD, $productid, $quantity);
  }
}

?>

<html>

<head>
  <title>Bedankt voor je bestelling!</title>
</head>

<body>
  <h1>Bedankt voor je bestelling!</h1>
  <p>
    We waarderen uw zaken!
    Uw order nummer is = <?php echo $session_id ?>
    Als u vragen heeft, kunt u mailen
    <a href="mailto:orders@example.com">orders@example.com</a>.
  </p>
  <a href="index.php">Terug naar de startpagina</a>
</body>

</html>

<?php
// unset($_SESSION["cart"]);
?>