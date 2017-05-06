<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 3/29/2017
 * Time: 8:05 PM
 */

namespace Felis;


class LoginView extends View
{

    private $error;

    /**
     * @return mixed
     */
    public function getError()
    {
        if (isset($_GET['e'])) {
            $this->error = <<<HTML
<h1 align="center">Wrong Username or Password!</h1>
HTML;
        }
        return $this->error;
    }



}