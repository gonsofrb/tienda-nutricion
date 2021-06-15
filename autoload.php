<?php

function controllers_autoload($classame) {
    include 'controllers/' . $classame . '.php';
}

spl_autoload_register('controllers_autoload');
?>