<?php

use core\Controller;

require '../bootstrap.php';

try {
    $controller = new Controller();
    $controller = $controller->load();
    dd($controller);
} catch (\Exception $e) {
    $e->getMessage();
}
