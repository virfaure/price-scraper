<?php

namespace TET\Spider;

use Goutte\Client;

abstract class Spider {

    protected $client;

    public function __construct() {
        $this->client = new Client(array(
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.115 Safari/537.36',
        ));
    }

    protected function getPrice($price) {
        $price = trim($price);
        $price = str_replace('EUR', '', $price);
        $price = str_replace(array(',', '€', ' ', '£'), array('.', '', '', ''), $price);
        return floatval($price);
    }

    protected function getFormat($text) {
        $matches = $matchesAdd = array();
        
        //For 15(Kg) + 1 free ! = 16Kg
        if(preg_match('/([\d,\.]+)\s*(?:kg|g)*\s*\+\s*([\d,\.]+)\s*(kg|g)/i', $text, $matchesAdd)){
            $format = str_replace(',', '.', $matchesAdd[1]) + str_replace(',', '.', $matchesAdd[2]);
            if (strtolower($matchesAdd[3]) == 'g') $format /= 1000;
        }else{
            if (!preg_match('/([\d,\.]+)\s*(kg|g)/i', $text, $matches)) return NULL;
            $format = str_replace(',', '.', $matches[1]);
            if (strtolower($matches[2]) == 'g') $format /= 1000;
        }
        
        return $format;
    }
    
    protected function getQty($text) {
        $matches = array();
        $type = null;

        // Matches 2x, latas de, boîtes de
        if (preg_match('/(\d+)\s*[xlatsboîde ]+\s*\d/i', $text, $matches1)){
            $type = 1;
        }
        else{
            // Matches x2
            if (preg_match('/x\s*(\d+)/i', $text, $matches2)){
                $type = 2;
            }
        }
        // Matches 4 x 100 Gr (Pack x 6)
        if (preg_match('/(\d+)\s*x[\w()\s]+x\s*(\d+)/i', $text, $matches3))
            $type = 3;

        switch($type){
            case 1:
                $qty = (int)$matches1[1];
                break;
            case 2:
                $qty = (int)$matches2[1];
                break;
            case 3:
                $qty = (int)($matches3[1] * $matches3[2]);
                break;
            default:
                return NULL;
        }

        return $qty;
    }
    
    protected function getPriceRegex($text) {
        $matches = array();
        // http://stackoverflow.com/questions/18129139/regex-with-euro-symbol
        if (!preg_match('/([\d,\.]+)(&nbsp;|\s)*(EUR|&euro;|\p{Sc})/ui', $text, $matches)) return NULL;
        $price = str_replace(array(',', ' '), array('.', ''), $matches[1]);
        return $price;
    }

    abstract public function validate($url);
    abstract public function parse($url);

}
