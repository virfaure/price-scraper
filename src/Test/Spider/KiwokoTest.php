<?php

namespace TET\Test\Spider;

class KiwokoTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.kiwoko.com/royal-canin-feline-veterinaria-diettica-hypoallergenic-p-9908.html',
                array(
                    array('format'=>2.5,'qty'=>1,'price'=>30.50,'special_price'=>NULL),
                    array('format'=>4.5,'qty'=>1,'price'=>47.60,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.kiwoko.com/royal-canin-feline-sterilised-p-8964.html',
                array(
                    array('format'=>2,'qty'=>1,'price'=>22.65,'special_price'=>NULL),
                    array('format'=>4,'qty'=>1,'price'=>35.95,'special_price'=>NULL),
                    array('format'=>10,'qty'=>1,'price'=>59.95,'special_price'=>NULL),
                    array('format'=>15,'qty'=>1,'price'=>69.95,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.kiwoko.com/oferta-advance-snack-puppy-p-10070.html',
                array(
                    array('format'=>0.15,'qty'=>1,'price'=>3.60,'special_price'=>2.99),
                ),
            ),
            array(
                'http://www.kiwoko.com/eukanuba-puppy-junior-small-3kg.html',
                array(
                    array('format'=>3,'qty'=>1,'price'=>19.49,'special_price'=>15.95),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Kiwoko();
    }

}
