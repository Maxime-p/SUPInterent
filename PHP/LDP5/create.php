<?php
$host='localhost';
$dbname='cinema';
$user='root';
$pass='';

$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
$error = []; //Stocker les erreures et leurs messages
$succes = false; //Permet de savoir si le film a été créé
if (isset($_POST['submit'])) {

    $elements = [];

    $list = [
        ['title', 'Title', 'htmlspecialchars'],
        ['resum', 'Resum', 'htmlspecialchars'],
        ['genre', 'Genre', 'htmlspecialchars'],
        ['dshow', 'Start showing', 'htmlspecialchars'],
        ['fshow', 'End Showing', 'htmlspecialchars'],
        ['duration', 'Duration', 'intval'],
        ['yearprog', 'Prod year', 'intval']
    ];

    foreach ($list as $elem) {
        $value = $elem[2]($_POST[$elem[0]]);
        $name = $elem[1];
        if(!isset($value) || $value == ''){
            array_push($error, 'Le champ '.$name.' est vide');
        }
        $elements[$elem[0]] = $value;
    }
    if(htmlspecialchars($_POST['distribut'])){
        $elements['distribut'] = $_POST['distribut'];
        if ($_POST['distribut'] == "NULL") {
            $elements['distribut'] = NULL;
        }
    }


    if (strtotime($elements['dshow']) && strtotime($elements['fshow'])) {
        if (strtotime($elements['dshow']) > strtotime($elements['fshow'])) {
            array_push($error, 'La date de fin doit est plus récente que la de de début');
        }
    }else {
        array_push($error, 'Format de date non valide');
    }

    if ($elements['duration'] != '' && $elements['duration'] < 0) {
        array_push($error, 'La durée doit etre positive');
    }

    if ($elements['yearprog'] != '' && $elements['yearprog'] < 0) {
        array_push($error, 'L\'année doit etre positive');
    }
    
    if (empty($error)) {
        try {
            $rq = $bdd->prepare('INSERT INTO films (id_genre, id_distributeur, titre, resum, date_debut_affiche, date_fin_affiche, duree_minutes, annee_production) VALUES (:id_genre, :id_distributeur, :titre, :resum, :date_debut_affiche, :date_fin_affiche, :duree_minutes, :annee_production)');
            $rq->execute(array(
                'id_genre' => $elements['genre'],
                'id_distributeur' => $elements['distribut'],
                'titre' => $elements['title'], 
                'resum' => $elements['resum'], 
                'date_debut_affiche' => $elements['dshow'], 
                'date_fin_affiche' => $elements['fshow'], 
                'duree_minutes' => $elements['duration'], 
                'annee_production' => $elements['yearprog']
            ));
            $succes = true;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Create a new movie</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <h1>Create a new movie</h1>
    <form method="POST">
        Title : 
        <input type="text" name="title"><br>
        Resum : <br>
        <textarea name="resum" id="" cols="30" rows="10"></textarea><br>
        Genre : 
        <select name="genre">
            <option value="">-- unspecified --</option>
            <?php
                $rq = $bdd->query('SELECT * FROM genres');
                $result = $rq->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $value) {
                    echo '<option value="'.$value['id_genre'].'">'.$value['nom'].'</option>';
                }
            ?>
        </select><br>
        Distribut : 
        <select name="distribut">
            <option value="NULL">-- unspecified --</option>
        <?php
                $rq = $bdd->query('SELECT * FROM distributeurs');
                $result = $rq->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $value) {
                    echo '<option value="'.$value['id_distributeur'].'">'.$value['nom'].'</option>';
                }
            ?>
        </select><br>
        Start showing : 
        <input type="date" name="dshow"><br>
        End Showing : 
        <input type="date" name="fshow"><br>
        Duration (in minutes): 
        <input type="number" name="duration"><br>
        Prod year : 
        <input type="number" name="yearprog"><br>

        <ul>
        <?php
            foreach ($error as $value) {
                echo '<li>'.$value.'</li>';
            }
        ?>
        </ul>
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php if($succes){ ?>
    <h3>Successfully created</h3>
    <?php }?>
</body>
</html>