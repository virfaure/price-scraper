<?php

namespace TET\Spider;

use Goutte\Client;

class Petclic extends Spider {
    
    public function validate($url) {
        return preg_match('/www.petclic.es/', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('.add-to-cart-form ul li')->each(function ($node) {
            $format = $price = $special_price = null;

            //Format
            $subnode = $node->filter('div.title-wrapper')->first();
            if ($subnode->count()) $format = $this->getFormat($subnode->text());

            //Qty
            $matches = array();
            $qty = 1;
            if (preg_match('/(\d+)\s*[unidades]+/is', $subnode->text(), $matches)){
                if(!empty($matches[1])) $qty = (int)$matches[1];
            }
            
            //Price
            $subnode = $node->filter('div.sell-price')->first();
            if ($subnode->count()) $price = $this->getPriceRegex($subnode->text());
     
            $response = array(
                'format' => $format,
                'qty' => $qty,
                'price' => ($price/$qty),
                'special_price' => ($special_price/$qty),
            );
            
            return $response;
        });
        
        return array_filter($response);

    }
}
