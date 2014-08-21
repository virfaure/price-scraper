<?php

namespace TET\Test\Spider;

abstract class SpiderTest extends \PHPUnit_Framework_TestCase {

    abstract public function provider();
    abstract protected function getSpider();

    private static $test_level = FALSE;

    const TEST_LEVEL_ENV_NAME = 'TEST_LEVEL';

    const TEST_LEVEL_NO_ERROR = 1;
    const TEST_LEVEL_SAME_ROWS = 2;
    const TEST_LEVEL_SAME_PRICES = 3;

    private function getTestLevel() {
        if (self::$test_level === FALSE) {
            self::$test_level = getenv(self::TEST_LEVEL_ENV_NAME);
            if (self::$test_level === FALSE) self::$test_level = self::TEST_LEVEL_NO_ERROR;
            if (self::$test_level < 1 | self::$test_level > 3) self::$test_level = self::TEST_LEVEL_NO_ERROR;
        }
        return self::$test_level;
    }

    private function doTest($level) {
        return $this->getTestLevel() >= $level;
    }

    /**
     * @dataProvider provider
     */
    public function testSpider($url, $expected) {

        $spider = $this->getSpider();
        $response = $spider->parse($url);

        // TEST_LEVEL_NO_ERROR
        if ($this->doTest(self::TEST_LEVEL_NO_ERROR)) $this->assertTrue(count($response) > 0 || count($expected)==0, 'Empty response');

        // TEST_LEVEL_SAME_ROWS
        if ($this->doTest(self::TEST_LEVEL_SAME_ROWS)) $this->assertEquals(count($expected), count($response), 'Response does not have same number of rows');

        if (count($expected)>0) {

            $this->assertEquals(count(array_keys($expected[0])), count(array_keys($response[0])), 'Response does not have same number of fields per row');

            // TEST_LEVEL_SAME_PRICES
            if ($this->doTest(self::TEST_LEVEL_SAME_PRICES)) {
                foreach ($expected as $expected_row) {

                    $found = false;
                    foreach($response as $response_row) {
                        if ($expected_row['format'] == $response_row['format'] & $expected_row['qty'] == $response_row['qty']) {
                            $this->assertEquals($expected_row['price'], $response_row['price']);
                            $this->assertEquals($expected_row['special_price'], $response_row['special_price']);
                            $found = true;
                        }
                    }
                    $this->assertTrue($found, sprintf('Combination of format-qty not found (%s, %s)', $expected_row['format'], $expected_row['qty']));

                }
            }

        }


    }

}
