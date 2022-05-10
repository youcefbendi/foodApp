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

//Select admins
$adminQuery = $db->prepare("SELECT * FROM users WHERE isAdmin=1");
$adminQuery->execute();
$admin=$adminQuery->fetchAll();

//Select clients
$clientQuery = $db->prepare("SELECT * FROM users WHERE isAdmin=0");
$clientQuery->execute();
$client=$clientQuery->fetchAll();




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
                <li><a href="./users.php" class="active" ><span class="las la-users"></span> <span>Clients</span></a></li>
                <li><a href="./menuAdmin.php" ><span class="las la-clipboard-list"></span> <span>Menu</span></a></li>
                <li><a href="./commande.php" ><span class="las la-shopping-bag"></span> <span>Orders</span></a></li>
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
                        <h2>Tout les admins</h2>
                        <form action="" method="post">
                            <button type="submit" name="admin" >Ajouter un Admin <span class="las la-arrow-right"></span></button>

                        </form>
                        <?php 
                            if(isset($_POST['admin'])){
                                echo " <script> window.location='ajouterAdmin.php' </script>";
                            }
                        ?>
                        
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <thead>
                                <tr >
                                    <td>Nom</td>
                                    <td>Prénom</td>
                                    <td>email</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($admin as $a): ?>
                                    <tr>
                                        <td><?php echo $a['nom']; ?></td>
                                        <td><?php echo $a['prenom']; ?></td>
                                        <td><?php echo $a['email']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="card" style="margin-top:1rem;">
                    <div class="card-header">
                        <h2>Touts les clients</h2>
                        <form action="ajouterMenu.php" method="post">
                            <button type="submit" >Ajouter un Client <span class="las la-arrow-right"></span></button>

                        </form>
                        
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <thead>
                                <tr >
                                    <td>Nom</td>
                                    <td>Prenom</td>
                                    <td>Email</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($client as $a): ?>
                                    <tr>
                                        <td><?php echo $a['nom']; ?></td>
                                        <td><?php echo $a['prenom']; ?></td>
                                        <td><?php echo $a['email']; ?></td>
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