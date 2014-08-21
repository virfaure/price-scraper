<?php

namespace TET\Model;

class Product extends \Model {
    public static $_table = 'product';
    public function pages() {
        return $this->has_many_through('TET\Model\Page', 'TET\Model\PageProduct');
    }
    public function prices() {
        return $this->has_many('TET\Model\Price');
    }
    public function page($site_id) {
    	return \ORM::for_table('page')
    		->select('page.*')
    		->join('page_product', array('page.id', '=', 'page_product.page_id'))
    		->join('product', array('page_product.product_id', '=', 'product.id'))
    		->where_equal('page_product.site_id', $site_id)
    		->where_equal('page_product.product_id', $this->id);
    }
}

