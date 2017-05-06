<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/26/2017
 * Time: 5:48 PM
 */

namespace Twitter;


class ComposeControl
{

    private $redirect;

    private $ses;

    private $allResp = [
        "We'll send you a new one right away.",
        "Cabbage rules.",
        "Say hello to my little friend.",
        "That's really grating.",
        "What does a cabbage outlaw have? A price on his head.",
        "I was not born in a cabbage patch.",
        "I was born in a cabbage patch.",
        "LMFAO",
        "Green rules!",
        "I'm sorry about that.",
        "We're on it.",
        "Please call customer service directly.",
        "Did you try plugging it in?",
        "Sorry you hate cabbage.",
        "Not everyone has good taste.",
        "I think you are an idiot"
    ];

    public function __construct($post, &$session)
    {

        if(isset($post['add'])){
            $tempCounter = count($this->allResp);
            for ($i = 0; $i < $tempCounter; $i++){
                if($i==$post['add']){
                    unset($session['stockResp'][$i]);
                    echo $post['add'];
                    array_push($session['respones'], $this->allResp[$i]);
                    $this->redirect = "../compose.php";
                }
            }
            $this->redirect = "../compose.php";
        }
        else{
            $this->redirect = "../compose.php";
        }

        if(isset($post['addmanual'])){
            array_push($_SESSION['respones'], $post['manual']);
        }


        if(isset($post['delete'])){
            array_push($_SESSION['stockResp'], $_SESSION['respones'][$post['delete']]);
            unset($_SESSION['respones'][$post['delete']]);
            $this->redirect = "../compose.php";
        }

        if(isset($post['post'])){
            $this->redirect = "../posted.php";
        }
        if(isset($post['cancel'])){
            $this->redirect = "../";
        }
    }
    public function getRedirect(){
        return $this->redirect;
    }

}