<html>
    <body>
        <form action="" method="post">
        <input type="checkbox" name="poney[]" value="Pinkie Pie"> Pinkie Pie<br>
        <input type="checkbox" name="poney[]" value="Rarity"> Rarity<br>
        <input type="checkbox" name="poney[]" value="Rainbow Dash"> Rainbow Dash<br>
        <input type="checkbox" name="poney[]" value="Applejack"> Applejack<br> 
        <input type="checkbox" name="poney[]" value="Princesse Celestia"> Princesse Celestia<br> 
        <input type="submit" value="Envoyer">
        </form>
    </body>
</html>

<?php

if (isset($_POST)) {
    if (isset($_POST['poney'])) {
        echo 'Vous avez séléctionné :<br>';
        $temp = "";
        foreach ($_POST['poney'] as $val) {
            echo $temp;
            $temp = ', ';
            echo $val;
        }
    }else{
        echo "Vous n'avez séléctionné aucun poney.";
    }
}

?>