<?php
require '../lib/site.inc.php';
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/26/2017
 * Time: 5:47 PM
 */

$controller = new Twitter\ComposeControl($_POST, $_SESSION);
header("location: " . $controller->getRedirect());