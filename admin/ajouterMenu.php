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

//menuCateg
$menuQuery = $db->prepare("SELECT DISTINCT ctg FROM menu ");
$menuQuery->execute();
$menu=$menuQuery->fetchAll();

if(isset($_POST['submit'])){
    $ctg=$_POST['ctg'];
    $nom=$_POST['nom'];
    $description=$_POST['description'];
    $prix=$_POST['prix'];
    $insert_menu = $db->prepare("INSERT INTO menu (ctg,nom,description,prix) VALUES ('$ctg','$nom','$description',$prix)");
    $insert_menu->execute();
    echo " <script>alert('ajoute terminé avec succés')</script> ";
    echo " <script> window.location='menuAdmin.php' </script>";
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

    <title>Add item</title>
    <style>
        form div{
            margin: 1rem 0;
        }
        select{
            margin-left: .9rem;
            color: #dd2f6e;
            padding: 0 8px;
        }
        option{
            text-align: center;
            
        }
        select:focus-visible{
            outline: none;
        }
        .nom input{
            margin-left: 4rem;
        }
        .desc input{
            margin-left: 11px;
            width: 38%;
        }
        
        .prix input {
            margin-left: 4.7rem;
        }

        .nom input,
        .desc input,
        .prix input,
        .add-cat form input {
            padding-left: 7px;
            padding-bottom: 2px;
            border: none;
            border-bottom: 1px solid #dd2f6e;
            transition: all .3s ease-in-out;
        }
        .nom input:hover,
        .desc input:hover,
        .prix input:hover,
        .add-cat form input:hover{
            padding: 0px 21px;
        }
        .nom input:focus-visible,
        .desc input:focus-visible,
        .prix input:focus-visible,
        .add-cat form input:focus-visible{
            outline: none;
            color: #dd2f6e;
        }

        form button{
            background: var(--main-color);
            border-radius: 4px;
            color: #fff;
            font-size: .8rem;
            padding: .5rem 1rem;
            margin-top: 4px;
            border: 1px solid var(--main-color) ;
            cursor: pointer;
            transition: all .4s linear;
        }
        form button:hover{
            padding: .5rem 2rem;
            border-radius: 10px;
        }
        .left{
            width: 60%;
            border-right: 1px solid #f0f0f0;
        }
        .right{
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .add-cat form{
            display: flex;
            flex-direction: column;
            
        }
        .add-cat form h1{
            font-size: 22px;
        }
        .add-cat form input{
            margin: 15px 0;
            padding: 4px 0px;
        }
        .add-cat form input:hover{
            margin: 15px 0;
            padding: 4px 37px;
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
                        <h2>Add to menu</h2>
                    </div>
                    <div class="card-body" style="display: flex;">
                        <div class="left">

                        
                        <form method="POST">
                            <div class="categorie">
                                <label for="ctg">Choisissez la catégorie:</label>
                                <select name="ctg" id="ctg">
                                    <option value="">--Choisissez une option--</option>

                                <?php foreach($menu as $m): ?>
                                    <option value="<?php echo $m['ctg'];?>"><?php echo $m['ctg'];?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="nom">
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom" placeholder="Nom du produit..">
                            </div>
                            <div class="desc">
                                <label for="desc">Description</label>
                                <input type="text" id="desc" name="description" placeholder="Description du produit..">
                            </div>
                            <div class="prix">
                                <label for="prix">Prix</label>
                                <input type="number" id="prix" name="prix" min="350" max="900" placeholder="Prix">
                            </div>
                            
                            <button type="submit" name="submit">Ajouter</button>
                        </form>
                        </div>
                        <div class="right">
                            <div class="add-cat">
                                <form action="./ajouterMenu.php" method="post">
                                <h1 >Ajouter une autre catégorie</h1>
                                <input type="text" name="add-cat" placeholder="Nom du catégorie..">
                                <button type="submit" name="submit2" style="width: 8rem;" >Ajouter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  
  
        </main>
    </div>

</body>
</html>