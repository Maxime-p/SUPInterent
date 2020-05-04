<?php
$host='localhost';
$dbname='cinema';
$user='root';
$pass='';

$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);

$reqs = ["SELECT * FROM films",
"SELECT id_film, titre, resum FROM films",
"SELECT titre, resum, date_debut_affiche FROM films ORDER BY titre",
"SELECT id_film, titre, resum FROM films LIMIT 10",
"SELECT titre, resum FROM films f INNER JOIN genres g ON f.id_genre = g.id_genre WHERE g.nom LIKE 'adventure'",
"SELECT titre AS titre_film, resum AS resum_film FROM films WHERE titre LIKE '%28%'",
"SELECT titre, resum FROM films WHERE id_film IN (4,8,15,16,23,42)",
"SELECT sum(places) AS 'places' FROM salles",
"SELECT date_debut_affiche, CONCAT('nouveauté ', titre) AS 'titre film' FROM films WHERE date_debut_affiche >= '2011-11-16' ORDER BY id_film desc",
"SELECT * FROM films WHERE date_debut_affiche < '1995-03-25' ORDER BY date_debut_affiche LIMIT 10,10",
"SELECT etage_salle AS 'num etage', places AS 'nbr place' FROM salles WHERE places > 100 AND (etage_salle BETWEEN 1 AND 3) ORDER BY etage_salle desc"];

?>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<?php
foreach ($reqs as $req) {
    echo '<table>';
    $rq = $bdd->query($req);
    $resultat = $rq->fetchAll(PDO::FETCH_ASSOC);
    $n = 0;
    foreach ($resultat as $elem) {
        if($n == 0){
            echo '<tr>';
            foreach ($elem as $key => $value) {
                echo '<th>'.$key.'</th>';
            }
            echo '</tr>';
        }

        echo '<tr>';
        foreach ($elem as $key => $value) {
            echo '<td>'.$value.'</td>';
        }
        echo '</td>';
        $n++;
    }
    echo '</table><br><br>';
}
?>