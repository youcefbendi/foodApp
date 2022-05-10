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

//menu
$menuQuery = $db->prepare("SELECT * FROM menu ");
$menuQuery->execute();
$menu=$menuQuery->fetchAll();

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
        thead, tbody { display: block; }
        tbody {
    height: 346px;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
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
                <li><a href="./menuAdmin.php" class="active"><span class="las la-clipboard-list"></span> <span>Menu</span></a></li>
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
                    Menu
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
                        <h2>All Menu</h2>
                        <form action="ajouterMenu.php" method="post">
                            <button type="submit" >Ajouter <span class="las la-arrow-right"></span></button>

                        </form>
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <thead>
                                <tr >
                                    <td>Catégorie</td>
                                    <td style="padding-left: 2rem;">Nom</td>
                                    <td style="padding-left: 15rem;">Description</td>
                                    <td style="padding-left: 14.4rem;">Prix</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($menu as $m): ?>
                                <tr>
                                    <td><?php echo $m['ctg']; ?></td>
                                    <td><?php echo $m['nom']; ?></td>
                                    <td><?php echo $m['description']; ?></td>
                                    <td><?php echo $m['prix']; ?></td>
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