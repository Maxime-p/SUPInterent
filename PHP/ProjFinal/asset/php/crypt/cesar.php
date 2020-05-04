<?php
function encrypt($msg, $key){
    $msg = str_split(strtolower($msg));
    $result = "";
    foreach ($msg as $value) {
        $result.=chr((ord($value)-97+$key)%26+97);
    }
    return $result;
}
function decrypt($msg, $key){
    $msg = str_split(strtolower($msg));
    $result = "";
    foreach ($msg as $value) {
        $result.=chr((ord($value)-97+$key+24)%26+97);
    }
    return $result;
}

if (!isset($_POST['type'])) {
    $result = encrypt($_POST['input'], $_POST['clef']);
}else {
    $result = decrypt($_POST['input'], $_POST['clef']);
}
?>