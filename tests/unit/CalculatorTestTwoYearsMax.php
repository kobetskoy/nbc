<?php
/**
 * @file
 * Test Calculator class for two year warranty
 */

use App\Calculator;
use PHPUnit\Framework\TestCase;

/**
 * test for max product price with two year warranty and different options
 */

class CalculatorTestTwoYearsMax extends TestCase
{
    
    protected $productPrice;
    protected $product;
    protected $options;

    public function setUp() : void
    {
        $this->productPrice = rand(100000, 120000);
        $this->product = new Calculator($this->productPrice);
        print_r($this->product);
        $this->years = 2;
        $this->params = [];
    }

    function testOnlyTwoYearWarranty()
    {
        $this->assertEquals(4190, $this->product->calculate($this->years, $this->params));
    }

    function testTwoYearWarrantyWithOptions()
    {
        $this->params = ['setup'=>true, 'temporaryDevice'=>true];
        $this->assertEquals(5690, $this->product->calculate($this->years, $this->params));
    }

    function testTwoYearWarrantyWithTempDevice()
    {
        $this->params = ['temporaryDevice'=>true];
        $this->assertEquals(4940, $this->product->calculate($this->years, $this->params));
    }
    
    function testTwoYearWarrantyWithSetup()
    {
        $this->params = ['setup'=>true, 'temporaryDevice'=>false];
        $this->assertEquals(4940, $this->product->calculate($this->years, $this->params));
    }
}