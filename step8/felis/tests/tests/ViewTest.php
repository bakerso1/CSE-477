<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class EmptyTest extends \PHPUnit_Framework_TestCase
{
	public function test_footer() {
		$view = new Felis\View();

		$this->assertContains('<footer><p>Copyright © 2016 Felis Investigations, Inc. All rights reserved.</p></footer>',
			$view->footer());
	}

	public function test_head() {
		$view = new Felis\View();

		$view->setTitle("Testing Felis Head");
		$html = $view->head();

		$this->assertContains('<link rel="stylesheet" href="lib/css/felis.css">', $html);
		$this->assertContains('<meta charset="utf-8">', $html);
		$this->assertContains('<title>Testing Felis Head</title>', $html);
		$this->assertContains('<meta name="viewport" content="width=device-width, initial-scale=1">', $html);

	}

	public function test_header() {
		$view = new Felis\View();
		$view->setTitle("whatever");
		$html = $view->header();

		$this->assertContains('<nav>', $html);
		$this->assertContains('<ul class="left">', $html);
		$this->assertContains('<li><a href="./">The Felis Agency</a></li>', $html);
		$this->assertContains('</ul>', $html);
		$this->assertContains('</nav>', $html);
		$this->assertContains('<header class="main">', $html);
		$this->assertContains('<h1><img src="images/comfortable.png" alt="Felis Mascot"> whatever', $html);
		$this->assertContains('<img src="images/comfortable.png" alt="Felis Mascot"></h1>', $html);
		$this->assertContains('</header>', $html);

		$this->assertNotContains('<ul class="right">', $html);
	}
	public function test_addLink() {
		$view = new Felis\View();
		$view->setTitle("whatever");
		$view->addLink("test.php", "Name to Display");
		$html = $view->header();

		$this->assertContains('<ul class="right"><li><a href="test.php">Name to Display</a></li></ul>', $html);
	}
}

/// @endcond
?>
