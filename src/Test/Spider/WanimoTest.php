<?php

namespace TET\Test\Spider;

class WanimoTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.wanimo.com/fr/chiens/friandise-amp-compla-ment-sc2/advance-chien-snack-immunity-sf11811/',
                array(
                    array('format'=>0.15,'qty'=>1,'price'=>3.99,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.wanimo.com/fr/chiens/alimentation-pour-chien-sc1/acana-adult-dog-sac-de-kg-lot-de--sf7363/',
                array(
                    array('format'=>13,'qty'=>1,'price'=>58.19,'special_price'=>NULL),
                    array('format'=>13,'qty'=>2,'price'=>58.19,'special_price'=>54.13),
                    array('format'=>18,'qty'=>1,'price'=>72.25,'special_price'=>NULL),
                    array('format'=>18,'qty'=>2,'price'=>72.25,'special_price'=>67.675),
                ),
            ),
            array(
                'http://www.wanimo.com/fr/chats/alimentation-pour-chat-sc6/royal-canin-sterilised-kg-sf1797/',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>6.99,'special_price'=>NULL),
                    array('format'=>2,'qty'=>1,'price'=>21.99,'special_price'=>NULL),
                    array('format'=>4,'qty'=>1,'price'=>39.10,'special_price'=>NULL),
                    array('format'=>10,'qty'=>1,'price'=>62.99,'special_price'=>NULL),
                    array('format'=>10,'qty'=>2,'price'=>62.99,'special_price'=>52.495),
                ),
            ), 
            array(
                'http://www.wanimo.com/fr/chiens/alimentation-pour-chien-sc1/hill-s-prescription-canine-u-d-kg-sf162/',
                array(
                    array('format'=>5,'qty'=>1,'price'=>52.16,'special_price'=>NULL),
                    array('format'=>12,'qty'=>1,'price'=>86.28,'special_price'=>NULL),
                    array('format'=>0.37,'qty'=>12,'price'=>4.0958333333333,'special_price'=>NULL),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Wanimo();
    }

}
