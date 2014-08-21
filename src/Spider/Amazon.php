<?php

namespace TET\Spider;

use Goutte\Client;

class Amazon extends Spider {

    public function validate($url) {
        return preg_match('/www.amazon.fr/', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $format = $price = NULL;

        $node = $crawler->filter('#productTitle')->first();
        if ($node->count()) $format = $this->getFormat($node->text());
        if ($format === NULL) return array();

        $node = $crawler->filter('#priceblock_ourprice')->first();
        if ($node->count()) $price = $this->getPrice($node->text());
        if ($price === NULL) return array();

        $response = array(array(
            'format' => $format,
            'qty' => 1,
            'price' => $price,
            'special_price' => NULL,
        ));

        return $response;

    }
}
