<?php
//cree une session et connection avec database
session_start();
try
{
    $db = new PDO('mysql:host=localhost;dbname=foodapp;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

//clients
$clientQuery = $db->prepare("SELECT * FROM users WHERE isAdmin=0");
$clientQuery->execute();
$client=$clientQuery->fetchAll();

//commandes
$commandeQuery = $db->prepare("SELECT * FROM commande");
$commandeQuery->execute();
$commande=$commandeQuery->fetchAll();

//caisse
$caisse= $db->prepare("SELECT sum(prix_total) as total from commande");
$caisse->execute();

//recents commandes SELECT * from table1 order by id desc LIMIT 10
$recentQuery = $db->prepare("SELECT * FROM commande ORDER BY commande_id DESC LIMIT 5");
$recentQuery->execute();
$recent=$recentQuery->fetchAll();

//lien pour orders
if(isset($_POST['voir'])){
    echo " <script> window.location='commande.php' </script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../css/admin.css?v=1">
    <script src="https://kit.fontawesome.com/f2d7819c83.js" crossorigin="anonymous"></script>

    <title>Admin</title>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2> <span class="lab la-accusoft"></span>Admin</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="./admin.php"  class="active"><span class="las la-igloo"></span> <span>Dashboard</span></a></li>
                <li><a href="./users.php"><span class="las la-users"></span> <span>Users</span></a></li>
                <li><a href="./menuAdmin.php"><span class="las la-clipboard-list"></span> <span>Menu</span></a></li>
                <li><a href="./commande.php" ><span class="las la-shopping-bag"></span> <span>Orders</span></a></li>
                <li><a href="../logout.php" ><i class="fa-solid fa-right-from-bracket"></i> <span>Déconnecter</span> </a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="header-title">
                <h2>
                    <label for="">
                        <span class="las la-bars"></span>
                    </label>
                    Dashboard
                </h2>
            </div>
            <div class="user-wrapper">
                <img src="../img/youcef.jpg" alt="" width="40px" height="40px">
                <div>
                    <h4><?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ; ?></h4>
                    <small>Super admin</small>
                </div>
            </div>
                
            
        </header>

        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1><?php echo count($client ); ?></h1>
                        <span>Clients</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo count($commande); ?></h1>
                        <span>Tout les commandes</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>
                </div>
                
                <div class="card-single">
                    <div>
                        <h1><?php print_r($caisse->fetchColumn()."DA") ?></h1>
                        <span>Caisse</span>
                    </div>
                    <div>
                        <span class="lab la-google-wallet"></span>
                    </div>
                </div>
            </div>

            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h2>Recente commands</h2>
                            <form action="" method="post">
                                <button type="submit" name="voir">Voir tout <span class="las la-arrow-right"></span></button>
                            </form>
                            
                        </div>
                        <div class="card-body">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>N°Order</td>
                                        <td>Nom</td>
                                        <td>Prix Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($recent as $r): ?>
                                    <tr>
                                        <td><?php echo $r['commande_id']; ?></td>
                                        <td>
                                            <?php
                                                $id=$r['commande_id'];
                                                $detailQuery= $db->prepare("SELECT * FROM commande_details WHERE commande_id=$id");
                                                $detailQuery->execute();
                                                $detail=$detailQuery->fetchAll();
 
                                                foreach($detail as $d){
                                                    print_r($d['nom']." ");
                                                }
                                                
                                            ?>
                                        </td>
                                        <td><?php echo $r['prix_total']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>