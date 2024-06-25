<?php

class Login extends Dbh
{

    // hier pakt hij de password en user id van de database
    protected function getUser($email, $pwd)
    {
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_email
        = ? OR users_uid = ?;');

        if (!$stmt->execute(array($email, $pwd))) {
            $stmt = null;
            header("location: ../login.php?error-stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            // het checkt of de user al bestaat zo niet geeft hij usernot found aan
            $stmt = null;
            header("location: ../login.php?error=usernotfound");
            exit();
        }

        $pwdHased = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHased[0]["users_pwd"]);

        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../login.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {

            $stmt = $this->connect()->prepare('SELECT * FROM users   
            -- INNER JOIN customer ON users_id = userid
            WHERE users_email= ?
            OR users_uid = ? AND users_pwd = ? ;');

            if (!$stmt->execute(array($email, $email, $pwd))) {
                $stmt = null;
                header("location: ../login.php?error-stmtfailed");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../login.php?error=usernotfound");
                exit();
            }

            $stmt->execute(array($email, $email, $pwd));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $emailver = $result['emailVerified'];
            print($emailver);

            if ($emailver == 0) {
                $stmt = null;
                header("location:../login.php?error=accountnotverified");
                exit();
            } else {
                // $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION["userid"] = $result["users_id"];
                $_SESSION["users_uid"] = $result["users_uid"];
                // $_SESSION["cart"] = [];
                print($_SESSION["userid"]);
            }
            $stmt = null;
        }
        $stmt = null;
    }
}
