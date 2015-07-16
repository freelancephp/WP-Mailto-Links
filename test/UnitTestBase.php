<?php
include_once 'WPDependencies.php';

/**
 * Class UnitTestBase
 * Parent for all Unit Test
 */
class UnitTestBase extends PHPUnit_Framework_TestCase
{

    private static $savedCalls = array();

    /**
     * Save calls to function or method with given params
     * @param string $funcName
     * @param array $arguments Optional
     */
    public static function saveCall($funcName, array $arguments = array())
    {
        if (!isset(self::$savedCalls[$funcName])) {
            self::$savedCalls[$funcName] = array();
        }

        self::$savedCalls[$funcName][] = $arguments;
    }

    protected static function clearSavedCalls()
    {
        self::$savedCalls = array();
    }

    protected function assertCall($funcName, array $arguments = array(), $numberOfCall = 1)
    {
        if (!isset(self::$savedCalls[$funcName])) {
            $this->assertFalse(true, 'The function "' . $funcName . '" was not called.');
            return;
        }

        $index = $numberOfCall - 1;
        $this->assertEquals($arguments, self::$savedCalls[$funcName][$index]);
    }


    protected function assertNotCalled($funcName)
    {
        $this->assertFalse(isset(self::$savedCalls[$funcName]));
    }

    protected function setUp()
    {
    }

    protected function tearDown()
    {
        self::clearSavedCalls();
    }

}
