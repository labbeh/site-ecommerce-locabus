<?php


namespace App\Controller;

use PhpParser\Node\Expr\Array_;
use Symfony\Component\HttpFoundation\Response;

class db
{
    public function connect() {

        $gdupont= Array("nom" => "Dupont", "prenom" => "Gerard", "sexe" => "M", "age" => 42, "email" => "gerard.dupont@gmail.com", "password" => "gdupont");
        $cjarlant = Array("nom" => "Jarlant", "prenom" => "Catherine", "sexe" => "F", "age" => 36, "email" => "catherine.jarlant@gmail.com", "password" => "cjarlant");
        $bgroult = Array("nom" => "Groult", "prenom" => "Benoit", "sexe" => "M", "age" => 33, "email" => "benoit.groult@gmail.com", "password" => "bgroult");
        $persons = Array($gdupont, $cjarlant, $bgroult);
        $db = new \PDO("mysql:host=localhost;dbname=ecommerce", "ecommerce", "aqwzsxedc");

        try {
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $db->beginTransaction();

            $temp = $db->prepare('insert into client (nom, prenom, sexe, age, email, password) values (:nom, :prenom, :sexe, :age, :email, :password)');
            foreach ($persons as $person) {
                $temp->bindParam(":nom", $person["nom"]);
                $temp->bindParam(":prenom", $person["prenom"]);
                $temp->bindParam(":sexe", $person["sexe"]);
                $temp->bindParam(":age", $person["age"]);
                $temp->bindParam(":email", $person["email"]);
                $cryptPassword = password_hash($person["password"], PASSWORD_BCRYPT);
                $temp->bindParam(":password", $cryptPassword);
                $temp->execute();
            }
            $db->commit();
            $return = "L'insertion s'est correctement déroulée";
        } catch (\Exception $e) {
            $return = "Failed: " . $e->getMessage();
        }
        return new Response(
            '<html><body>'.$return.'</body></html>');
    }
}