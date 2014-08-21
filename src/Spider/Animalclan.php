<?php

namespace TET\Spider;

use Goutte\Client;

class Animalclan extends Spider {

    public function validate($url) {
        return preg_match('/www.animalclan./', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('#tb_product tbody tr')->each(function ($node) {

            $response = array();
            $format = NULL;
            $price = NULL;

            $subnode = $node->filter('td:nth-child(2)')->first();
            if ($subnode->count()) $format = $this->getFormat($subnode->text());
            if ($format === NULL) return NULL;

            $subnode = $node->filter('td:nth-child(4)')->first();
            if ($subnode->count()) $price = $this->getPrice($subnode->text());
            if ($price === NULL) return NULL;

            $subnode = $node->filter('td:nth-child(5)')->first();
            if ($subnode->count()) $special = $this->getPrice($subnode->text());

            $response = array(
                'format' => $format,
                'qty' => 1,
                'price' => $price,
                'special_price' => ($special) ? $special : NULL,
            );

            return $response;

        });

        return array_filter($response);
    }
}
