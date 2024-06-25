<?php

class LoginContr extends Login
{
    // dit maakt de email en pwd private
    private $email;
    private $pwd;

    public function __construct($email, $pwd)
    {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    // word gecheckt op emptyinput
    public function loginUser()
    {
        if ($this->emptyInput() == false) {
            // echo "Empty input!";
            header("location:../login.php?error=emptyinput");
            exit();
        }
        $this->getUser($this->email, $this->pwd);
    }

    // dit zorgt er voor dat er altijd een waarde in de input velden moet komen staan
    private function emptyInput()
    {
        if (empty($this->email) || empty($this->pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
