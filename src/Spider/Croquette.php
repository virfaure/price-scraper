<?php

namespace TET\Spider;

use Goutte\Client;

class Croquette extends Spider {

    public function validate($url) {
        return preg_match('/www.croquetteland.com/', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('.simple_product')->each(function ($node) {

            $format = $price = $special_price = NULL;

            $subnode = $node->filter('.conditionnement span')->first();
            if ($subnode->count()) $format = $this->getFormat($subnode->text());
            if ($format == NULL) return NULL;

            $subnode = $node->filter('.display_price .price')->first();
            if ($subnode->count()) $price = $this->getPrice($subnode->text());
            if ($price == NULL) return NULL;

            $subnode = $node->filter('.cl-tooltip-specific .price')->first();
            if ($subnode->count()) $special_price = $this->getPrice($subnode->text());

            $response = array(
                'format' => $format,
                'qty' => 1,
                'price' => $price,
                'special_price' => $special_price,
            );

            return $response;

        });

        return array_filter($response);

    }
}
