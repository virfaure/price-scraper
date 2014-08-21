<?php

namespace TET\Model;

class Page extends \Model {
    public static $_table = 'page';
    public function products() {
        return $this->has_many_through('TET\Model\Product', 'TET\Model\PageProduct');
    }
}
