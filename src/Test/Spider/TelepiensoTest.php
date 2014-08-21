<?php

namespace TET\Test\Spider;

class TelepiensoTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.telepienso.com/products/acana-adult-dog',
                array(
                    array('format'=>13,'qty'=>1,'price'=>62.40,'special_price'=>52.00),
                    array('format'=>18,'qty'=>1,'price'=>72.14,'special_price'=>60.12),
                ),
            ),
            array(
                'http://www.telepienso.com/products/royal-canin-fit',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>5.30, 'special_price'=>4.28),
                    array('format'=>2,  'qty'=>1,'price'=>20.28,'special_price'=>16.59),
                    array('format'=>4,  'qty'=>1,'price'=>34.72,'special_price'=>28.78),
                    array('format'=>10, 'qty'=>1,'price'=>66.90,'special_price'=>55.75),
                    array('format'=>15, 'qty'=>1,'price'=>87.37,'special_price'=>71.80),
                ),
            ),
            array(
                'http://www.telepienso.com/products/hills-prescription-diet-canine-u-d',
                array(
                    array('format'=>5, 'qty'=>1,'price'=>46.87,'special_price'=>44.91),
                    array('format'=>12,'qty'=>1,'price'=>75.14,'special_price'=>64.94),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Telepienso();
    }

}
