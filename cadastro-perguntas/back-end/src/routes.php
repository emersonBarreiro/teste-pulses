<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require 'routes/dimensoes.php';
require 'routes/perguntas.php';

return function (App $app) {
    $container = $app->getContainer();

};
