<?php
function encrypt($msg){
    
}
function decrypt($msg){

}

if (!isset($_POST['type'])) {
    $result = encrypt($_GET['input']);
}else {
    $result = decrypt($_GET['input']);
}
?>