<?php

namespace TET\Spider;

use Goutte\Client;

class Medicanimal extends Spider {

    public function validate($url) {
        return preg_match('/www.medicanimal./', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('#maPriceList li')->each(function ($node) {

            $format = NULL;
            $price = NULL;
            $qty = 1;

            $subnode = $node->filter('label')->first();
            if ($subnode->count()) $format = $this->getFormat($subnode->text());
            if ($format === NULL) return NULL;
            if ($this->getQty($subnode->text()) > 1) $qty = $this->getQty($subnode->text()); 

            $subnode = $node->filter('span:nth-child(2)');
            if ($subnode->count()){
                $price = $this->getPrice($subnode->text());
            }
            if ($price === NULL) return NULL;

            $response = array(
                'format' => $format,
                'qty' => $qty,
                'price' => ($qty) ? round($price/$qty, 2) : $price,
                'special_price' => NULL,
            );

            return $response;

        });

        return array_filter($response);

    }
}
