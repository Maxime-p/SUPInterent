<?php
$host='localhost';
$dbname='cinema';
$user='root';
$pass='';

$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);

?><html>
    <head>
        <style>
            a{
                color: blue;
            }
            a:hover{
                color: blue;
            }
        </style>
<?php

if(isset($_GET['films'])){

    $rq = $bdd->prepare('SELECT *, g.nom AS g_name FROM films INNER JOIN genres g ON films.id_genre = g.id_genre INNER JOIN distributeurs d ON films.id_distributeur = d.id_distributeur WHERE id_film = :id');
    $rq->execute(array(
          'id' => intval($_GET['films'])
    ));
    $result = $rq->fetchAll(PDO::FETCH_ASSOC);

    $date = date("Y", strtotime($result[0]['date_debut_affiche']));
    echo '<title>'.$result[0]['titre'].'</title><meta name="description" content="'.$result[0]['titre'].','.$result[0]['g_name'].','.$result[0]['annee_production'].','.$result[0]['nom'].'"><meta name="keywords" content="">';
    echo '</head><body><a href="?distrib='.intval($result[0]['id_distributeur']).'">Back to DISTRIBUTEUR</a>';
    echo '<h2>'.$result[0]['titre'].'</h2>';
    echo '<p>'.$result[0]['resum'].'</p>';
    echo '<p>'.$result[0]['g_name'].'</p>';
    echo '<p>'.$result[0]['nom'].'</p>';
    echo '<p>'.$result[0]['annee_production'].'</p>';
    echo '<p>'.$date.'</p>';



}elseif (isset($_GET['distrib'])) {

    $rq = $bdd->prepare('SELECT * FROM `films` INNER JOIN genres g ON films.id_genre = g.id_genre WHERE id_distributeur = :distrib ORDER BY nom, date_debut_affiche');
    $rq->execute(array(
          'distrib' => intval($_GET['distrib'])
    ));
    $result = $rq->fetchAll(PDO::FETCH_ASSOC);
    echo '</head><body><a href="?">Back to Liste des DISTRIBUTEURS</a>';
    echo '<table>';
    $temp = '';
    foreach ($result as $ligne) {
        if($temp != $ligne['nom']){
            if ($temp != '') {
                echo '<tr><td>&nbsp;</td></tr>';
            }
            echo '<tr><td>'.$ligne['nom'].'</td></tr>';
            $temp = $ligne['nom'];
        }
        echo '<tr>';
        echo '<td>'.date("Y", strtotime($ligne['date_debut_affiche'])).'</td>';
        echo '<td><a href="?films='.$ligne['id_film'].'">'.$ligne['titre'].'</a></td>';
        echo '</tr>';
    }
    echo '</table>';

}else{
    $rq = $bdd->query('SELECT id_distributeur,nom FROM distributeurs');
    $result = $rq->fetchAll(PDO::FETCH_ASSOC);
    
    echo '</head><body><table>';
    foreach ($result as $ligne) {
        echo '<tr><td><a href="?distrib='.$ligne['id_distributeur'].'">'.$ligne['nom'].'</a></td></tr>';
    }
    echo '</table>';
}

?>
</body></html>