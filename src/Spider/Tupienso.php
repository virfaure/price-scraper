<?php

namespace TET\Spider;

use Goutte\Client;

class Tupienso extends Spider {

    public function validate($url) {
        return preg_match('/www.tupienso./', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $main = $crawler->filter('#pb-left-column')->each(function ($node) {
            $format = NULL;
            $price  = NULL;
            $response = array();

            $subnode = $node->filter('h1')->first();
            if ($subnode->count()){
                $format = $this->getFormat($subnode->text());
                $qty = $this->getQty($subnode->text());
            }
            if ($format === NULL) return NULL;
            
            
            $subnode = $node->filter('#old_price_display')->first();
            if ($subnode->count()) $price = $this->getPrice($subnode->text());
            if ($price === NULL) return NULL;
            
            $subnode = $node->filter('#our_price_display')->first();
            if ($subnode->count()) $special = $this->getPrice($subnode->text());

            if ($special == $price) $special = NULL;
            
            $response = array(
                'format' => $format,
                'qty' => ($qty) ? $qty : 1,
                'price' => ($qty) ? round($price/$qty, 2) : $price,
                'special_price' => ($special) ? $special : NULL,
            );

            return $response;
        });

        $title = "";
        $node = $crawler->filter('#pb-left-column h1');
        if ($node->count()) {
            preg_match('/(.*) - (.*)/', $node->text(), $matches);
            $title = addslashes($matches[1]);
        }

        $others = $crawler->filter("#idTab4 .s_title_block:contains('$title')")->each(function ($node) {

            $format = NULL;
            $price  = NULL;
            $response = array();

            $format = $this->getFormat($node->text());
            if ($format === NULL) return NULL;

            $subnode = $node->filter('.our_price_display')->first();
            if ($subnode->count()) $price = $this->getPrice($subnode->text());
            if ($price === NULL) return NULL;

            $qty = $this->getQty($node->text());

            $response = array(
                'format' => $format,
                'qty' => ($qty) ? $qty : 1,
                'price' => ($qty) ? round($price/$qty, 2) : $price,
                'special_price' => NULL,
            );

            return $response;

        });

        $response = array_merge($main, $others);
        return array_filter($response);

    }
}
