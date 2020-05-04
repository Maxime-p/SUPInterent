<?php
function addOrEven($data){
    if ($data%2 == 0) {
        echo "Odd";
    }else {
        echo "Even";
    }
}

if (isset($_GET['data'])) {
    addOrEven($_GET['data']);
}

?>