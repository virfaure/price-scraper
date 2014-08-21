<?php

namespace TET\Spider;

use Goutte\Client;

class Miscota extends Spider {

    public function validate($url) {
        return preg_match('/www.miscota./', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('.tablePrices dd')->each(function ($node) {

            $format = NULL;
            $price = NULL;
            $qty = 1;

            $subnode = $node->filter('.productWeight')->first();
            if ($subnode->count()) $format = $this->getFormat($subnode->text());
            if ($format === NULL) return NULL;

            $subnode = $node->filter('.oldPrice')->first();
            if ($subnode->count()) $price = $this->getPrice($subnode->text());
            if ($price === NULL) return NULL;

            $subnode = $node->filter('.prodPrice')->first();
            if ($subnode->count()) $special = $this->getPrice($subnode->text());

            $subnode = $node->filter('.packUnits')->first();
            if ($subnode->count()) $qty = $this->getQty($subnode->text());

            $response = array(
                'format' => $format,
                'qty' => $qty,
                'price' => ($qty > 1) ? round($price/$qty, 2) : $price,
                'special_price' => ($qty > 1) ? round($special/$qty, 2) : $special,
            );

            return $response;

        });

        return array_filter($response);

    }
}
