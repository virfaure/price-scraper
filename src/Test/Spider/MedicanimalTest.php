<?php

namespace TET\Test\Spider;

class MedicanimalTest extends SpiderTest {

    public function provider() {
        return array(
            //es_ES
            array(
                'http://www.medicanimal.com/setSessionLocale/product?product_id=106882&locale=es_ES',
                array(
                    array('format'=>1.5,'qty'=>1,'price'=>11.90,'special_price'=>NULL),
                    array('format'=>7,  'qty'=>1,'price'=>45.90,'special_price'=>NULL),
                    array('format'=>12, 'qty'=>1,'price'=>59.90,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.medicanimal.com/setSessionLocale/product?product_id=10239&locale=es_ES',
                array(
                    array('format'=>3,    'qty'=>1, 'price'=>15.89,'special_price'=>NULL),
                    array('format'=>0.370,'qty'=>12,'price'=>2.33, 'special_price'=>NULL),
                    array('format'=>7.5,  'qty'=>1, 'price'=>38.90,'special_price'=>NULL),
                    array('format'=>12,   'qty'=>1, 'price'=>44.90,'special_price'=>NULL),
                    array('format'=>12,   'qty'=>2, 'price'=>40.95,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.medicanimal.com/setSessionLocaleProductList/product?product_id=5066&locale=es_ES',
                array(
                    array('format'=>2,    'qty'=>1, 'price'=>15.90,'special_price'=>NULL),
                    array('format'=>0.420,'qty'=>12,'price'=>2.99, 'special_price'=>NULL),
                    array('format'=>7,    'qty'=>1, 'price'=>45.90,'special_price'=>NULL),
                    array('format'=>14,   'qty'=>1, 'price'=>74.90,'special_price'=>NULL),
                    array('format'=>14,   'qty'=>2, 'price'=>67.95,'special_price'=>NULL),
                ),
            ),
            // en_GB
            array(
                'http://www.medicanimal.com/setSessionLocale/product?product_id=106882&locale=en_GB',
                array(
                    array('format'=>1.5,'qty'=>1,'price'=>10.96,'special_price'=>NULL),
                    array('format'=>7,  'qty'=>1,'price'=>36.95,'special_price'=>NULL),
                    array('format'=>12, 'qty'=>1,'price'=>52.00,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.medicanimal.com/setSessionLocale/product?product_id=10239&locale=en_GB',
                array(
                    array('format'=>3,    'qty'=>1, 'price'=>14.95,'special_price'=>NULL),
                    array('format'=>0.370,'qty'=>12,'price'=>1.83, 'special_price'=>NULL),
                    array('format'=>7.5,  'qty'=>1, 'price'=>33.95,'special_price'=>NULL),
                    array('format'=>12,   'qty'=>1, 'price'=>39.95,'special_price'=>NULL),
                    array('format'=>12,   'qty'=>2, 'price'=>39.95,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.medicanimal.com/setSessionLocaleProductList/product?product_id=5066&locale=en_GB',
                array(
                    array('format'=>2,    'qty'=>1, 'price'=>14.45,'special_price'=>NULL),
                    array('format'=>0.420,'qty'=>12,'price'=>2.18, 'special_price'=>NULL),
                    array('format'=>7,    'qty'=>1, 'price'=>41.00,'special_price'=>NULL),
                    array('format'=>14,   'qty'=>1, 'price'=>61.90,'special_price'=>NULL),
                    array('format'=>14,   'qty'=>2, 'price'=>58.80,'special_price'=>NULL),
                ),
            ),
            // fr_FR
            array(
                'http://www.medicanimal.com/setSessionLocale/product?product_id=106882&locale=fr_FR',
                array(
                    array('format'=>1.5,'qty'=>1,'price'=>16.96,'special_price'=>NULL),
                    array('format'=>7,  'qty'=>1,'price'=>48.06,'special_price'=>NULL),
                    array('format'=>12, 'qty'=>1,'price'=>71.14,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.medicanimal.com/setSessionLocale/product?product_id=10239&locale=fr_FR',
                array(
                    array('format'=>3,    'qty'=>1, 'price'=>17.96,'special_price'=>NULL),
                    array('format'=>0.370,'qty'=>12,'price'=>2.33, 'special_price'=>NULL),
                    array('format'=>7.5,  'qty'=>1, 'price'=>48.06,'special_price'=>NULL),
                    array('format'=>12,   'qty'=>1, 'price'=>50.06,'special_price'=>NULL),
                    array('format'=>12,   'qty'=>2, 'price'=>46.61,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.medicanimal.com/setSessionLocaleProductList/product?product_id=5066&locale=fr_FR',
                array(
                    array('format'=>2,    'qty'=>1, 'price'=>20.96,'special_price'=>NULL),
                    array('format'=>0.420,'qty'=>12,'price'=>3.34, 'special_price'=>NULL),
                    array('format'=>7,    'qty'=>1, 'price'=>53.08,'special_price'=>NULL),
                    array('format'=>14,   'qty'=>1, 'price'=>77.16,'special_price'=>NULL),
                    array('format'=>14,   'qty'=>2, 'price'=>72.69,'special_price'=>NULL),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Medicanimal();
    }

}
