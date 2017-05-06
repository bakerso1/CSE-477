<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 2/14/2017
 * Time: 4:46 PM
 */

namespace Guessing;


class Guessing
{
    const MIN = 1;
    const MAX = 100;
    const INVALID = -1;
    const TOOHIGH = 2;
    const TOOLOW = 0;
    const CORRECT = 1;


    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
    }

    public function getNumGuesses() {
        return $this->numGuesses;
    }

    public function getNumber(){
        return $this->number;
    }

    public function guess($i){
        $this->guess = $i;
        if($this->check() != self::INVALID){
            $this->numGuesses+=1;
        }

    }

    public function getGuess(){
        return $this->guess;
    }

    public function check(){
        if($this->guess == -1){
            return -2;
        }
        if(!is_numeric($this->guess) || $this->guess > self::MAX || $this->guess < self::MIN){
            return self::INVALID;
        }
        elseif ($this->guess>$this->number){
            return self::TOOHIGH;
        }
        elseif($this->guess<$this->number){
            return self::TOOLOW;
        }
        elseif($this->guess == $this->number){
            return self::CORRECT;
        }
    }


    private $numGuesses =0;
    private $guess=-1;
    private $number;
}