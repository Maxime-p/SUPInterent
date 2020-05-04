<?php

$error = [];
//========================================
//TESTS DES DIFFERENTES ERREURES POSSIBLES
//========================================

//FONCTIONS
function mincar($car, $nb){
    if (strlen($car)<$nb) {
        return false;
    }
    return true;
}

function verif_alpha($str){
    preg_match("([^A-Za-z\s])",$str,$result);
    if(!empty($result)){
        return false;
    }
    return true;
}

//Prenom
$champ = 'prenom';
if(isset($_POST[$champ])){
    $var = htmlspecialchars($_POST[$champ]);
    if ($var == "") {
        array_push($error, "Le champ Prénom est vide");
    }elseif(!mincar($var,2)){
        array_push($error, "Le champ Prénom doit contenir au moins 2 caractères");
    }elseif(!verif_alpha($var)){
        array_push($error, "Le champ Prénom doit contenir que des caractères alphabétique");
    }
}else{
    array_push($error, "Le champ Prénom est vide");
}

//Nom
$champ = 'nom';
if(isset($_POST[$champ])){
    $var = htmlspecialchars($_POST[$champ]);
    if ($var == "") {
        array_push($error, "Le champ Nom est vide");
    }elseif(!mincar($var,2)){
        array_push($error, "Le champ Nom doit contenir au moins 2 caractères");
    }elseif(!verif_alpha($var)){
        array_push($error, "Le champ Nom doit contenir que des caractères alphabétique");
    }
}else{
    array_push($error, "Le champ Nom est vide");
}

//Email
$champ = 'email';
if(isset($_POST[$champ])){
    $var = htmlspecialchars($_POST[$champ]);
    if ($var == "") {
        array_push($error, "Le champ Email est vide");
    }elseif(!filter_var($var, FILTER_VALIDATE_EMAIL)){
        array_push($error, "Le champ Email doit contenir un e-mail valide");
    }
}else{
    array_push($error, "Le champ Email est vide");
}

//Age
$champ = 'age';
if(isset($_POST[$champ])){
    $var = htmlspecialchars($_POST[$champ]);
    $options = array(
        'options' => array(
            'min_range' => 13,
            'max_range' => 160,
        )
    );
    if ($var == "") {
        array_push($error, "Le champ Age est vide");
        
    }elseif(!filter_var($var, FILTER_VALIDATE_INT, $options)){
        array_push($error, "Le champ Age doit être un entier compris entre 13 et 160");
    }
}else{
    array_push($error, "Le champ Age est vide");
}

//Bachelor
$champ = 'bachelor';
if(isset($_POST[$champ])){
    $var = htmlspecialchars(strtolower($_POST[$champ]));
    if ($var == "") {
        array_push($error, "Le champ Bachelor est vide");
    }elseif($var != "dev" && $var != "business" && $var != "design"){
        array_push($error, "Le champ Bachelor doit contenir \"dev\" ou \"business\" ou \"design\"");
    }
}else{
    array_push($error, "Le champ Bachelor est vide");
}

//Mot de passe
$champ = 'psw';
if(isset($_POST[$champ])){
    $var = htmlspecialchars($_POST[$champ]);
    if ($var == "") {
        array_push($error, "Le champ Mot de passe est vide");
    }elseif(!mincar($var,12)){
        array_push($error, "Le champ Mot de passe doit contenir au moins 12 caractères");
    }
}else{
    array_push($error, "Le champ Mot de passe est vide");
}

//Mot de passe 2
$champ = 'psw2';
if(isset($_POST[$champ])){
    $var = htmlspecialchars($_POST[$champ]);
    if ($var == "") {
        array_push($error, "Le champ Retapez le mot de passe est vide");
    }elseif(!mincar($var,12)){
        array_push($error, "Le champ Retapez le mot de passe doit contenir au moins 12 caractères");
    }elseif ($var != htmlspecialchars($_POST['psw'])) {
        array_push($error, "Le champ Retapez le mot de passe doit correspondre à l'autre champ Mot de passe");
    }
}else{
    array_push($error, "Le champ Retapez le mot de passe est vide");
}

//Sexe
$champ = 'gender';
if(!isset($_POST[$champ]) || htmlspecialchars($_POST[$champ]) == ""){
    array_push($error, "Veuillez selectionner votre sexe");
    
}elseif(htmlspecialchars($_POST[$champ]) != "Femme" && htmlspecialchars($_POST[$champ]) != "Homme" ){
    array_push($error, "Le champ Sexe doit être \"Femme\" ou \"Homme\"");
}

//Tome
$champ = 'tome';
$tome = ["Le Guide du voyageur galactique","Le Dernier restaurant avant la fin du monde","La Vie, L'Univers et le Reste", "Salut, et encore merci poisson", "Globalement inoffensive"];
$temp = [];
for ($i=0; $i < 6; $i++) { 
    if (isset($_POST[$champ][$i]) && htmlspecialchars($_POST[$champ][$i]) == $tome[$i]) {
        array_push($temp, $tome[$i]);
    }
}
if(count($temp) == 0){
    array_push($error, "Veuillez selectionnez au moins un tome");
}

//Commentaire
$champ = 'ta';
if(isset($_POST[$champ])){
    $var = htmlspecialchars($_POST[$champ]);
    if ($var == "") {
        array_push($error, "Le champ Commentaire est vide");
    }elseif($var != "&lt;b&gt;si ce texte s'affiche en gras, u lost the game&lt;/b&gt;"){
        array_push($error, "Le champ Commentaire ne doit pas être modifié");
    }
}else{
    array_push($error, "Le champ Commentaire est vide");
}

//===================================================================
//GESTION DE L'AFFICHAGE EN FONCTION DE LA PRESENCE D'ERREURES OU NON
//===================================================================

if (count($error) == 0) {

    $q = ["Prénom", "Nom", "E-Mail", "Age", "Bachelor", "Mot de passe", "Mot de passe vérifé", "Sexe", "Tome(s) favoris de H2G2", "Commentaire"];
    $data = [];
    foreach ($_POST as $key => $value) {
        if (gettype($value) != "array") {
            $data[$key] = htmlspecialchars($value);
        }else {
            $data[$key] = $value;
        }
    }
    ?>

    <table border="1">
        <?php
        $c = 0;
        foreach ($data as $value) {
        ?>
            <tr>
                <td style="font-weigth: bold;"><?=$q[$c++];?></td>
                <td><?php
                if (gettype($value) != "array") {
                    echo $value;
                }else{
                    for ($i=0; $i < count($value); $i++) { 
                        echo $value[$i];
                        if ($i != count($value)-1) {
                            echo ', ';
                        }
                    }
                }
                ?></td>
            </tr>
        <?php
        }
        ?>
    </table>

<?php
}else{
?>
<ul>
    <?php foreach ($error as $e) {
        echo '<li>'.$e.'</li>';
    }
    ?>
</ul>
<img src="https://risibank.fr/cache/stickers/d311/31114-full.jpg" alt="Un vieux qui donne le conseil suivant, fuyez pauvres fous">
<?php
}
?>