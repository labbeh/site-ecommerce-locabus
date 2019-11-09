<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class db
{
    public function connect() {
        $mysqli = mysqli_connect("localhost", "ecommerce", "aqwzsxedc", "ecommerce");
        $res = mysqli_query($mysqli, "select * from client");
        $row = mysqli_fetch_assoc($res);
        return new Response(
            '<html><body>'.var_dump($row).'</body></html>');
    }
}