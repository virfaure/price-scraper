<?php

namespace TET\Spider;

use Goutte\Client;

class Bitiba extends Spider {

    public function validate($url) {
        return preg_match('/www.bitiba./', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('tr.text')->each(function ($node) {

            $format = NULL;

            $subnode = $node->filter('td:nth-child(1)')->first();
            if ($subnode->count()) $format = $this->getFormat($subnode->text());
            if ($format === NULL) return NULL;

            $prices = $node->filter('td:nth-child(3) .val')->each(function ($node) {
                return $this->getPrice($node->text());
            });
            if (count($prices) == 0) return NULL;

            $response = array(
                'format' => $format,
                'qty' => 1,
                'price' => max($prices),
                'special_price' => (min($prices) < max($prices)) ? min($prices) : NULL,
            );

            return $response;

        });

        return array_filter($response);

    }
}
