<?php
require 'format.inc.php';
require 'lib/game.inc.php';
$view = new Wumpus\WumpusView($wumpus);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stalking The Wumpus</title>
<link rel="stylesheet" href="reset.css"/>
	<link rel="stylesheet" href="styling.css"/>
    
    
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>
    <div class="game">
        <figure><img src="wumpus/cave.jpg" height="300" width="500" alt="cave"></figure>

        <div class="description">
            <?php
            echo $view->presentStatus();
            ?>
        </div>
        <div class="rooms">
            <?php
            echo $view->presentRoom(0);
            echo $view->presentRoom(1);
            echo $view->presentRoom(2);
            ?>
        </div>
        <h2><?php echo $view->presentArrows(); ?></h2>
    </div>

</body>
</html>