<?php
include_once "config/dbh.classes.php";

class getproduct extends Dbh
{
  public function productsv()
  {
    $sql = "SELECT * FROM product WHERE productCategoryID  = 1";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll()) {
      return $row;
    }
  }


  public function productsg()
  {
    $sql = "SELECT * FROM product WHERE productCategoryID  = 2";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll()) {
      return $row;
    }
  }


  public function productsvtwee()
  {
    $sql = "SELECT * FROM product WHERE productCategoryID  = 3";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll()) {
      return $row;
    }
  }




  public function productss()
  {
    $sql = "SELECT * FROM product WHERE productCategoryID  = 4";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll()) {
      return $row;
    }
  }


  public function productsi()
  {
    $sql = "SELECT * FROM product WHERE productCategoryID  = 5";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll()) {
      return $row;
    }
  }



  public function products()
  {
    $sql = "SELECT * FROM product";
    $stmt = $this->connect()->query($sql);
    while ($row = $stmt->fetchAll()) {
      return $row;
    }
  }
}
$output = new getproduct();
