<?php

namespace TET\Test\Spider;

class MiscotaTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.miscota.es/perros/acana/adult-dog',
                array(
                    array('format'=>13,'qty'=>1,'price'=>56.16,'special_price'=>45.95),
                    array('format'=>18,'qty'=>1,'price'=>71.90,'special_price'=>59.95),
                    array('format'=>18,'qty'=>2,'price'=>71.90,'special_price'=>59.95),
                ),
            ),
            array(
                'http://www.miscota.es/perros/eukanuba/adulto-cordero-y-arroz-razas-grandes',
                array(
                    array('format'=>2.5,'qty'=>1,'price'=>19.49,'special_price'=>14.95),
                    array('format'=>3,  'qty'=>1,'price'=>24.95,'special_price'=>17.95),
                    array('format'=>12, 'qty'=>1,'price'=>74.99,'special_price'=>50.45),
                    array('format'=>12, 'qty'=>2,'price'=>74.99,'special_price'=>47.93),
                ),
            ),
            array(
                'http://www.miscota.es/gatos/royal-canin/light-40',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>6.11, 'special_price'=>5.25),
                    array('format'=>2,  'qty'=>1,'price'=>23.95,'special_price'=>20.45),
                    array('format'=>3.5,'qty'=>1,'price'=>37.75,'special_price'=>32.45),
                    array('format'=>10, 'qty'=>1,'price'=>74.70,'special_price'=>63.95),
                ),
            ),
            array(
                'http://animaux.miscota.fr/chiens/advance/boxer',
                array(
                    array('format'=>12,'qty'=>1,'price'=>68.00,'special_price'=>57.45),
                    array('format'=>12,'qty'=>2,'price'=>68.00,'special_price'=>54.58),
                ),
            ),
            array(
                'http://animaux.miscota.fr/chats/hills/hills-c-d-poulet-faible-en-calories',
                array(
                    array('format'=>1.5,'qty'=>1,'price'=>20.96,'special_price'=>20.45),
                    array('format'=>4,  'qty'=>1,'price'=>47.95,'special_price'=>45.95),
                    array('format'=>8,  'qty'=>1,'price'=>74.90,'special_price'=>71.95),
                    array('format'=>8,  'qty'=>2,'price'=>74.90,'special_price'=>68.36),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Miscota();
    }

}
