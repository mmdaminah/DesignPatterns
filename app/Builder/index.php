<?php

namespace Builder {


    interface Builder
    {
        public function productPartA($part);

        public function productPartB($part);

        public function productPartC($part);
    }

    class Product
    {
        public $parts = [];

        public function listParts()
        {
            echo "Product parts" . implode(', ', $this->parts) . "<br>";
        }
    }

    class ConcreteBuilder implements Builder
    {
        private Product $product;

        public function reset()
        {
            $this->product = new Product();
            return $this;
        }

        public function productPartA($part)
        {
            $this->product->parts[] = $part;
            return $this;
        }

        public function productPartB($part)
        {
            $this->product->parts[] = $part;
            return $this;
        }

        public function productPartC($part)
        {
            $this->product->parts[] = $part;
            return $this;
        }

        public function getProduct()
        {
           return $this->product;
        }
    }

    $builder = new ConcreteBuilder();
    $product = $builder->reset()
        ->productPartA("part 1")
        ->productPartB("part 2")
        ->productPartC("part 3")
        ->getProduct();
    $product->listParts();
    $product2 = $builder->reset()
        ->productPartA("part 1")
        ->productPartC("part 3")
        ->getProduct();
    $product2->listParts();
}
