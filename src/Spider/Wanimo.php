<?php

namespace TET\Spider;

use Goutte\Client;

class Wanimo extends Spider {

    private $first = true;
    private $first_price = null;
    private $first_special_price = null;
    
    public function validate($url) {
        return preg_match('/www.wanimo./', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);
 
        $response = $crawler->filter('.fake-table div.row')->each(function ($node) {
            $format = $price = $special_price = null;

            //Format & Qty
            $subnode = $node->filter('div:nth-child(3)')->first();
            $format =$this->getFormat($subnode->text());
            
            if(!$format){
                $subnode = $node->filter('div:nth-child(4)')->first();
                $format =$this->getFormat($subnode->text());  
            }
            
            $qty = $this->getQty($subnode->text());
            if(empty($qty)) $qty = 1;
     
            //Price
            $subnode = $node->filter('div:nth-child(5)')->first();
            if ($subnode->count()){
                $old_price_node = $subnode->filter('.old-price')->first();
                if ($old_price_node->count()){
                    //There is a special price
                    $price = $this->getPriceRegex($old_price_node->text());
                    
                    $special_price_node = $subnode->filter('.price')->first();
                    $special_price = $this->getPriceRegex($special_price_node->text());
                }else{
                    $price_node = $subnode->filter('.price')->first();
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
