<?php

 

try {
    $bdd = new PDO('mysql:host=localhost;dbname=licence2', 'root', 'root');
    //echo "c'est bon";
} catch (Exception $error) {
   die("Erreur : ".$error->getMessage());
}
   
