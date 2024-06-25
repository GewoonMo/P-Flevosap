<?php
    include_once "config/dbh.classes.php";
    class Factuur extends Dbh
    {
        public function getFactuur($id)
        {
                $sql = "SELECT * FROM users
                INNER JOIN customer ON users_id = userid
                INNER JOIN `order` ON `order`.customerID = customer.customerID
                INNER JOIN orderedproduct ON `order`.orderID = orderedproduct.orderedProductID
                INNER JOIN product ON orderedproduct.productID = product.productID
                WHERE orderID = '" . $id . "'";
        
                $stmt = $this->connect()->query($sql);
                while ($row = $stmt->fetch()) {
                    return $row;
            }
        }

    }
?>