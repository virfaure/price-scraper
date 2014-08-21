<?php

namespace TET\Test\Spider;

class AmazonTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.amazon.fr/Hills-Prescription-Canine-ULTRA-Allergen-Free/dp/B0036QSCMS',
                array(
                    array('format'=>10,'qty'=>1,'price'=>69.70,'special_price'=>NULL),
                ),
            ),
            /*
            array(
                'http://www.amazon.fr/Advance-Croquettes-Chats-Saumon-Riz/dp/B007OUAZWM',
                array(
                    array('format'=>15,'qty'=>1,'price'=>71.50,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.amazon.fr/Advance-dog-snack-immunity-ref-500371/dp/B00HB2IHO6',
                array(
                    array('format'=>.15,'qty'=>1,'price'=>3.30,'special_price'=>NULL),
                ),
            ),
            */
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Amazon();
    }

}
