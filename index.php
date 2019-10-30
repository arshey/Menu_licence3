<?php
$page = "home";
include('inc/header.php');
include('inc/nav.php');
?>

    <div class="container mt-5">
        <div class="jumbotron">
        <h1 class="display-4">Home</h1>
        <hr class="my-4">
        <p class="lead">
    <div class="login-form">
        <form action="" method="POST" name="frmAdd" class="ml-5 text-center" enctype="multipart/form-data">
            <h2 class="text-center">Ajoutes des informations</h2>

            <hr class="w-25 bg-dark">

            <div class="form-group ">
                <input type="text" name="nom" class="form-control w-25" placeholder="Nom">
            </div>
            <div class="form-group">
                <input type="text" name="prenom" class="form-control w-25" placeholder="Prenom">
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control" id="file" > 
            </div>

            
                <input type="submit" name="submit" class="btn btn-primary">
           

        </form>
    </div>
        </p>
    </div>
    </div>

    <?php

    error_reporting( ~E_NOTICE );

    if (isset($_POST['submit'])) {

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);

        $imgFile = $_FILES['image']['name'];
		$tmp_dir = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
        
        if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		} else {
			$upload_dir = 'assets/uploads/'; 
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
		
			
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
		
			
			$image = rand(1000,1000000).".".$imgExt;
				
			
			if(in_array($imgExt, $valid_extensions)){			
				
				if($imgSize < 5000000)				{
                    move_uploaded_file($tmp_dir,$upload_dir.$image);
                    echo "Wesh c bon";
				}
				else{
					$errMSG = "Désolé l'image est un peu trop grande.";
				}
			}
			else{
				$errMSG = "Désolé seule les format 'jpeg', 'jpg', 'png', 'gif' sont autorisés";		
			}
		}
       
        echo "Bonjour, votre nom c'est ".$nom. " et votre prenom c'est ". $prenom;
    }

?>


</body>
</html>
