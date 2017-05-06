<?php
/**
 * Created by PhpStorm.
 * User: jaiwant
 * Date: 3/29/2017
 * Time: 5:26 PM
 */

namespace Felis;


class HomeView  extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }
    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }

    private $testimonials = array();

    public function addTestimonial($t, $n){
        array_push($this->testimonials, "<blockquote><p>$t</p><p><cite>$n</cite></p></blockquote>");
    }

    public function testimonials(){

        $html = "<section class=\"testimonials\"> <h2>TESTIMONIALS</h2>";

        $sizeofT = sizeof($this->testimonials);
        $temp = $sizeofT/2;
        $html .= "<div class = 'left'";
        for($i = 0; $i <= $temp; $i++) {
            $html .= $this->testimonials[$i];
        }
        $html .= "</div>' <div class = 'right'";
        $html .= "<div class = 'right'";
        for($i = $temp; $i != $sizeofT; $i++) {
            $html .= $this->testimonials[$i];
        }
        $html .= "</div>";

        $html .="</section>";
        return $html;
    }


}