<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/25/2017
 * Time: 6:37 PM
 */

namespace Twitter;


class Control
{
    private $redirect;

    public function __construct(&$session, $p) {
        $result = $p['tweeter'];
        if($result === "" || $result === null){
            $this->redirect = "../";
        }
        else{
            $session['tweetValue'] = $result;
            $this->redirect = "../compose.php";
            if(isset($session['respones'])){
                unset($session['respones']);
            }
            if(isset($session['stockResp'])){
                unset($session['stockResp']);
            }
        }
    }

    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

}