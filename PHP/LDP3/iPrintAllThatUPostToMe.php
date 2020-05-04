<html>
    <body>
        <form action="" method="post">
            <input type="text" name="text"><br>
            <input type="password" name="psw"><br>
            <input type="hidden" name="hid" value="I'm hide forever"><br>
            <input type="submit" value="Envoyer">
        </form>
    </body>
</html>

<?php
if (isset($_POST)) {
    foreach ($_POST as $key => $value) {
        if (strlen($value) > 7) {
            $value = substr($value, 0, 8);
            $value = substr_replace($value, "...", -1);
        }
        echo $key.' => '.$value.'<br>';
    }   
}
?>