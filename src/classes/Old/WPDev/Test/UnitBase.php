<?php
/**
 * Class Old_WPDev_Test_UnitBase
 *
 * Parent for all Unit Test
 *
 * @package  WPDev
 * @category WordPress Library
 * @version  1.0.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
class Old_WPDev_Test_UnitBase extends PHPUnit_Framework_TestCase
{

    /**
     * @var array
     */
    private static $savedCalls = array();

    /**
     * @var array
     */
    private static $returnValues = array();

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

    /**
     * @param string  $funcName
     * @param array   $arguments
     * @param integer $numberOfCall
     * @return void
     */
    protected function assertCall($funcName, array $expectedArguments = array(), $numberOfCall = 1)
    {
        if (!isset(self::$savedCalls[$funcName])) {
            $this->assertFalse(true, 'The function "' . $funcName . '" was not called.');
            return;
        }

        $index = $numberOfCall - 1;
        $this->assertEquals($expectedArguments, self::$savedCalls[$funcName][$index]);
    }

    /**
     * @param string  $funcName
     * @param integer $expectedCountCalls
     * @return void
     */
    protected function assertCallCount($funcName, $expectedCountCalls)
    {
        if (isset(self::$savedCalls[$funcName])) {
            $countCalls = count(self::$savedCalls[$funcName]);
        }else {
            $countCalls = 0;
        }

        $this->assertEquals($expectedCountCalls, $countCalls);
    }

    /**
     * @param string $funcName
     */
    protected function assertIsCalled($funcName)
    {
        $this->assertTrue(isset(self::$savedCalls[$funcName]));
    }

    /**
     * @param string $funcName
     */
    protected function assertIsNotCalled($funcName)
    {
        $this->assertFalse(isset(self::$savedCalls[$funcName]));
    }

    /**
     * Clear all calls
     */
    protected static function clearSavedCalls()
    {
        self::$savedCalls = array();
    }

    /**
     * Get all calls
     */
    protected static function getSavedCalls()
    {
        return self::$savedCalls;
    }

    /**
     * Set return value for a global function (used for function mocking simulation of ->willReturn())
     * @param string $funcName
     * @param mixed  $returnValue
     * @throws Exception
     */
    public static function setReturnValue($funcName, $returnValue)
    {
        if (!function_exists($funcName)) {
            throw new Exception('Function "' . $funcName . '" does not exist.');
        }

        self::$returnValues[$funcName] = $returnValue;
    }

    /**
     * Get return value of global function (use within the "mocked" function)
     * @example
     *      function someFunc()
     *      {
     *          return WPTestReturnValues::getReturnValue(__FUNCTION__);
     *      }
     * @param string $funcName
     * @return mixed
     */
    public static function getReturnValue($funcName)
    {
        if (isset(self::$returnValues[$funcName])) {
            return self::$returnValues[$funcName];
        }

        return;
    }

    /**
     * Clear all return values
     */
    protected static function clearReturnValues()
    {
        self::$returnValues = array();
    }

    /**
     * On end of each test
     */
    protected function tearDown()
    {
        self::clearSavedCalls();
        self::clearReturnValues();
    }

}
