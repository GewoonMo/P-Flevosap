<?php
// dit is de link naar de database
class Dbh
{
    public function connect()
    {
        try {
            // hier geef je de waarde aan van de database onderadere naam, username, password
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=p-flevosap', $username, $password);
            return $dbh;
        }
        // als er geen connectie gemaakt kan worden door een of andere fout krijg je een error
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
