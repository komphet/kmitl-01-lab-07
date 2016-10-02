<?php

function __autoload($class)
{
    $parts = str_replace("\\", "/",$class);
    require $parts . '.php';
}

?>