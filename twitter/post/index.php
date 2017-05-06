<?php
require '../lib/site.inc.php';

$control = new Twitter\Control($_SESSION, $_POST);
header("location: " . $control->getRedirect());