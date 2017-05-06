<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 2/7/2017
 * Time: 10:51 AM
 */

namespace Wumpus;


class WumpusView
{


    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     */
    public function __construct(Wumpus $wumpus) {
        $this->wumpus = $wumpus;
    }

    /** Generate the HTML for the number of arrows remaining */
    public function presentArrows() {
        $a = $this->wumpus->numArrows();
        return "<p>You have $a arrows remaining.</p>";
    }

    /** Present the links for a room
     * @param $ndx An index 0 to 2 for the three rooms */
    public function presentRoom($ndx) {
        $room = $this->wumpus->getCurrent()->getNeighbors()[$ndx];
        $roomnum = $room->getNum();
        $roomndx = $room->getNdx();
        $roomurl = "game-post.php?m=$roomndx";
        $shooturl = "game-post.php?s=$roomndx";

        $html = <<<HTML
<div class="room">
  <figure><img src="wumpus/cave2.jpg" width="180" height="135" alt=""/></figure>
  <p><a href="$roomurl">$roomnum</a></p>
<p><a href="$shooturl">Shoot Arrow</a></p>
</div>
HTML;

        return $html;
    }

    public function presentStatus(){
        $bird = "";
        $wumpus = "";
        $draft = "";
        $room = $this->wumpus->getCurrent()->getNum();
        if($this->wumpus->hearBirds()){
            $bird = "You hear birds!";
        }
        if($this->wumpus->smellWumpus()){
            $wumpus = "You smell a wumpus!";
        }
        if($this->wumpus->feelDraft()){
            $draft = "You feel a draft!";
        }

        $carry = $this->wumpus->wasCarried();
        $carried = "";
        if($carry){
            $carried = "You were carried by the birds to room ";
        }

        return "<h2> You are in room $room </h2> <h2>$bird</h2> <h2>$wumpus</h2> <h2>$draft</h2> <h2>$carried</h2>";
    }

    private $wumpus;    // The Wumpus object
}
