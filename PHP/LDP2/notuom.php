<?php

$tab0 = array('Goodbye', 'Dennis');
$tab1 = array('U', 'DUN', 'GOOFED');
$tab2 = array('name'=>'Glenn','first_name'=>'kenny','pets'=>'dusty','crime'=>'animal abuse','achievement'=>'goofed');
$tab3 = array('bananas', 'apple','fish'=>'sharktopus', 'lemon', 'pineapple', 'pear', 'cherry');
$tab4 = array('x-men', 'spiderman','great saiyaman','iron man','superman', 'batman','wolverine', 'hulk');

function onlyTheBest($tab){
    $max = '';
    foreach ($tab as $value) {
        if (strlen($value) > strlen($max)) {
            $max = $value;
        }
    }
    echo $max.'<br>';
}

onlyTheBest($tab0);
onlyTheBest($tab1);
onlyTheBest($tab2);
onlyTheBest($tab3);
onlyTheBest($tab4);
?>