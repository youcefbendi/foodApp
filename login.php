<?php 
//connection avec database
try
{
    $db = new PDO('mysql:host=localhost;dbname=foodapp;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

//connexion post
if($_POST){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    
    $query = $db->prepare("SELECT * FROM users WHERE email='$email' AND mtp='$password'");
    $query->execute();
    $user=$query->fetchAll();
    
    
    if(count($user)){
        session_start();
        foreach($user as $us){
            $_SESSION['nom']=$us["nom"];
            $_SESSION['prenom']=$us["prenom"];
            $_SESSION['user_id']=$us["user_id"];
        }
        $_SESSION['auth']="true";
        
        if($user[0]["isAdmin"]==0){
            header('location:index.php');
        }else{
            header('location:./admin/admin.php');
        }
        

    }else {
        echo 'wrong password or email';
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
    
    <title>Connexion</title>
</head>
<body>
	<div class="transparent" >
        <div class="login">
            <h1>Connexion</h1>
            <form method="POST">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>
                <label for="pw">Password:</label><br>
                <input type="password" id="pw" name="password"><br>
                <input type="submit" value="Connexion">
            </form>
            <p>Vous n'avez pas un compte ?<br><a href="./signin.php" >Inscrivez-vous!</a></p>
        </div>
    </div>
</body>
</html>