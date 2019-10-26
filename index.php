<?php
$page = "home";
include ('inc/header.php');
include('inc/nav.php');
?>
    <h1>HOME</h1>


    <div class="login-form">
        <form action="" method="POST" name="frmAdd" class="ml-5">
            <h2>Ajoutes des informations</h2>

            <hr class="w-50 bg-dark">

            <div class="form-group">
                <input type="text" name="nom" class="form-control" placeholder="Nom">
            </div>
            <div class="form-group">
                <input type="text" name="prenom" class="form-control" placeholder="Prenom">
            </div>

            
                <input type="submit" name="submit" class="btn btn-primary">
           

        </form>
    </div>

    <?php

    if (isset($_POST['nom']) && isset($_POST['prenom'])) {

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
       
        echo "Bonjour, votre nom c'est ".$nom. " et votre prenom c'est ". $prenom;
    }


?>


</body>
</html>