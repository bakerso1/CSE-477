<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 2/14/2017
 * Time: 9:31 PM
 */

namespace Guessing;

class GuessingController{

    public function __construct(Guessing $guess, $post) {
        $this->guessing = $guess;

        if (isset($post['clear'])){
            $this->reset = true;
        }
        elseif (isset($post['value'])){
            $this->guessing->guess(strip_tags($post['value']));
        }

    }

    public function guess($g){
        $this->guessing->guess($g);
    }

    public function isReset(){
        if($this->reset==false){
            return false;
        }
        return true;
    }

    private $reset = false;
    private $guessing;

}