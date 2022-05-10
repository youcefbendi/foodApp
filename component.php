<?php

function component($nom,$description,$prix,$menu_id){
    $element="
    
        <div class=\"choix\">
            
            
                <div class=\"detail\">
                    <h2>$nom</h2>
                    <img src=\"img/food/$nom.png\" alt=\"photo\" class=\"image\"  >
                    <p>$description</p>
                </div>
                <div class=\"commande\">
                    <h2>$prix DA</h2>
                    <form method=\"POST\" action=\"menu.php\">
                    <input type=\"hidden\" name=\"menu_id\" value=\"$menu_id\">
                    <button type=\"submit\" name=\"add\" >Ajouter au panier</button>
                    </form>
                </div>
           
            
        </div>
    
    
    ";
    echo $element;
}

function cartElement($nom,$description,$prix,$menu_id){

    $qte=1;
    if(isset($_POST['plus'])){
        $qte=$qte + 1;
    }
    if(isset($_POST['moins'])){
        $qte=$qte - 1;
    }
    $element="
    <form action=\"cart.php?action=remove&id=$menu_id\" method=\"post\" class=\"item-card\">
            
    <div class=\"img-card\">
        <img src=\"img/food/$nom.png\" alt=\"img\">
    </div>
    <div class=\"info-card\">
        <h2>$nom</h2>
        <small>$description</small>
        <h4>$prix DA</h4>
        <button type=\"submit\" name=\"remove\">Remove</button>
    </div>
    <div class=\"qte-card\">
        <button type=\"submit\" name=\"plus\">+</button>
        <input type=\"text\" value=\"$qte\" class=\"qte-input\">
        <button type=\"button\" name=\"moins\">-</button>
    </div>
    </form>
    
    ";
    echo $element;
    return $qte;
}



?>

