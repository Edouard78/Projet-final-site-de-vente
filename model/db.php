<?php

try {

$db = new PDO("mysql:host=localhost;dbname=shop", "root", "");
}

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>