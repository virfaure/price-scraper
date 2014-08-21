<?php

namespace TET\Test\Spider;

class BitibaTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.bitiba.es/shop/gatos/pienso/royal_canin_veterinary_diet/royal_canin_vetcare_pienso/381285',
                array(
                    array('format'=>3.5,'qty'=>1,'price'=>36.55,'special_price'=>24.99),
                    array('format'=>10,'qty'=>1,'price'=>76.90,'special_price'=>51.99),
                ),
            ),
            array(
                'http://www.bitiba.es/shop/perros/pienso_perros/eukanuba_special_breed_pienso_perro/eukanuba_breed_nutrition_pienso_perro/374836',
                array(
                    array('format'=>12,'qty'=>1,'price'=>41.99,'special_price'=>NULL),
                ),
            ),
            array(
                'http://www.bitiba.fr/shop/chiens/croquettes/acana_croquettes_chien/acana_classic/341696',
                array(
                    array('format'=>13,'qty'=>1,'price'=>69.99,'special_price'=>NULL),
                    array('format'=>18,'qty'=>1,'price'=>89.99,'special_price'=>NULL),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Bitiba();
    }

}
