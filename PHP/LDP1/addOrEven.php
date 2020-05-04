<?php
function addOrEven($data){
    if ($data%2 == 0) {
        echo "Odd";
    }else {
        echo "Even";
    }
}

addOrEven(2);
addOrEven(1975);
?>