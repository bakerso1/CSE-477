<?php
require 'format.inc.php';
require 'wumpus.inc.php';

$room = 1; // The room we are in.
$birds = 7;  // Room with the birds
$pits = array(3, 10, 13);    // Rooms with a bottomless pit
$wumpus = 16;
$arrow=0;

$cave = cave_array(); // Get the cave

if(isset($_GET['r']) && isset($cave[$_GET['r']]) ) {
    // We have been passed a room number
    $room = $_GET['r'];
}

if(isset($_GET['a']) && isset($cave[$_GET['a']]) ) {
    // We have been passed a room number
    $arrow=$_GET['a'];
}

if($arrow==$wumpus){
    header("Location: win.php");
    exit;
}

if($room == $birds){
    header("Location: game.php?r=10");
}

if(in_array($room,$pits)){
    header("Location: lose.php");
    exit;
}
if($room==$wumpus){
    header("Location: lose.php");
    exit;
}



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
        <div class="number">
            <h2>You are in room <?php echo $room; ?></h2>
        </div>
        <div class="description">
            <?php
            if($cave[$room][0]==$birds||$cave[$room][1]==$birds||$cave[$room][2]==$birds){
                echo "<h2>You hear birds!</h2>";
            }
            else {
                echo "<h2>&nbsp;</h2>";
            }
            ?>

            <?php
            if(in_array($cave[$room][0],$pits)||in_array($cave[$room][1],$pits)||in_array($cave[$room][2],$pits)){
                echo "<h2>You feel a draft!</h2>";
            }
            else {
                echo "<h2>&nbsp;</h2>";
            }
            ?>

            <?php
            if($cave[$room][0]==$wumpus||$cave[$room][1]==$wumpus||$cave[$room][2]==$wumpus){
                echo "<h2>You smell a wumpus!</h2>";
            }
            else{
                $flag=false;
                for($j=0;$j<=2;$j++){
                    for($i=0;$i<=2;$i++){
                        if($cave[$cave[$room][$i]][$j]==$wumpus){
                            $flag=true;
                        }
                    }
                }
                if($flag){
                    echo "<h2>You smell a wumpus!</h2>";
                }

            }
            ?>


        </div>
        <div class="rooms">
            <div class="room">
                <p><img src="wumpus/cave2.jpg" height="130" width="180" alt="cave"></p>
                <p><a href="game.php?r=<?php echo $cave[$room][0]; ?>"><?php echo $cave[$room][0]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][0];?>">Shoot Arrow</a></p>
            </div><div class="room">
                <p><img src="wumpus/cave2.jpg" height="130" width="180" alt="picture"></p>
                <p><a href="game.php?r=<?php echo $cave[$room][1]; ?>"><?php echo $cave[$room][1]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][1];?>">Shoot Arrow</a></p>
            </div><div class="room">
                <p><img src="wumpus/cave2.jpg" height="130" width="180" alt="picture"></p>
                <p><a href="game.php?r=<?php echo $cave[$room][2]; ?>"><?php echo $cave[$room][2]; ?></a></p>
                <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][2];?>">Shoot Arrow</a></p>
            </div>
        </div>
        <h2>You have 3 arrows remaining.</h2>
    </div>

</body>
</html>