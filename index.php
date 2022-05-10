
<?php
session_start();
try
{
    $db = new PDO('mysql:host=localhost;dbname=foodapp;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
<?php
$users = $db->prepare('SELECT * FROM users');
$users->execute();
$user=$users->fetchAll();

//inscription

//connexion 
// Validation du formulaire
if(!$_SESSION['auth']){
    header('location:login.php');
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/f2d7819c83.js" crossorigin="anonymous"></script>

    <title>Food App</title>
</head>
<body>
    
<header class="header">
        <div class="container">
            <div class="row justify-content-between">
                <div class="logo"><a href="index.html" class="logo">Food</a></div>
                <nav class="nav">
                        <ul>
                            <li><a href="./index.php" class="inner-shadow active" onclick="changeActive()">home</a></li>
                            <li><a href="./menu.php" class="outer-shadow hover-in-shadow" onclick="changeActive()">menu</a></li>
                            <li><a href="./cart.php" class="outer-shadow hover-in-shadow" onclick="changeActive()">cart</a></li>
                            <li><a href="#" class="outer-shadow hover-in-shadow" onclick="changeActive()">contact us</a></li>
                        </ul>
                </nav>
                <div class="logout">
                    <p>Bonjour <?php echo $_SESSION['prenom']; ?></p>
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
        
    <div class="section1">
        <div class="circle"></div>
        <div class="content">
            <div class="textBox">
                <h2>On a pas une simple recette <br> On a une recette trés  <span>Délicieuse</span></h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    Vero illo porro veniam possimus autem praesentium molestias maiores 
                    tempore quas ea, rerum ducimus illum nam corrupti, cumque, non sed doloribus alias!</p>
                <a href="./menu.php" >Savoir plus !</a>
            </div>
            <div class="imgBox">
                <img src="img/pizza.png" alt="photo" class="image">
            </div>
        </div>
        <ul class="stickers">
            <li><img src="img/burger.png" alt="Burger" onclick="imgSlider('img/burger.png')" ></li>
            <li><img src="img/pizza.png" alt="Burger" onclick="imgSlider('img/pizza.png')"  ></li>
            <li><img src="img/jus.png" alt="Burger" onclick="imgSlider('img/jus.png')" ></li>
        </ul>
    </div>
    
 

    

    <script type="text/javascript">
        function imgSlider(anything){
            document.querySelector('.image').src= anything;
        }  
    </script>
</body>
</html>