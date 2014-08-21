<?php

namespace TET\Spider;

use Goutte\Client;

class CNC extends Spider {

    public function validate($url) {
        return preg_match('/www.centrodenutricioncanina.com/', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('.formato')->each(function ($node) {

            $format = NULL;

            $subnode = $node->filter('.ficha_kg')->first();
            if ($subnode->count()) $format = $this->getFormat($subnode->text());
            if ($format == NULL) return NULL;

            $qty = 1;
            $matches = array();
            if (preg_match('/Pack([ de]+)(\d+)/i', $subnode->text(), $matches)) {
                $qty = $matches[2];
            }

            $prices = $node->filter('.precioformato > div')->each(function ($node) {
                return $this->getPrice($node->text());
            });
            if (count($prices) == 0) return NULL;

            $response = array(
                'format' => $format,
                'qty' => $qty,
                'price' => max($prices) / $qty,
                'special_price' => (min($prices) < max($prices)) ? min($prices) / $qty : NULL,
            );

            return $response;

        });

        return array_filter($response);

    }
}
