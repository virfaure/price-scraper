<?php

namespace TET\Model;

class Site extends \Model {

    public static $_table = 'site';
    private $_spider = NULL;

    public function pages() {
        return $this->has_many_through('TET\Model\Page', 'TET\Model\PageProduct');
    }

    public function products() {
        return $this->has_many_through('TET\Model\Product', 'TET\Model\PageProduct');
    }

    public function prices() {
        return $this->has_many('TET\Model\Price');
    }

    public function getSpider() {
        if ($this->_spider === NULL) {
            if ($this->spider !== NULL) {
                $class_name = "\TET\Spider\\" . $this->spider;
                $this->_spider = new $class_name;
            }
        }
        return $this->_spider;
    }

}

