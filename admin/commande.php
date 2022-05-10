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

//orders
$commandeQuery = $db->prepare("SELECT * FROM commande ORDER BY commande_id DESC");
$commandeQuery->execute();
$order=$commandeQuery->fetchAll();




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

    <title>Menu</title>
    <style>
        
        thead td {
            padding: 0.5rem 7.2rem;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2> <span class="lab la-accusoft"></span>Admin</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="./admin.php"  ><span class="las la-igloo"></span> <span>Dashboard</span></a></li>
                <li><a href="./users.php" ><span class="las la-users"></span> <span>Users</span></a></li>
                <li><a href="./menuAdmin.php" ><span class="las la-clipboard-list"></span> <span>Menu</span></a></li>
                <li><a href="./commande.php" class="active"><span class="las la-shopping-bag"></span> <span>Orders</span></a></li>
                <li><a href="../logout.php" ><i class="fa-solid fa-right-from-bracket"></i> <span>Déconnecter</span></a></li>

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
                    Orders
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
        <div style="margin-top: -1.5rem;">
            <div class="projects">
                <div class="card">
                    <div class="card-header">
                        <h2>All commands</h2>
                        
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <thead>
                                <tr >
                                    <td>N°Order</td>
                                    <td>All product</td>
                                    <td>Prix totale</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($order as $o): ?>
                                    <tr>
                                        <td><?php echo $o['commande_id']; ?></td>
                                        <td>
                                            <?php
                                                $id=$o['commande_id'];
                                                $detailQuery= $db->prepare("SELECT * FROM commande_details WHERE commande_id=$id");
                                                $detailQuery->execute();
                                                $detail=$detailQuery->fetchAll();
 
                                                foreach($detail as $d){
                                                    print_r($d['nom']." ");
                                                }
                                                
                                            ?>
                                        </td>
                                        <td><?php echo $o['prix_total']; ?></td>
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