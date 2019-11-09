<?php
$page = "home";
require_once('inc/config.php');
include('inc/header.php');
include('inc/nav.php');

$req = $bdd->prepare("SELECT * FROM users");
$req->execute();
$req2 = $req->fetchAll(); 

 error_reporting( ~E_NOTICE );

    if (isset($_POST['submit'])) {

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);

         if (empty($prenom) OR empty($nom) OR empty($_FILES['image']['name'])) {
             echo '
                <div class="bs-example text-center">    
                <div class="toast fade show">
                    <div class="toast-header red" >
                        <strong class="mr-auto"><i class="fa fa-exclamation-triangle"></i> Information</strong>
                        <button type="button" class="ml-2 mb-1 close red" data-dismiss="toast">&times;</button>
                    </div>
                    <div class="toast-body red">Veuillez; s\'il vous plaît remplir le formulaire</div>
                </div>
                </div>
             ';
        }else{

        $imgFile = $_FILES['image']['name'];
		$tmp_dir = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
        
        if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		}
		else
		{
			$upload_dir = 'user_images/'; 
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
		
			
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
		
			
			$image = rand(1000,1000000).".".$imgExt;
				
			
			if(in_array($imgExt, $valid_extensions)){			
				
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$image);
				}
				else{
					$errMSG = "Désolé l'image est un peu trop grande.";
				}
			}
			else{
				$errMSG = "Désolé seule les format 'jpeg', 'jpg', 'png', 'gif' sont autorisés";		
			}
		}

    }
    }

?>

 
    <div class="container mt-5">

    <?php
		if(isset($errMSG)){
	?>
        <div class="container text-center">
            <div class="row">
            
            <div class="row col-sm">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                </div>
            </div>
            </div>
        </div>

		
	<?php
		}
	?>


        <div class="jumbotron">
        <h1 class="display-4">Home</h1>
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



<div class="container ">
    <div class="container mt-5">
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm"></div>
        <div class="col-sm">
            <a name="" id="" class="btn btn-primary" href="add.php" role="button"><i class="fa fa-plus-square fa-3x" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
    <div class="jumbotron mt-5">
        <h1 class="display-3">LISTES DES USERS</h1>
        <hr class="my-2">
        <p class="lead">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Picture</th>
                <th scope="col">Modify</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <?php
                if (!empty($req2)) {
                   foreach ($req2 as $row) {
            ?>
            <tbody>
                <tr>
                <th scope="row"><?= $row["id"]; ?></th>
                <td><?= $row["name"]; ?></td>
                <td><?= $row["last_name"]; ?></td>
                <td> <img src="assets/uploads/<?= $row["picture"]; ?>" alt="" width="100"> </td>
                 <td><a name="" id="" class="btn btn-primary" href="update.php?id=<?= $row['id']?>" role="button"><i class="fa fa-book" aria-hidden="true"></i></a></td>
                <td> <a name="" id="" class="btn btn-primary" href="delete.php?id=<?= $row['id']?>" onclick="return confirm('Voulez vous supprimer cette donnéee ?')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
            </tbody>
            <?php 

                   }
                }
            ?>

        
            </table>

        </p>
    </div>
</div>

<?php
include('inc/footer.php');
