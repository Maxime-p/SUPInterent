<?php

$tab0 = array('Goodbye', 'Dennis');

$tab1 = array('U', 'DUN', 'GOOFED');

$tab2 = array('name'=>'Glenn','first_name'=>'kenny','pets'=>'dusty','crime'=>'animal abuse','achievement'=>'goofed');

$tab3 = array('bananas', 'apple','fish'=>'sharktopus', 'lemon', 'pineapple', 'pear', 'cherry');

$tab4 = array('x-men', 'spiderman','great saiyaman','iron man','superman', 'batman','wolverine', 'hulk');

function pilf($tab){
    $result = array();
    foreach ($tab as $key => $value) {
        $str = '';
        for ($i=0; $i <= strlen($value); $i++) {
            $str = $value[$i].$str;
        }
        $result = array_merge(array($key => $str),$result);
    }
    foreach ($result as $value) {
        echo $value.'<br>';
    }
}

pilf($tab0); echo '<br>';
pilf($tab1); echo '<br>';
pilf($tab2); echo '<br>';
pilf($tab3); echo '<br>';
pilf($tab4);
?>