<?php
require 'format.inc.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Wumpus Killed You</title>
    <link rel="stylesheet" href="reset.css"/>
    <link rel="stylesheet" href="styling.css"/>
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>
<div class="lost">
    <figure><img id="wins" src="wumpus/wumpus-wins.jpg" height="400" width="600" alt="Wumpus the cat eating brain"></figure>
    <h2>You died and the Wumpus ate your brain!</h2>
    <h2><a href="http://webdev.cse.msu.edu/~bhushanj/step3/game.php">New Game</a></h2>
</div>
</body>
</html>