<?php
function message($msg,$type){
?>
    <div class="alert alert-<?= $type; ?>" role="alert">
        <?= $msg; ?>
    </div>
<?php
}


?>