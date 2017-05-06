<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/26/2017
 * Time: 8:07 PM
 */

namespace Twitter;


class PostedControl
{

    private $redirect;
    public function __construct($post){
        if(isset($post['respond'])){
            $this->redirect = "../";
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