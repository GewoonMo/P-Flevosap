<?php
include "../config/dbh.classes.php";
class verify extends Dbh
{

    protected function verify($emailverify)
    {
        $stmt = $this->connect()->prepare('UPDATE users set emailVerified = 1 WHERE users_email = :users_email');
        $stmt->execute(array(':users_email' => $emailverify));
    }
}
