<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * @brief Empty unit testing template/database version
 * @cond 
 * @brief Unit tests for the class 
 */

class EmptyDBTest extends \PHPUnit_Extensions_Database_TestCase
{

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function getConnection()
    {
        return $this->createDefaultDBConnection(self::$site->pdo(), 'bhushanj');
    }

	/**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */

    public function test_construct() {
        $users = new Felis\Users(self::$site);
        $this->assertInstanceOf('Felis\Users', $users);
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');
    }

    public function test_getter() {
        $users = new Felis\Users(self::$site);

        // Test valid ID
        $user = $users->get("7");
        $this->assertInstanceOf('Felis\User', $user);

        $user = $users->get("8");
        $this->assertInstanceOf('Felis\User', $user);

        $user = $users->get("10");
        $this->assertInstanceOf('Felis\User', $user);

        ///invalid
        $user = $users->get("1453");
        $this->assertNull($user);

    }

    public function test_login() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);

        $user = $users->login("marge@bartman.com", "marge");
        $this->assertInstanceOf('Felis\User', $user);

        $user = $users->login("bart@bartman.com", "bart477");
        $this->assertInstanceOf('Felis\User', $user);

        $user = $users->login("dudes@dude.com", "87654321");
        $this->assertNull($user);


    }
	
}

/// @endcond
?>
