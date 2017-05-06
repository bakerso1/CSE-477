<?php
require 'lib/game.inc.php';
$controller = new Wumpus\WumpusController($wumpus, $_REQUEST);
if($controller->isReset()) {
    unset($_SESSION[WUMPUS_SESSION]);
}

if($controller->isCheat()){
    $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus(1422668587);
}
if($controller->getPage()=="welcome.php"){
    unset($_SESSION[WUMPUS_SESSION]);  //If the page is the welcome page.. that means the game is new game. Therefor unset session.
}
header('Location: ' . $controller->getPage());