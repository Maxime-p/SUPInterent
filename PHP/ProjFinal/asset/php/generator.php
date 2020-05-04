<?php
switch ($variable) {
    case array_keys($cinfo[0])://César
        $gkey = random_int(1,26);
        break;

    case array_keys($cinfo[1])://César
        $gkey = random_int(1,26);
        break;
        
    default:
        $message = ['danger', 'Le type de cryptage est inconnu/n\'est pas encore supporté'];
        break;
}

?>