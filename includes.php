<?php
date_default_timezone_set('Europe/Paris');

require_once 'smarty/libs/Smarty.class.php';

function chargerClass($classe)
{
    require 'classes/'.$classe.'.php';
}
spl_autoload_register('chargerClass');
?>