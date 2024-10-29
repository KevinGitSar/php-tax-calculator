<?php
    class Product {
        public $productName;
        public $productPrice;
        public $productQuantity;
        public $productDiscount;

        public function __construct($productName, $productPrice, $productQuantity, $productDiscount){
            $this->productName = $productName;
            $this->productPrice = $productPrice;
            $this->productQuantity = $productQuantity;
            $this->productDiscount = $productDiscount;
        }

        // Convert the object to an associative array
        public function toArray() {
            return [
                'productName' => $this->productName,
                'productPrice' => $this->productPrice,
                'productQuantity' => $this->productQuantity,
                'productDiscount' => $this->productDiscount,
            ];
        }
    }
?>