<?php

// Register component on container
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('app/views/');
};

?>
