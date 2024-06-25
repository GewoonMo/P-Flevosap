<?php

include_once "config/dbh.classes.php";
require 'vendor/autoload.php';

class Payment extends dbh
{
    public function __construct()
    {
        \Stripe\Stripe::setApikey('sk_test_51MUWIXGjre2djKXP5EG6JRyAlVfCkwsSPAC3v43SHMGtOYaZwir5LxFlXjJGzKtny91H2DIr9R3EAWpW9Zi91MEP007iU5rBLn');
    }


    public function processPayment($session_id)
    {
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        // $betaalMethode = $session['payment_method_types']['0'];
        // $status = $session['payment_status'];
        return $session;
    }

    public function getCustomerData()
    {

        $sql = "SELECT * FROM users 
        INNER JOIN customer ON users_id = userid 
        WHERE users_id = '" . $_SESSION["userid"] . "'";
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            return $row;
        }
    }

    public function insertData($customerID, $status, $betaalMethode)
    {

        $username = "root";
        $password = "";
        $dbh = new PDO('mysql:host=localhost;dbname=p-flevosap', $username, $password);
        $stmt =  $dbh->prepare('INSERT INTO `order` (customerID, shipID, status, betaalMethode) VALUES (:customerID, :shipID, :status, :betaalMethode)');
        $stmt->execute(array(':customerID' => $customerID, ':shipID' => 1, ':status' => $status, ':betaalMethode' => $betaalMethode));
        return $dbh->lastInsertId();
    }


    public function insertproductorder($orderID, $productID, $quantity)
    {
        $stmt = $this->connect()->prepare('INSERT INTO orderedproduct (orderedProductID, productID, quantity) VALUES (:orderedProductID, :productID, :quantity)');
        $stmt->execute(array(':orderedProductID' =>  $orderID, ':productID' => $productID, ':quantity' => $quantity));
    }
}
