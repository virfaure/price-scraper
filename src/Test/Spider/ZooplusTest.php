<?php

namespace TET\Test\Spider;

class ZooplusTest extends SpiderTest {

    public function provider() {
        return array(
            array(
                'http://www.zooplus.es/shop/tienda_perros/pienso_perros/acana/acana_cassics/382205',
                array(
                    array('format'=>2.27,'qty'=>1,'price'=>14.90,'special_price'=>NULL),
                    array('format'=>6.8,'qty'=>1,'price'=>31.90,'special_price'=>NULL),
                    array('format'=>6.8,'qty'=>2,'price'=>31.90,'special_price'=>30.95),
                ),
            ),
            array(
                'http://www.zooplus.es/shop/tienda_perros/pienso_perros/royal_canin_veterinary_diet/problemas_digestivos/307292',
                array(
                    array('format'=>2,'qty'=>1,'price'=>19.45,'special_price'=>15.90),
                    array('format'=>7.5,'qty'=>1,'price'=>56.95,'special_price'=>46.90),
                    array('format'=>14,'qty'=>1,'price'=>89.20,'special_price'=>69.90),
                    array('format'=>14,'qty'=>2,'price'=>69.90,'special_price'=>64.95),
                ),
            ),
            array(
                'http://www.zooplus.es/shop/tienda_perros/pienso_perros/royal_canin_size/royal_canin_grande/56412',
                array(
                    array('format'=>4,'qty'=>1,'price'=>32.75,'special_price'=>19.90),
                    array('format'=>15,'qty'=>1,'price'=>85.15,'special_price'=>52.90),
                    array('format'=>18,'qty'=>1,'price'=>63.48,'special_price'=>52.90),
                    array('format'=>15,'qty'=>2,'price'=>52.9,'special_price'=>49.95),
                ),
            ),
            array(
                'http://www.zooplus.fr/shop/chats/croquettes_chat/affinity_advance_croquettes_chat/277978',
                array(
                    array('format'=>1.5,'qty'=>1,'price'=>14.95,'special_price'=>12.90),
                    array('format'=>3,'qty'=>1,'price'=>21.49,'special_price'=>19.90),
                    array('format'=>3,'qty'=>3,'price'=>19.9,'special_price'=>18.3),
                    array('format'=>15,'qty'=>1,'price'=>69.90,'special_price'=>NULL),
                    array('format'=>15,'qty'=>2,'price'=>69.9,'special_price'=>67.45),
                ),
            ),
            array(
                'http://www.zooplus.fr/shop/chiens/aliments_specifiques_therapeutiques_chien/croquettes_chien_hills_prescription_diet/problemes_renaux_chien_croquettes_hills/183117',
                array(
                    array('format'=>12,'qty'=>1,'price'=>68.90,'special_price'=>NULL),
                    array('format'=>12,'qty'=>2,'price'=>68.9,'special_price'=>66.95),
                ),
            ),
            array(
                'http://www.zooplus.fr/shop/chats/croquettes_chat/royal_canin_croquettes_chat/royal_canin_chat_exterieur_croquettes_chat/15513',
                array(
                    array('format'=>0.4,'qty'=>1,'price'=>4.90,'special_price'=>NULL),
                    array('format'=>2,'qty'=>1,'price'=>17.9,'special_price'=>NULL),
                    array('format'=>4,'qty'=>1,'price'=>29.9,'special_price'=>NULL),
                    array('format'=>10,'qty'=>1,'price'=>54.9,'special_price'=>NULL),
                    array('format'=>10,'qty'=>2,'price'=>54.9,'special_price'=>52.45),
                ),
            ),
        );
    }

    protected function getSpider() {
        return new \TET\Spider\Zooplus();
    }

}
