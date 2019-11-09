<?php
//le nom de la variable
$page = "home";

//Connexion à la base donnée
include('inc/config.php');
//Connexion de l'entête du fichier
include('inc/header.php');
//connecion de la navbar
include('inc/nav.php');

 //error_reporting() modifie la directive error_reporting pendant l'exécution du script.
 error_reporting( ~E_NOTICE );

    //Si le bouton au nom "submit" est cliquer
    if (isset($_POST['submit'])) {

        //récupération du prénom et insertion de la valeur dans la variable $prenom
        $prenom = htmlspecialchars($_POST['prenom']);//htmlspecialchars Convertit les caractères spéciaux en entités HTML
        //récupération du nom et insertion de la valeur dans la variable $nom
        $nom = htmlspecialchars($_POST['nom']);

        //Si les valeurs dans l'une des variables $prenom ou $nom ou $_FILES['image']['name'] est vide alors 
         if (empty($prenom) OR empty($nom) OR empty($_FILES['image']['name'])) {
             //On affiche un message d'erreur demandant à l'utilisateur de remplir tous les champs du formulaire
             echo '
                    <div class="bs-example text-center">    
                        <div class="toast fade show">
                            <div class="toast-header red" >
                                <strong class="mr-auto"><i class="fa fa-exclamation-triangle"></i> Information</strong>
                                <button type="button" class="ml-2 mb-1 close red" data-dismiss="toast">&times;</button>
                            </div>
                            <div class="toast-body red">Veuillez; s\'il vous plaît remplir tous les champs du formulaire</div>
                        </div>
                    </div>  ';
         } else {//sinon
            $imgFile = $_FILES['image']['name'];        //$imgFile reçoit le nom de le fichier(image dans notre cas) uploader par le biais du formulaire [nom du fichier]
            $tmp_dir = $_FILES['image']['tmp_name'];    //$tmp_dir reçoît le chemin du fichier uploadé dans une mémoire tampon [chemin tampon]
            $imgSize = $_FILES['image']['size'];        //$imgSize reçoit le poids du fichier uploadé [poids du fichier]
            
            //Si l'image est vide alors [répétitif je sais mais bon 😊 c'est pas mauvais]
            if(empty($imgFile)){
                //On demande à l'utilisateur de reuploader le fichier
                $errMSG = "S'il vous plaît sélectionner une image.";
            } else { //sinon
                //$upload_dir est une variable dans la laquelle on indiquera le chemin où les images iront s'enregistrer
                //$upload_dir = mkdir('assets/uploads/');
                if (!file_exists('assets/uploads/')) {
                    mkdir('assets/uploads/');
                }
                //$imgExt reçoit ici l'extension du fichier
			    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); //strtolower -> fonction mettant tout ce qu'il reçoit en paramètre en minuscule 
			    $valid_extensions = ['jpeg', 'jpg', 'png', 'gif', 'pdf']; //$valid_extensions on liste les extensions qu'on aimerait pouvoir gérer dans notre formulaire
			    $image = rand(1000,1000000).".".$imgExt; //$image recevra par le biais de la fonction rand() un nom aléatoire qui sera une série de chiffre choisis entre 1000 et 1.000.000
                
                //Si l'extension et la validation des extensions sont valides alors
			    if(in_array($imgExt, $valid_extensions)){			
                
                    //si l'image pèse moins de 5000000Ko
				    if($imgSize < 5000000) {
                        //On déplace le fichier de la mémoire tampon au fichier de destination que nous avons choisis plus haut
                        move_uploaded_file($tmp_dir,$upload_dir.$image);

                        //Quand tout ce qui est plus haut est bon alors on va exécuter notre requête SQL
                        $sql = "INSERT INTO `users` ( `name`, `last_name`, `picture`) VALUES (:name, :last_name, :picture);";//$sql reçoit la requête d'exécution d'insertion dans la table users des différents paramètre
                        $req = $bdd->prepare($sql);//la requête $sql est préparée
                        //Une fois la requête preparée on l'exécute 
                        $result = $req->execute([
                                ':name'      => $nom,
                                ':last_name' => $prenom,
                                ':picture'   => $image
                        ]);

                        //Si $result qui permet l'exécution de l'insertion dans la base de donnée n'est pas null alors
                        if(!empty($result)){
                            //on affiche que tout est bon et que celui-ci sera rédirigé dans 2 secondes
                            echo '
                                    <div class="bs-example text-center">    
                                        <div class="toast fade show">
                                            <div class="toast-header green" >
                                                <strong class="mr-auto green"><i class="fa fa-check-circle green"></i> Succes</strong>
                                                <button type="button" class="ml-2 mb-1 close green" data-dismiss="toast">&times;</button>
                                            </div>
                                            <div class="toast-body green">
                                                Bravo l\'enregistrement a bien été fait et vous serez rédirigez d\'ici 2 secondes
                                            </div>
                                        </div>
                                    </div> ';
                            header("refresh:5;index.php");//header permet la redirection vers la nouvelle qu'on souhaite, et le refresh permet de définir en seconde le temps mis.
                        }

                    } else {//sinon si l'image dépase les 5000000Ko
                        //$errMSG affiche que la taille est trop grande
					    $errMSG = "Désolé l'image est un peu trop grande.";
				      }
                } else { //sinon si la validation des extensions n'est pas conforme alors 
                    //$errMSG affiche les différentes extensions à prendre en charge
				    $errMSG = "Désolé seule les format 'jpeg', 'jpg', 'png', 'gif' sont autorisés";		
			      }
             }
         }
    }

?>

<div class="container mt-5">
    <?php
        //Si nous avons une erreur alors $errMSG alors
		if(isset($errMSG)){
            //On affiche l'erreur qui se rapporte à celle-ci 
            echo '
                    <div class="container text-center">
                        <div class="row">
                            <div class="row col-sm">
                                <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-info-sign"></span> 
                                        <strong>
                                            <?= $errMSG;?>
                                        </strong>
                                </div>
                            </div>
                        </div>
                    </div>';
                    } 
	?>

    <div class="jumbotron">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm">
                    <h1 class="display-4">Home</h1>
                </div>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm">
                    <a name="" id="" class="btn btn-primary" href="index.php" role="button">
                        <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <hr class="my-4">

        <p class="lead">
            <div class="login-form">

                <form action="" method="POST" name="frmAdd" class="ml-5 text-center" enctype="multipart/form-data">

                    <h2 class="text-center">Ajouter des informations</h2>

                    <hr class="w-25 bg-dark">

                    <div class="form-group ">
                        <input type="text" name="nom" class="form-control w-25" placeholder="Nom">
                    </div>

                    <div class="form-group">
                        <input type="text" name="prenom" class="form-control w-25" placeholder="Prenom">
                    </div>

                    <div class="form-group">
                        <input type="file" name="image" class="form-control w-50" id="file" > 
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary">

                </form>
                
            </div>
        </p>
    </div>
</div>


</body>
</html>