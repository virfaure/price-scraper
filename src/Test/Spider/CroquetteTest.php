<?php

namespace TET\Test\Spider;

class CroquetteTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.croquetteland.com/affinity-advance-chat-adulte-poulet-et-riz.html',
                array(
                    array('format'=>1.5,'qty'=>1,'price'=>11.99,'special_price'=>10.79),
                    array('format'=>3,'qty'=>1,'price'=>20.99,'special_price'=>18.89),
                    array('format'=>15,'qty'=>1,'price'=>66.99,'special_price'=>60.29),
                ),
            ),
            array(
                'http://www.croquetteland.com/royal-canin-mini-light-30.html',
                array(
                    array('format'=>2,'qty'=>1,'price'=>16.99,'special_price'=>15.29),
                    array('format'=>4,'qty'=>1,'price'=>30.99,'special_price'=>27.89),
                    array('format'=>8,'qty'=>1,'price'=>54.99,'special_price'=>49.49),
                ),
            ),
            array(
                'http://www.croquetteland.com/royal-canin-light-40.html',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>6.99,'special_price'=>6.29),
                    array('format'=>2,'qty'=>1,'price'=>24.99,'special_price'=>22.49),
                    array('format'=>3.5,'qty'=>1,'price'=>37.99,'special_price'=>34.19),
                    array('format'=>10,'qty'=>1,'price'=>69.99,'special_price'=>62.99),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Croquette();
    }

}
