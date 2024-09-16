<?php
require_once __DIR__.'/src/code/app.php';

App::checkIsHttps();

$view = 'main';

App::isLogged() ?: $view = 'login';

$viewURL = __DIR__.'/src/views/'.$view.'Page.php';

file_exists($viewURL) ?: $viewURL = __DIR__.'/src/views/404Page.php';

require_once $viewURL;

?>