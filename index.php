<?php

require ('controller/controller.php');


try {
    if (isset($_GET['action']))
        {
            echo 'Voici une action';

        }

    
    else
        {
            home();
        }

    }

catch(Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}
