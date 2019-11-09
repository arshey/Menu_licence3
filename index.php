<?php
$page = "home";
require_once('inc/config.php');
include('inc/header.php');
include('inc/nav.php');

$req = $bdd->prepare("SELECT * FROM users");
$req->execute();
$users = $req->fetchAll(); 


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
                if (!empty($users)) {
                   foreach ($users as $user) {
            ?>
            <tbody>
                <tr>
                <th scope="row"><?= $user["id"]; ?></th>
                <td><?= $user["name"]; ?></td>
                <td><?= $user["last_name"]; ?></td>
                <td> <img src="assets/uploads/<?= $user["picture"]; ?>" alt="" width="100"> </td>
                 <td><a name="" id="" class="btn btn-primary" href="update.php?id=<?= $user['id']?>" role="button"><i class="fa fa-book" aria-hidden="true"></i></a></td>
                <td> <a name="" id="" class="btn btn-primary" href="delete.php?id=<?= $user['id']?>" onclick="return confirm('Voulez vous supprimer cette donnéee ?')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
