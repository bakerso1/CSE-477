<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * @brief Empty unit testing template
 * @cond 
 * @brief Unit tests for the class 
 */
class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function testGetTablePrefix() {
		$site = new Felis\Site();
		$this->assertEquals('', $site->getTablePrefix());
	}

	public function testGetEmail() {
		$site = new Felis\Site();
		$this->assertEquals('', $site->getEmail());
	}

	public function testSetEmail() {
		$site = new Felis\Site();
		$site->setEmail('myname');
		$this->assertEquals('myname', $site->getEmail());
	}

	public function testGetRoot() {
		$site = new Felis\Site();
		$this->assertEquals('', $site->getRoot());
	}

	public function testSetRoot() {
		$site = new Felis\Site();
		$site->setRoot('poop');
		$this->assertEquals('poop', $site->getRoot());
	}
	public function test_localize() {
		$site = new Felis\Site();
		$localize = require 'localize.inc.php';
		if(is_callable($localize)) {
			$localize($site);
		}
		$this->assertEquals('test_', $site->getTablePrefix());
	}
}

/// @endcond
?>
