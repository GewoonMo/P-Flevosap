<?php

class verifycontr extends verify
{

    private $emailverify;

    public function __construct($emailverify)
    {
        $this->email = $emailverify;
    }

    public function actuate()
    {
        if ($this->emptyInput() == false) {
            // deze error krijg je gelijk op het meoment dat je op de submit button drukt als je niks hebt ingevuld
            header("location:http://localhost/p-flevosap/includes/verifylink.inc.php?error");
            exit();
        }

        $this->verify($this->email);
    }


    private function emptyInput()
    {
        if (empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
