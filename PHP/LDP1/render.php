<?php
$note = intval($_GET['note']);
$triche = htmlspecialchars($_GET['triche']);
$rendu = htmlspecialchars($_GET['rendu']);

if($rendu != "oui"){
    echo "Votre n'avez pas rendu de devoir";
}else{
    switch ($note){
        case 0:
            echo "Aucun effort";
            break;
        case 5:
            echo "A essayé";
            break;
        case 7:
            echo "C'est mieux que 5";
            break;
        case 10:
            echo "Pile poil la moyenne";
            break;
        case 12:
            echo "Assez bien";
            break;
        case 14:
            echo "Bien";
            break;
        case 16:
            if($triche == "oui"){
                echo "Triche.";
            }else{
                echo "Très bien";
            }
            break;
        case 20:
            if($triche == "oui"){
                echo "Triche excellente." ;
            }else{
                echo "Excellent ";
            }
            break;
    }
}
?>