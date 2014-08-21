<?php

namespace TET\Spider;

use Goutte\Client;

class Bypets extends Spider {
    
    public function validate($url) {
        return preg_match('/www.bypets.com/', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);

        $response = $crawler->filter('.product-info-table tbody tr')->each(function ($node) {
            $format = $price = $special_price = null;
            
            //Format
            $subnode = $node->filter('td:nth-child(1)')->first();
            if ($subnode->count()) $format = $this->getFormat($subnode->text());
            
            //Qty
            $qty = $this->getQty($subnode->text());
            if(empty($qty)) $qty = 1;
            
            //Price
            $subnode = $node->filter('td:nth-child(3)')->first();
            if ($subnode->count()){
                $old_price_node = $subnode->filter('.old-price')->first();
                if ($old_price_node->count()){
                    //There is a special price
                    $price = $this->getPriceRegex($old_price_node->text());
                    
                    $special_price_node = $subnode->filter('.special-price')->first();
                    $special_price = $this->getPriceRegex($special_price_node->text());
                }else{
                    $price_node = $subnode->filter('.regular-price')->first();
                    $price = $this->getPriceRegex($price_node->text());
                }
            }
     
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
