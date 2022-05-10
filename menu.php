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
?>

<?php 
//liste des pizza
$pizzaQuery = $db->prepare("SELECT * FROM menu WHERE ctg='pizza'");
$pizzaQuery->execute();
$pizza=$pizzaQuery->fetchAll();
//liste des burgers
$burgerQuery = $db->prepare("SELECT * FROM menu WHERE ctg='burger'");
$burgerQuery->execute();
$burger=$burgerQuery->fetchAll();
//liste des tacos
$tacosQuery = $db->prepare("SELECT * FROM menu WHERE ctg='tacos'");
$tacosQuery->execute();
$tacos=$tacosQuery->fetchAll();

//ajouter un menu dans la carte
if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $item_array_id=array_column($_SESSION['cart'],'menu_id');
        if(in_array($_POST['menu_id'],$item_array_id)){
            echo "<script>alert('product is already added in the cart')</script>";
            echo " <script>window.location='menu.php'</script>";
        }else{
            $count=count($_SESSION['cart']);
            $item=array('menu_id'=>$_POST['menu_id']);
            $_SESSION['cart'][$count]=$item;

        }
    
    }else{
        $item=array('menu_id'=>$_POST['menu_id']);
        $_SESSION['cart'][0]= $item;
        
    }
}


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://kit.fontawesome.com/f2d7819c83.js" crossorigin="anonymous"></script>

    <title>Menu</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="row justify-content-between">
                <div class="logo"><a href="index.html" class="logo">Food</a></div>
                <nav class="nav">
                        <ul>
                            <li><a href="./index.php" class="outer-shadow hover-in-shadow" onclick="changeActive()">home</a></li>
                            <li><a href="./menu.php" class="inner-shadow active" onclick="changeActive()">menu</a></li>
                            <li><a href="./cart.php" class="outer-shadow hover-in-shadow" onclick="changeActive()">cart</a></li>
                            <li><a href="#" class="outer-shadow hover-in-shadow" onclick="changeActive()">contact us</a></li>

                        </ul>
                </nav>
                <div class="logout">
                <p>Bonjour <?php echo $_SESSION['prenom']; ?> </p>
                    <a href="./cart.php"><i class="fa-solid fa-cart-plus"></i>
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
    <div class="menu">
        <h2 class="pizza-categ">nos pizza</h2>
        <div class="flickity" data-flickity>
            <?php foreach($pizza as $p){
                component($p['nom'],$p['description'],$p['prix'],$p['menu_id']);
                }
            ?>
        </div>

        <h2 class="burgers-categ">nos burgers</h2>
        <div class="flickity" data-flickity>
            <?php foreach($burger as $b){
                component($b['nom'],$b['description'],$b['prix'],$b['menu_id']);
                }
        
            ?>
        </div>
        <h2 class="boiss-categ">nos tacos</h2>
        <div class="flickity" data-flickity>
        
            <?php foreach($tacos as $t){
                component($t['nom'],$t['description'],$t['prix'],$t['menu_id']);
                }
        
            ?>
        </div>
    </div>



</body>

</html>