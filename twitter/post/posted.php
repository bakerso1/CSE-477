<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/26/2017
 * Time: 8:02 PM
 */

require '../lib/site.inc.php';
$control = new Twitter\PostedControl($_POST);
header("location: " . $control->getRedirect());