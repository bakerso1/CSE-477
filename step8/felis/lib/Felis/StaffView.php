<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 3/29/2017
 * Time: 6:38 PM
 */

namespace Felis;


class StaffView extends View
{
    public function __construct()
    {
        $this->addLink("index.php", "Log out");
    }
}