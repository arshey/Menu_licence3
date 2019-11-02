<?php
require_once('inc/config.php');

$req = $bdd->query('SELECT * FROM users ORDER BY id DESC');


if (isset($_POST["search"]) && !empty($_POST["search"])) {
    $q = htmlspecialchars($_POST["search"]);

    $req = $bdd->query('SELECT * FROM users WHERE name OR last_name  LIKE "%' . $q . '%" OR "%' . $q . '%" ');

}

?>

<form action="" method="post">
    <input type="search" name="search" id="search">
    <input type="submit" value="submit">
</form>



<ul>
    <?php
    while ($a = $req->fetch()) {
        ?>
        <li> 
            <a href="search_.php?name=<?= $a['name'] ?>">
                <?= $a['name'] ?>
            </a> 
        </li>
    <?php
}
?>
</ul>

<?php
if ($req->rowCount() == 0) {
    echo "Aucun résultat pour: <i><b>" . $q . "</b></i>...";
}
?>