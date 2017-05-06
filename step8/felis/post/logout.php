<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

$site = new \Felis\Site();
$root = $site->getRoot();