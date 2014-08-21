<?php

namespace TET\Test\Spider;

class AnimalclanTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.animalclan.com/es/1506-hills-diet-canine-jd.html',
                array(
                    array('format'=>2,'qty'=>1,'price'=>22.50,'special_price'=>17.98),
                    array('format'=>5,'qty'=>1,'price'=>41.86,'special_price'=>35.85),
                    array('format'=>12,'qty'=>1,'price'=>81.35,'special_price'=>70.04),
                ),
            ),
            array(
                'http://www.animalclan.com/es/647-royal-canin-feline-sterilised-37.html',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>5.90,'special_price'=>3.87),
                    array('format'=>2,'qty'=>1,'price'=>22.65,'special_price'=>17.36),
                    array('format'=>4,'qty'=>1,'price'=>40.95,'special_price'=>30.52),
                    array('format'=>10,'qty'=>1,'price'=>73.35,'special_price'=>55.15),
                    array('format'=>15,'qty'=>1,'price'=>92.25,'special_price'=>61.95),
                ),
            ),
            array(
                'http://www.animalclan.com/es/58-pedigree-snacks-meaty-sticks.html',
                array(
                   array('format'=>0.04,'qty'=>1,'price'=>1.73,'special_price'=>1.42),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Animalclan();
    }

}
