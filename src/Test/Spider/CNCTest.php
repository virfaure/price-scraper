<?php

namespace TET\Test\Spider;

class CNCTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.centrodenutricioncanina.com/perro/pienso/royal-canin/veterinary/veterinary-mobility-support-ms-25',
                array(
                    array('format'=>14, 'qty'=>2,'price'=>136.30/2,'special_price'=>NULL),
                    array('format'=>14, 'qty'=>1,'price'=>90.34,   'special_price'=>72.15),
                    array('format'=>7,  'qty'=>1,'price'=>54.37,   'special_price'=>47.80),
                    array('format'=>1.5,'qty'=>1,'price'=>15.63,   'special_price'=>13.15),
                ),
            ),
            array(
                'http://www.centrodenutricioncanina.com/perro/pienso/royal-canin/razas/labrador-retriever-30',
                array(
                    array('format'=>12,'qty'=>2,'price'=>139.37/2,'special_price'=>94.00/2),
                    array('format'=>12,'qty'=>1,'price'=>69.68,   'special_price'=>49.60),
                    array('format'=>3, 'qty'=>1,'price'=>25.24,   'special_price'=>19.25),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\CNC();
    }

}
