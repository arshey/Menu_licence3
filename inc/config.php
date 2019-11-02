<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=licence2;charset=UTF8', 'root', 'root');
} catch (Exception $e) {
    die("Erreur : ".$e->getMessage);
}