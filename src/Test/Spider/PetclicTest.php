<?php

namespace TET\Test\Spider;

class PetclicTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.petclic.es/royal-canin-medium-light-pienso-perros-raza-mediana',
                array(
                    array('format'=>3.5,'qty'=>1,'price'=>23.57,'special_price'=>NULL),
                    array('format'=>9,'qty'=>1,'price'=>45.43,'special_price'=>NULL),
                    array('format'=>13,'qty'=>1,'price'=>58.72,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.petclic.es/hills-adult-light-con-pollo-science-plan-pienso-gatos',
                array(
                    array('format'=>0.3,'qty'=>1,'price'=>4.26,'special_price'=>NULL),
                    array('format'=>0.3,'qty'=>2,'price'=>3.86,'special_price'=>NULL),
                    array('format'=>1.5,'qty'=>1,'price'=>16.28,'special_price'=>NULL),
                    array('format'=>1.5,'qty'=>2,'price'=>14.775,'special_price'=>NULL),
                    array('format'=>5,'qty'=>1,'price'=>46.83,'special_price'=>NULL),
                    array('format'=>10,'qty'=>1,'price'=>70.26,'special_price'=>NULL),
                    array('format'=>10,'qty'=>2,'price'=>63.75,'special_price'=>NULL),
                ),
            ), 
            array(
                'http://www.petclic.es/acana-senior-pienso-perros-mayores',
                array(
                    array('format'=>2.27,'qty'=>1,'price'=>15.77,'special_price'=>NULL),
                    array('format'=>6.8,'qty'=>1,'price'=>34.68,'special_price'=>NULL),
                    array('format'=>13,'qty'=>1,'price'=>52.06,'special_price'=>NULL),
                    array('format'=>13,'qty'=>2,'price'=>52.06,'special_price'=>NULL),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Petclic();
    }

}
