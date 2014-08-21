<?php

namespace TET\Test\Spider;

class BypetsTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.bypets.com/acana-adult-dog.html',
                array(
                    array('format'=>13,'qty'=>1,'price'=>56.15,'special_price'=>48.10),
                    array('format'=>18,'qty'=>1,'price'=>71.90,'special_price'=>61.70),
                ),
            ),
            array(
                'http://www.bypets.com/hills-sp-feline-adult-light-con-pollo.html',
                array(
                    array('format'=>0.3,'qty'=>1,'price'=>4.50,'special_price'=>3.50),
                    array('format'=>1.5,'qty'=>1,'price'=>17.50,'special_price'=>13.90),
                    array('format'=>5,'qty'=>1,'price'=>50.35,'special_price'=>39.40),
                    array('format'=>10,'qty'=>1,'price'=>70.20,'special_price'=>55.30),
                    array('format'=>10,'qty'=>2,'price'=>70.20,'special_price'=>52.40),
                ),
            ), 
            /*array(
                'http://www.bypets.com/pedigree-dentastix-razas-grandes.html',
                array(
                    array('format'=>13,'qty'=>1,'price'=>56.15,'special_price'=>48.10),
                    array('format'=>18,'qty'=>1,'price'=>71.90,'special_price'=>61.70),
                ),
            ),*/
            array(
                'http://www.bypets.com/royal-canin-feline-light-40.html',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>5.90,'special_price'=>3.90),
                    array('format'=>2,'qty'=>1,'price'=>23.65,'special_price'=>16.10),
                    array('format'=>3.5,'qty'=>1,'price'=>37,'special_price'=>26.80),
                    array('format'=>10,'qty'=>1,'price'=>73.30,'special_price'=>53),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Bypets();
    }

}
