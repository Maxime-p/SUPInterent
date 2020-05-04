<html>
    <body>
        <form action="" method="post">
            <input type="radio" name="tortue" value="Leonardo"> Leonardo<br>
            <input type="radio" name="tortue" value="Donatelle"> Donatelle<br>
            <input type="radio" name="tortue" value="Michelangelo"> Michelangelo <br>
            <input type="radio" name="tortue" value="Raphael"> Raphael <br>
            <input type="radio" name="tortue" value="Hamato"> Hamato<br>
            <input type="submit" value="Envoyer">
        </form>
    </body>
</html>

<?php

if (isset($_POST)) {
    if ($_POST['tortue'] != "") {
        echo 'Vous avez séléctionné : '.$_POST['tortue'];
    }else{
        echo "Vous n'avez séléctionné aucune tortue.";
    }
}

?>