<?php
$page = "home";
require_once('inc/config.php');
include('inc/header.php');
include('inc/nav.php');

$req = $bdd->prepare("SELECT * FROM users");
$req->execute();
$req2 = $req->fetchAll();
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