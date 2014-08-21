<?php

namespace TET\Model;

class Price extends \Model {
    public static $_table = 'price';
    public function site() {
        return $this->belongs_to('TET\Model\Site');
    }
    public function product() {
        return $this->belongs_to('TET\Model\Product');
    }
}
