<?php

// doet precies het zelfde als de login classes allen checkt de code of de mail en of username niet eerder zijn gebruikt
class Signup extends Dbh
{

    protected function setUser($email, $uid, $pwd)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_email, users_pwd) VALUES (?,?,?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($email, $uid, $hashedPwd))) {
            $stmt = null;
            header("location: ../signup.php?error-stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function checkUser($email, $uid)
    {
        $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?');

        if (!$stmt->execute(array($email, $uid))) {
            $stmt = null;
            header("location: ../signup.php?error-stmtfailed");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}
