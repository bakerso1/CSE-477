<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/26/2017
 * Time: 2:25 PM
 */

namespace Twitter;


class ComposeView
{
    private $value;
    private $ses;
    private $finalResult;
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

    public function __construct(&$session)
    {
        if(isset($session['stockResp'])){

        }else{
            $tempCounter=0;
            //foreach ($this->allResp as $val){
              //  $session['stockResp'][$i] = $this->allResp[$i];
            //}
            for($i=0; $i<=15; $i++){
                $session['stockResp'][$i] = $this->allResp[$i];
            }
            //$session['stockResp'] = $this->allResp;
        }

        if(isset($session['tweetValue'])){

            $this->value = $session['tweetValue'];
            if(isset($session['respones'])){
                if(in_array($this->value,$session['respones'])){

                }
                else{
                    array_push($session['respones'],$this->value);
                }

                $this->ses = $session['respones'];
            }
            else{
                $session['respones'] = [];
                array_push($session['respones'], $this->value);
                $this->ses = $session['respones'];
            }

        }
        else{
            $session['respones'] = [];
            $this->value = null;
        }
    }

    public function viewTweet(){
        $result = $this->value;



        $resultLen = 0;
        foreach ($this->ses as $val){
            $resultLen += strlen($val);
        }

        $html = <<<HTML
<blockquote class="box twitter-tweet">
<figure><img src="stewart-48.png" width="48" height="48" alt="Picture of Stewart"/></figure>
<cite><a href="https://twitter.com/StewartCabbage">Stewart Cabbage LLC</a> <span class="id">@StewartCabbage</span></cite>
<p>
HTML;
        foreach($this->ses as $val){
            $html .= " ";
            $html .= $val;
            $html .= " ";
        }


        $html .= <<<HTML
</p></blockquote>
<p class="count">
HTML;
        if($resultLen>140){
            $html .= <<<HTML
<font color="red">$resultLen/140</font></p>
HTML;
        }
        else{
            $html .= <<<HTML
$resultLen/140</p>
HTML;
        }

        return $html;
    }

    public function viewSecondTweet(){
        //print_r($this->ses);
        //$result = $this->value;
        $html = <<<HTML
<fieldset class="box">
<p> 
HTML;
        foreach ($this->ses as $key => $val){
            if($key < 1) {
                $html .= $val;
                continue;
            }
            $html .= <<<HTML

<button name="right" value="$key"><img src="right.png" width="17" height="16" alt=""/> </button> 
HTML;
            $html .= $val;
            $html .= <<<HTML
 <button name="left" value="$key"><img src="left.png" width="17" height="16" alt=""/> 
HTML;
            $html .= <<<HTML
 <button name="delete" value="$key"><img src="delete.png" width="17" height="16" alt=""/> 
HTML;
        }
        $html .= <<<HTML
</p>
</fieldset>
HTML;
        return $html;

    }

    public function viewResp(){
        $html = <<<HTML
<div class="items">

HTML;
        $tempCounter = 0;
        foreach ($_SESSION['stockResp'] as $key => $val) {
            $html .= <<<HTML
<p><button name="add" value="$key">
<img src="check.png" width="17" height="16" alt=""/></button> 
HTML;
            $html .= $val;
            $html .= <<<HTML
</p>

HTML;
            $tempCounter++;
        }

        $html .= "</div>";

        $this->finalResult = "";
        foreach ($this->ses as $val){
            $this->finalResult .= " ";
            $this->finalResult .= $val;
            $this->finalResult .= " ";
        }

        //if(isset($_SESSION['finalRes'])){
            $_SESSION['finalRes'] = $this->finalResult;
        //}

        return $html;


        }

}