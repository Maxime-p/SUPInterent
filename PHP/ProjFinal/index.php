<?php
require('asset/php/cryptageinfo.php');

if (!empty($_POST)) {
    if ($_POST['process'] == "") {
        $message = ['danger', 'Le type de cryptage doit être spécifié'];
    }elseif (isset($_POST['generate'])) {
        $process = $_POST['process'];
        require('asset/php/generator.php');
    }elseif (empty($_POST['clef'])) {
        $message = ['danger', 'La clef de cryptage doit être spécifié'];
    }

    if (isset($cinfo[$_POST['process']])) {
        require('asset/php/crypt/'.$_POST['process'].'.php');
    }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>MXP Cryptage</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="asset/module/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    <nav class="navbar navbar-light bg-primary mb-5">
        <h1 style="margin: 5px auto; color: white;">MXP Cryptage</h1>
    </nav>
    <?php 
        require('asset/php/message.php');
        if (isset($message)) {
            message($message[1],$message[0]);
        }
    ?>
    <form action="" method="post">
    <div class="container">
        <div><textarea name="input" placeholder="Enter votre message à crypter ici"><?php if (isset($_POST['input'])) {echo $_POST['input'];} ?></textarea></div>
        <div class="params">
            <div class="tgs"><input type="checkbox" name="type" id="toggle" class="offscreen" <?php if (isset($_POST['type'])) {echo 'checked';} ?>/><label for="toggle" class="switch"></label></div>
            <select name="process" required>
                <option value="" <?php if(isset($_POST['process']) && $_POST['process'] == "") {echo 'selected';} ?>>-- Méthode de cryptage --</option>
                <?php foreach ($cinfo as $key => $value) {
                ?>
                <option value="<?=$key;?>" <?php if(isset($_POST['process']) && $_POST['process'] == $key) {echo 'selected';} ?>><?=$value;?></option>
                <?php
                } ?> 
            </select>
            <input type="text" name="clef" placeholder="Clef de cryptage" <?php if(isset($gkey)){echo "value='".$gkey."'";}?> >
            <button id="generate" class="btn btn btn-secondary" type="submit" name="generate"><i class="fas fa-random"></i> Génerer une clef</button>
            <button class="btn btn btn-info" type="submit"><i class="fas fa-cogs"></i> Traiter</button>
        </div>
        <div><textarea id="result" readonly="readonly"><?php if(!isset($result)){echo 'Le résultat sera affiché ici';}else{echo $result;}?></textarea></div>
    </div>
    </form>
    <script src="asset/js/script.js"></script>
    <script src="asset/module/swup.min.js"></script>
    <script src="https://kit.fontawesome.com/a660170305.js" crossorigin="anonymous"></script>
</body>
</html>