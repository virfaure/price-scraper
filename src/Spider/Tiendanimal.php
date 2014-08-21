<?php

namespace TET\Spider;

use Goutte\Client;

class Tiendanimal extends Spider {

    private $first = true;
    private $first_price = null;
    private $first_special_price = null;
    
    public function validate($url) {
        return preg_match('/www.tiendanimal./', $url);
    }

    public function parse($url) {

        $crawler = $this->client->request('GET', $url);
        
        //Price of first format
        $nodePriceS = $crawler->filter('.priceMag s')->first();
        if ($nodePriceS->count()) {
            //Normal Price
            $this->first_price = $this->getPrice($nodePriceS->text());
        }
        
        $nodePrice = $crawler->filter('.priceMag .priceMag')->first();
        if ($nodePrice->count()) {
            if($this->first_price) $this->first_special_price = $this->getPrice($nodePrice->text());
            else $this->first_price = $this->getPrice($nodePrice->text());
        }

        $response = $crawler->filter('.opt')->each(function ($node) {

            $format =$this->getFormat($node->text());
            $qty = $this->getQty($node->text());
            $subnode_price = null;
        
            //Price
            $subnode = $node->filter('span:nth-child(3)')->first();
            if($subnode->count()){
                try{
                    $subnode_price = $node->filter('span:nth-child(2)')->first();
                }
                catch (Exception $e){
                    print("Exception: ".$e->getMessage()."\n");
                    continue;
                }
            
                if ($subnode_price->getInfo()){
                    $price = $this->getPriceRegex($subnode_price->text());
                    $priceNode = $subnode_price->text();
                }
                $special_price = $this->getPriceRegex($subnode->text());
            }else{
                $priceNode = $node->text();
            
                $price = $this->getPriceRegex($priceNode);
                $special_price = null;
            }

            if(empty($price) && $this->first){
                $price = $this->first_price;
                if($this->first_special_price) $special_price = $this->first_special_price;
                $this->first = false;
            }
            
            //Check if price contains unidades
            $matches = array();
            if (preg_match('/(\d+)\s*x\s*([\d,\.]+)(&nbsp;|\s)*(?:EUR|&euro;|\p{Sc})/ui', $priceNode, $matches)){
                $price = ($matches[2] * $matches[1]);
            }
            
            if(empty($qty)) $qty = 1;
 
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
