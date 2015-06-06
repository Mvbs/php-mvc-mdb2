<?php
    spl_autoload_register(function ($class_name) {

        $caminhoClasses     = 'classes/';
        $classSufix         = '.class.php';
        $caminhoCompleto    = "{$caminhoClasses}{$class_name}{$classSufix}";
        include "{$caminhoCompleto}";
    });
?>
