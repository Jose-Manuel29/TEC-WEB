<?php
    use TECWEB\MYAPI\create;
    require_once __DIR__.'/myapi/Products.php';

    $productos = new Products('marketzone');
    $productos->add( json_decode( json_encode($_POST) ) );
    echo $productos->getData();
?>