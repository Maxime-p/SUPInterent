<?php
function myEcho($data){
    $result = "";
    for ($i=0; $i < strlen($data); $i++) { 
        $letter = substr($data, $i, 1);
        if($letter != ' '){
            $result = $result.$letter;
        }else{
            $result = $result."<br>";
        }
    }
    echo $result;
}

myEcho("I CALL THE CYBER POLICE");
?>