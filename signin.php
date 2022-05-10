<?php 
try
{
    $db = new PDO('mysql:host=localhost;dbname=foodapp;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

if( isset($_POST["nom"]) & isset($_POST["prenom"]) & isset($_POST["email"]) & isset($_POST["password"]) ){
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $email=$_POST["email"];
    $password=$_POST["password"];

    $insertUser= $db->prepare('INSERT INTO users(nom,prenom,email,mtp,isAdmin) VALUES (:nom,:prenom,:email,:mtp,:isAdmin)');
    $insertUser->execute([
        'nom'=>$nom,
        'prenom'=> $prenom,
        'email'=>$email,
        'mtp'=>$password,
        'isAdmin'=> 0
    ]);
    session_start();
    $_SESSION['auth']="true";
    header('location:index.php');
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Inscription</title>
</head>
<body>
    <div class="transparent2">
        <div class="signin">
            <h1>Inscription</h1>
            <form method="POST">
                <label for="nom">Nom:</label><br>
                <input type="text" id="nom" name="nom"><br>
                <label for="prenom">Prénom:</label><br>
                <input type="text" id="prenom" name="prenom"><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>
                <label for="pw">Password:</label><br>
                <input type="password" id="pw" name="password"><br>
                <input type="submit" value="Inscription">
            </form>
            <p>Vous avez un compte ?<a href="./login.php">Se connecter!</a></p>
        </div>
    </div>
</body>
</html>