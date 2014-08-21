<?php

namespace TET\Spider;

use Goutte\Client;

class Kiwoko extends Spider {

    public function validate($url) {
        return preg_match('/www.kiwoko.com/', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = array();

        // First guess: radio buttons
        $response = $crawler->filter('.label-radio-configurable input')->each(function($node) {
            $format = $this->getFormat($node->text());
            $price = $this->getPriceRegex($node->text());
            $response = array(
                'format' => $format,
                'qty' => 1,
                'price' => $price,
                'special_price' => NULL,
            );
            return $response;
        });

        // Look for regular-price, old-price and special-price
        if (count($response) == 0) {

            $price = $special_price = $qty = $format = NULL;

            $node = $crawler->filter('h1')->first();
            if ($node->count()) $format = $this->getFormat($node->text());

            if ($format === NULL) {
                $node = $crawler->filter('div #tab-description')->first();
                if ($node->count()) $format = $this->getFormat($node->text());
            }

            $node = $crawler->filter('.regular-price .price')->first();
            if ($node->count()) $price = $this->getPriceRegex($node->text());

            if ($price) {

                $special_price = NULL;

            } else {

                $node = $crawler->filter('.old-price .price')->first();
                if ($node->count()) $price = $this->getPriceRegex($node->text());

                $node = $crawler->filter('.special-price .price')->first();
                if ($node->count()) $special_price = $this->getPriceRegex($node->text());
            }

            if ($price !== NULL && $format !== NULL) {
                $response[] = array(
                    'format' => $format,
                    'qty' => 1,
                    'price' => $price,
                    'special_price' => ($special_price !== NULL) ? $special_price : NULL,
                );
            }

        }

        return $response;

    }
}
