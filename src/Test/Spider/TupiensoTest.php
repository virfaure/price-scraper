<?php

namespace TET\Test\Spider;

class TupiensoTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://tupiensoencasa.com/humedos-gato/824-hills-feline-adult-con-pescado-azul-bolsita-100-gr-pack-x-12.html',
                array(
                    array('format'=>0.1,'qty'=>12,'price'=>1.3,'special_price'=>NULL),
                ),
            ),
            array(
                'http://tupiensoencasa.com/pienso-seco-perro/874-hills-canine-adult-advance-fitness-razas-grandes-con-pollo-12-kg.html',
                array(
                    array('format'=>3,   'qty'=>1,'price'=>17.60,'special_price'=>NULL),
                    array('format'=>12,  'qty'=>1,'price'=>49.73,'special_price'=>44.90),
                    array('format'=>14.5,'qty'=>1,'price'=>50.10,'special_price'=>NULL),
                    array('format'=>18,  'qty'=>1,'price'=>66.99,'special_price'=>NULL),
                ),
            ),
            array(
                'http://tupiensoencasa.com/humedos-gato/787-royal-canin-babycat-instinctive-10-lata-4-x-100-gr-pack-x-6.html',
                array(
                    array('format'=>0.1,'qty'=>24,'price'=>1.22,'special_price'=>NULL),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Tupienso();
    }

}
