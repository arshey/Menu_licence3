<?php
require_once('inc/config.php');

$q = $_GET["name"];
$req = $bdd->query('SELECT * FROM users WHERE name = "' . $q . '" ');

while ($a = $req->fetch()) {
?>
    <br>
    nom: <?= $a['name']."<br/>" ?> <br>
    prenom :<?= $a['last_name'] . "<br/>" ?> <br>
    image: <img src="assets/uploads/<?= $a["picture"]; ?>" alt="" width="100">
<?php
}
?> 