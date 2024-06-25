<?php

class ProductFilter {
    private $products;
  
    public function __construct($products) {
      $this->products = $products;
    }
  
    public function sortByABC() {
      usort($this->products, function($a, $b) {
        return strcmp($a->name, $b->name);
      });
    }
  
    public function sortByReviews() {
      usort($this->products, function($a, $b) {
        return $a->reviews < $b->reviews;
      });
    }
  
    public function sortByPrice($order) {
      if ($order === 'ASC') {
        usort($this->products, function($a, $b) {
          return $a->price < $b->price;
        });
      } else {
        usort($this->products, function($a, $b) {
          return $a->price > $b->price;
        });
      }
    }
  
    public function getProducts() {
      return $this->products;
    }
  }
?>