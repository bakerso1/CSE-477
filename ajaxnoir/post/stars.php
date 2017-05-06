<?php
require '../lib/site.inc.php';

$controller = new Noir\StarController($site, $user, $_POST);
echo $controller->getResult();