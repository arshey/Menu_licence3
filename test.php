<?php

include('inc/config.php');


$req = $bdd->prepare("SELECT * FROM users");
$req->execute();
$req2 = $req->fetchAll();

if (!empty($req2)) {
                   foreach ($req2 as $row) {
?>
			<img src="assets/uploads/<?= $row['picture']; ?>" alt="">		
<?php
				   }
				}