<?php
if ($_POST['yt'] == "") {
    echo "Vous n'avez séléctionné aucun youtubeur.";
}else {
    echo 'Vous avez selectionné '.$_POST['yt'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>LDP4</title>
    <meta charset="UTF-8">
</head>
<body>
    <form action="" method="POST">

    <select name="yt">
        <option value=""></option>
        <option value="Norman">Norman</option>
        <option value="jojo bernard">jojo bernard</option>
        <option value="Cyprien">Cyprien</option>
        <option value="Mister V">Mister V</option>
        <option value="Hugo Tout Seul">Hugo Tout Seul</option>
    </select>

        <input type="submit" name="submit">

    </form>
</body>
</html>