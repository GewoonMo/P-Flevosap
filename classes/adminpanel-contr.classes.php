<?php

// include "includes/userswijz.inc.php";
//include_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbh.classes.php';

include_once "config/dbh.classes.php";


class Adminpanel extends Dbh
{


  // // Method to load the account information from the database
  public function idGet($uid)
  {
    $sql = "SELECT users_id, rol FROM users
    -- INNER JOIN customer ON users_id = userid
    WHERE users_id = '" . $uid . "'";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
      return $row;
    }
  }


  public function getUserData()
  {
    $sql = "SELECT * FROM users";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
      return $row;
    }
  }

  public function getProduct($id)
  {
    $sql = "SELECT * FROM product WHERE productID = $id";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
      return $row;
    }
  }

  public function getProductData()
  {
    $sql = "SELECT * FROM product";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
      return $row;
    }
  }

  public function getProductCategory()
  {
    $sql = "SELECT DISTINCT productCategoryID,name FROM product INNER JOIN productcategory ON productCategoryID = categoryID";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
      return $row;
    }
  }
  public function getUserDataInfo($id)
  {
    $sql = "SELECT * FROM users WHERE users_id = $id";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
      return $row;
    }
  }



  public function deleteUserAdmin($id)
  {
    try {
      $query = "DELETE FROM users WHERE users_id = $id";
      $stmt = $this->connect()->query($query);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  public function changeUserdata($id, $naam, $email, $Email_verified, $rol)
  {
    $stmt = $this->connect()->prepare('UPDATE users set  users_uid = :usersuid, users_email = :usersemail, emailVerified = :emailVerified,  rol = :rol
   WHERE users_id = :userid');
    $stmt->execute(array(':userid' => $id,  ':usersuid' => $naam, ':usersemail' => $email, ':emailVerified' => $Email_verified, ':rol' => $rol));
  }

  public function changeProductdata($productId, $productname, $productdesc, $price, $btw, $voorraad)
  {
    $stmt = $this->connect()->prepare('UPDATE product set productname = :productname, productdesc = :productdesc,  price = :price, btw = :btw, voorraad = :voorraad
     WHERE productID = :productid');
    $stmt->execute(array(':productid' => $productId,  ':productname' => $productname, ':productdesc' => $productdesc, ':price' => $price, ':btw' => $btw, ':voorraad' => $voorraad));
  }


  public function deleteProductAdmin($id)
  {
    try {
      $query = "DELETE FROM product WHERE productID = $id";
      $stmt = $this->connect()->query($query);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }
}
