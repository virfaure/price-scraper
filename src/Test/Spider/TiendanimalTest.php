<?php

namespace TET\Test\Spider;

class TiendanimalTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.tiendanimal.es/royal-canin-hypoallergenic-canine-p-1689.html',
                array(
                    array('format'=>2,'qty'=>1,'price'=>21.95,'special_price'=>NULL),
                    array('format'=>7,'qty'=>1,'price'=>56.45,'special_price'=>NULL),
                    array('format'=>14,'qty'=>1,'price'=>91.45,'special_price'=>NULL),
                    array('format'=>14,'qty'=>2,'price'=>82.30,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.tiendanimal.es/hills-feline-seco-p-1644.html',
                array(
                    array('format'=>1.5,'qty'=>1,'price'=>17.45,'special_price'=>NULL),
                    array('format'=>5,'qty'=>1,'price'=>46.95,'special_price'=>NULL),
                    array('format'=>5,'qty'=>2,'price'=>42.25,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.tiendanimal.es/acana-premium-adult-p-2165.html',
                array(
                    array('format'=>13,'qty'=>1,'price'=>47.95,'special_price'=>NULL),
                    array('format'=>18,'qty'=>1,'price'=>62.45,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.tiendanimal.es/advance-gastro-enteric-canin-lata-p-4678.html',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>2.95,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.tiendanimal.es/criadores-gatos-kitten-gatitos-p-6880.html',
                array(
                    array('format'=>5,'qty'=>1,'price'=>32.35,'special_price'=>21.90),
                    array('format'=>10,'qty'=>1,'price'=>49.5,'special_price'=>39.06),
                    array('format'=>10,'qty'=>2,'price'=>40.885,'special_price'=>35.66),
                ),
            ),
            array(
                'http://www.tiendanimal.es/royal-canin-light-para-gatos-p-83.html',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>3.99,'special_price'=>NULL),
                    array('format'=>2,'qty'=>1,'price'=>15.99,'special_price'=>NULL),
                    array('format'=>3.5,'qty'=>1,'price'=>25.95,'special_price'=>NULL),
                    array('format'=>10,'qty'=>1,'price'=>54.99,'special_price'=>NULL),
                    array('format'=>10,'qty'=>2,'price'=>49.49,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.tiendanimal.fr/advance-maxi-senior-p-143.html',
                array(
                    array('format'=>15,'qty'=>1,'price'=>52.45,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.tiendanimal.fr/royal-canin-diabetic-canine-p-7582.html',
                array(
                    array('format'=>1.5,'qty'=>1,'price'=>13.95,'special_price'=>NULL),
                    array('format'=>7,'qty'=>1,'price'=>50.95,'special_price'=>NULL),
                    array('format'=>12,'qty'=>1,'price'=>68.95,'special_price'=>NULL),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Tiendanimal();
    }

}
