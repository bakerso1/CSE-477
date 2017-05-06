<?php

require __DIR__ . "/../../vendor/autoload.php";
use Guessing\GuessingView as GuessingView;
use Guessing\Guessing as Guessing;

/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class GuessingViewTest extends \PHPUnit_Framework_TestCase
{
	const SEED = 1234;

	public function test1()
	{
		$guess = new Guessing(1234);
		$view = new GuessingView($guess);

		$this->assertContains('Try to', $view->present());
		$guess->guess(555);
		$this->assertContains('invalid', $view->present());
		$guess->guess(1);
		$this->assertContains('too low', $view->present());
		$guess->guess(90);
		$this->assertContains('too high', $view->present());
		$guess->guess(23);
		$this->assertContains('correct', $view->present());

		//$this->assertEquals($expected, $actual);
	}
}

/// @endcond
?>
