<?php
/**
 * @file
 * Test Calculator class for two year warranty
 */

use App\Calculator;
use PHPUnit\Framework\TestCase;

/**
 * test for product price that over or under the config product price range
 */

class CalculatorTestTwoYearsOffset extends TestCase
{
    
    protected $productPrice;
    protected $product;
    protected $options;

    public function setUp() : void
    {
        $this->productPrice = rand(120000, 200000);
        $this->productPrice = rand(0, 15000);
        $this->product = new Calculator($this->productPrice);
        print_r($this->product);
        $this->years = 2;
        $this->params = [];
    }

    function testTwoYearWarrantyWithSetup()
    {
        $this->params = ['setup'=>true, 'temporaryDevice'=>false];
        $this->assertEquals(
            "Product at this price is not subject of this offer yet",
            $this->product->calculate($this->years, $this->params)
        );
    }
}