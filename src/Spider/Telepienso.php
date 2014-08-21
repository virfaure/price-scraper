<?php

namespace TET\Spider;

use Goutte\Client;

class Telepienso extends Spider {

    public function validate($url) {
        return preg_match('/www.telepienso.com/', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('label')->each(function ($node) {

            $price = $format = NULL;
            $response = array();
            $matches = array();
            $pattern = '/([\d,\.]+).*\s*-\s*([\d,\.]+\s*kg)/i';

            if(preg_match_all($pattern, $node->text(), $matches, PREG_SET_ORDER)){
                foreach ($matches as $match) {
                    $special  = $this->getPrice($match[1]);
                    $format = $this->getFormat($match[2]);
                }
            }
            if ($format === NULL) return NULL;

            $subnode = $node->filter('em span')->first();
            if ($subnode->count()) $price = $this->getPrice($subnode->text());
            if ($price === NULL) return NULL;

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
