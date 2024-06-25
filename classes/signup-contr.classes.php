<?php

class SignupContr extends Signup
{

    private $email;
    private $uid;
    private $pwd;
    private $pwdRepeat;

    public function __construct($email, $uid, $pwd, $pwdRepeat)
    {
        $this->email = $email;
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
    }

    public function signupUser()
    {
        if ($this->emptyInput() == false) {
            // deze error krijg je gelijk op het meoment dat je op de submit button drukt als je niks hebt ingevuld
            header("location:../signup.php?error=emptyinput");
            exit();
        }
        if ($this->invalidUid() == false) {
            // echo "invalid username!";
            header("location:../signup.php?error=username");
            exit();
        }
        if ($this->invalidEmail() == false) {
            // hier is het email niet geldig en krijg je een error bij foute input 
            header("location:../signup.php?error=email");
            exit();
        }
        if ($this->pwdMatch() == false) {
            // als de password niet gelijk is bij de registratie krijg je een error passwordmatch in de URL
            header("location:../signup.php?error=passwordmatch");
            exit();
        }
        if ($this->uidTakenCheck() == false) {
            // hier is of email en of userame al in gebruik als dat het geval is krijg je de error useroremail taken in de URL
            header("location:../signup.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->email, $this->pwd, $this->pwdRepeat);
    }

    private function emptyInput()
    {
        if (empty($this->uid) || empty($this->email) || empty($this->pwd) || empty($this->pwdRepeat)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUid()
    {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // geen gelidge email
    public function invalidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // hier word gecheckt of de input van password en passwordreapet gelijk is(hetzelfde)
    private function pwdMatch()
    {
        if ($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


    // checkt of uis al ingenomen is
    private function uidTakenCheck()
    {
        if (!$this->checkUser($this->uid, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
