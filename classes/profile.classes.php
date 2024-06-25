<?php

//include_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbh.classes.php';
include_once "config/dbh.classes.php";

class Account extends Dbh
{


  // // Method to load the account information from the database
  public function profileDetails()
  {

    $sql = "SELECT * FROM users 
    INNER JOIN customer ON users_id = userid
    WHERE users_id = '" . $_SESSION["userid"] . "'";

    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetch()) {
      return $row;
    }
  }

  public function accountDestroy()
  {
    $sql = "DELETE FROM users 
    WHERE users_id = '" . $_SESSION["userid"] . "'";

    $stmt = $this->connect()->query($sql);
    $stmt->execute();

    session_destroy();
    header("Location: ../index.php");
    exit();
  }

  public function insertCustomerData($id, $name, $lastName, $email, $phoneNumber, $street, $houseNumber, $postalCode, $district, $country)
  {
    $stmt = $this->connect()->prepare('UPDATE users set users_email = :usersemail  
   WHERE users_id = :userid');
    $stmt->execute(array(':userid' => $id, ':usersemail' => $email));

    $stmt = $this->connect()->prepare('INSERT INTO customer (userid, name, lastname, phoneNumber, street, houseNumber, postalCode, district, country) VALUES (:userid, :userName, :lastname, :phoneNumber, :street, :houseNumber, :postalCode, :district, :country)');
    $stmt->execute(array(':userid' => $id, ':userName' => $name, ':lastname' => $lastName, ':phoneNumber' => $phoneNumber, ':street' => $street, ':houseNumber' => $houseNumber, ':postalCode' => $postalCode, ':district' => $district, ':country' => $country));

    header("Location: ../myaccount.php");
    exit();
  }

  public function insertCustomerDataCheckout($id, $name, $lastName, $email, $phoneNumber, $street, $houseNumber, $postalCode, $district, $country)
  {
    $stmt = $this->connect()->prepare('UPDATE users set users_email = :usersemail  
   WHERE users_id = :userid');
    $stmt->execute(array(':userid' => $id, ':usersemail' => $email));

    $stmt = $this->connect()->prepare('INSERT INTO customer (userid, name, lastname, phoneNumber, street, houseNumber, postalCode, district, country) VALUES (:userid, :userName, :lastname, :phoneNumber, :street, :houseNumber, :postalCode, :district, :country)');
    $stmt->execute(array(':userid' => $id, ':userName' => $name, ':lastname' => $lastName, ':phoneNumber' => $phoneNumber, ':street' => $street, ':houseNumber' => $houseNumber, ':postalCode' => $postalCode, ':district' => $district, ':country' => $country));
  }


  public function changeCustomerdata($id, $name, $lastName, $email, $phoneNumber, $street, $houseNumber, $postalCode, $district, $country)
  {
    $stmt = $this->connect()->prepare('UPDATE users set users_email = :usersemail  
   WHERE users_id = :userid');
    $stmt->execute(array(':userid' => $id, ':usersemail' => $email));

    $stmt = $this->connect()->prepare('UPDATE customer set name = :userName, lastname = :lastname, 
     phoneNumber = :phoneNumber, street = :street, houseNumber = :houseNumber, postalCode = :postalCode,  district = :district,  country = :country WHERE userid = :userid');
    $stmt->execute(array(':userid' => $id, ':userName' => $name, ':lastname' => $lastName, ':phoneNumber' => $phoneNumber, ':street' => $street, ':houseNumber' => $houseNumber, ':postalCode' => $postalCode, ':district' => $district, ':country' => $country));


    header("Location: ../myaccount.php");
    exit();
  }

  public function profileOrderDetails()
  {

    $sql = "SELECT * FROM `orderedproduct` 
    INNER JOIN `order` on `orderedproduct`.orderedProductid = `order`.orderID
    INNER JOIN customer on `order`.customerID = `customer`.customerID
    INNER JOIN product ON `orderedproduct`.productID = `product`.productID
    ORDER BY orderDate DESC;
    WHERE userid = '" . $_SESSION["userid"] . "'";

    $stmt = $this->connect()->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }


  public function profileDetail()
  {
    // $sql = "SELECT * FROM `order` 
    // INNER JOIN customer on `order`.customerID = `customer`.customerID
    // INNER JOIN orderedproduct ON `order`.orderID = `orderedproduct`.orderedProductid
    // INNER JOIN product ON `orderedproduct`.productID = `product`.productID
    // WHERE userid = '" . $_SESSION["userid"] . "'";

    $sql = "SELECT * FROM `order` 
    INNER JOIN customer on `order`.customerID = `customer`.customerID
    WHERE userid = '" . $_SESSION["userid"] . "'";
    $stmt = $this->connect()->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function profileOrderCheck($customID)
  {
    // this function shows the order details of the current user
    $sql = "SELECT * FROM `order`
        INNER JOIN customer on `order`.customerID = `customer`.customerID
        INNER JOIN orderedproduct ON `order`.orderID = `orderedproduct`.orderedProductid
        INNER JOIN product ON `orderedproduct`.productID = `product`.productID
       
       
    WHERE `order`.customerID = '" . $customID . "'";
    $stmt = $this->connect()->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }


  public function OrderDetails()
  {

    if (isset($_GET['orderID'])) {
      $orderID = $_GET["orderID"];

      $sql = "SELECT * FROM `orderedproduct` 
    INNER JOIN `order` on `orderedproduct`.orderedProductid = `order`.orderID
    INNER JOIN customer on `order`.customerID = `customer`.customerID
    INNER JOIN product ON `orderedproduct`.productID = `product`.productID
    WHERE order.orderID = $orderID 
    ORDER BY orderDate DESC";

      $stmt = $this->connect()->query($sql);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }
  }
}


$account = new Account();
