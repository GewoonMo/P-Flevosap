<?php

include "config/dbh.classes.php";
class Orders extends Dbh
{


    // // Method to load the account information from the database
    public function profileOrderDetails()
    {
        $sql = "SELECT * FROM order
        WHERE users_id = '" . $_SESSION["userid"] . "'";

        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            return $row;
        }
    }
}


$testest = new Account();
