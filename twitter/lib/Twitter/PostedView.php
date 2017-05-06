<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/26/2017
 * Time: 7:57 PM
 */

namespace Twitter;


class PostedView
{

    private $finalResult;

    public function __construct(&$session)
    {
        if(isset($session['finalRes'])){
            $this->finalResult = $session['finalRes'];
        }
    }

    public function tweet(){
        $html = <<<HTML
<p>$this->finalResult</p>
HTML;
        return $html;
    }

}