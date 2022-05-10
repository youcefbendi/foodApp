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

require_once("./component.php");

//list of menu
$menuQuery = $db->prepare("SELECT * FROM menu ");
$menuQuery->execute();
$menu=$menuQuery->fetchAll();

//remove button
if(isset($_POST['remove'])){
    print_r($_GET['id']);
    if($_GET['action']=='remove'){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['menu_id']==$_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo " <script>alert('product has been removed!!')</script> ";
                echo " <script> window.location='cart.php' </script>";
            }
        }
    }
}

//insert commande in database 
$all_commande=array();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/f2d7819c83.js" crossorigin="anonymous"></script>
    <title>Oders</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="row justify-content-between">
                <div class="logo"><a href="index.html" class="logo">Food</a></div>
                <nav class="nav">
                        <ul>
                            <li><a href="./index.php" class="outer-shadow hover-in-shadow" onclick="changeActive()">home</a></li>
                            <li><a href="./menu.php" class="outer-shadow hover-in-shadow" onclick="changeActive()">menu</a></li>
                            <li><a href="./cart.php" class="inner-shadow active" onclick="changeActive()">cart</a></li>
                            <li><a href="#" class="outer-shadow hover-in-shadow" onclick="changeActive()">contact us</a></li>

                        </ul>
                </nav>
                <div class="logout">
                <p>Bonjour <?php echo $_SESSION['prenom']; ?></p>
                    <a href="#"><i class="fa-solid fa-cart-plus"></i>
                    <?php 
                    if(isset($_SESSION['cart'])){
                        $count=count($_SESSION['cart']);
                        echo "<span> $count</span>";
                    }else{
                        echo "<span> 0</span>";
                    }
                    ?>
                    </a>
                    <a href="./logout.php" ><i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
                
            </div>
        </div>
    </header> 

    <main>
        <div class="items">
        <?php
        $total=0;
        if(isset($_SESSION['cart'])){
            $menu_id=array_column($_SESSION['cart'],'menu_id');
            
            foreach($menu as $m){
                foreach($menu_id as $id){
                    if($m['menu_id'] == $id){
                        
                        
                        
                        $qte=cartElement($m['nom'],$m['description'],$m['prix'],$m['menu_id']);
                        $total=$total+(int)$m['prix'];
                        $commande=array(
                        "menu_id" => $m['menu_id'],
                        "nom" => $m['nom'],
                        "prix" => $m['prix']);
                        array_push($all_commande,$commande);
                    }
                }
            }
        }else {
            echo '<div style="width: 60%;
                height: 22rem;
                display: flex;
                justify-content: center;align-items: center;background-color: #fff;
                border: 1px solid var(--skin-color);
                border-radius: 13px;
                margin-top: 2.5rem;">
                    <h1>Votre carte est vide !</h1>
                </div>';
        }
           
        ?>
            
        </div>



        <div class="detail_price">
            <div class="title">
                <h2>Details du prix:</h2>
            </div>
            <div class="details">
                <div class="details_title">
                    <?php if(isset($_SESSION['cart'])){
                        $count=count($_SESSION['cart']);
                        echo "<h5>Prix ($count elements):  </h5>";
                    }else{
                        echo "<h5>Prix (0 elements):  </h5>";
                    } ?>
                    
                    <h5>Livraison: </h5>
                </div>
                <div class="details_value">
                    <h5 id="prix"><?php echo $total; ?> DA</h5>
                    <h5 id="livraison">free</h5>
                </div>  
            </div>
            <div class="total">
                <h5>Total : </h5>
                <h5 id="prix_total"><?php echo $total; ?> DA</h5>
            </div>
            <form action="cart.php" class="valider_commande" method="post">
                <button type="submit" name="valider">Valider</button>
            </form>
            <?php 

            //valider le formulaire
            if(isset($_POST['valider'])){
    
                $user_id= $_SESSION['user_id'];
                
                $insert_commande = $db->prepare("INSERT INTO commande (user_id,prix_total) VALUES ($user_id,$total)");
                $insert_commande->execute();

                $commande_id = $db->lastInsertId();
                
                foreach ($all_commande as $commande){
                    $nom=$commande['nom'];
                    $prix=$commande['prix'];
                    $insert_details = $db->prepare("INSERT INTO commande_details (commande_id,nom,prix) VALUES ($commande_id,'$nom',$prix)");
                    $insert_details->execute();
                    
                    
                     
                }
                unset($_SESSION['cart']);
                echo " <script>alert('commande valider')</script> ";
                echo " <script> window.location='index.php' </script>";
                
            }
            ?>
        </div>
    </main>
</body>
</html>