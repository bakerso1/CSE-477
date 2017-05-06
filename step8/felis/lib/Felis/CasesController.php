<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 4/7/2017
 * Time: 6:33 PM
 */

namespace Felis;


class CasesController
{
    public function __construct(Site $site, $post)
    {
        $siteRoot = $site->getRoot();
        $id = strip_tags($post['id']);
        if(isset($post["add"])) {
            $this->redirect = "$siteRoot/newcase.php";
        }
        else {
            $this->redirect = "$siteRoot/cases.php";
        }
    }

    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param string $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }



    private $redirect;

}