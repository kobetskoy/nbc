<?php

namespace App;

/**
 * Card price calculation class
 */
class Calculator
{
    protected $productPrice;
    protected $priceRange;
    protected $warranty;
    /**
     * * @param int   $price   input price of device
     * #@TODO rework to interface with json file for example
     */
    public function __construct($price)
    {
        $this->productPrice = $price;
        
        $this->baseCost = 1990;
        $this->options = [
            'setup' => 750,
            'temporaryDevice' => 750,
        ];
        $this->priceLimits = [
            ['minPrice'=>15800, '2'=>500, '3'=>1100],
            ['minPrice'=>35000, '2'=>800, '3'=>2500],
            ['minPrice'=>50000, '2'=>1100, '3'=>5200],
            ['minPrice'=>80000, '2'=>1400, '3'=>5000],
            ['minPrice'=>100000, '2'=>2200, '3'=>7700],
        ];
        $this->maxPrice = 120001;
    }

    /**
     * Function for calculating card price by device price and selected options
     * 
     * @param array $options selected options for calculations
     *
     * @return int
     */
    public function calculate($warranty, $options)
    {
        foreach ($this->priceLimits as $key=>$values) {
            $limit = isset($this->priceLimits[$key+1]['minPrice'])? $this->priceLimits[$key+1]['minPrice']: $this->maxPrice;
            if ($values['minPrice'] <= ($this->productPrice) 
                && ($this->productPrice) < $limit
            ) {
                return $this->baseCost + $values[$warranty] + $this->addOptionsPrice($options);
            }
        }

        return $this->getErrorMessage();
    }

    /**
     * Function for calculating options price
     * 
     * @param array $options
     * 
     * return int
     */
    public function addOptionsPrice($options)
    {
        $optionsCost = 0;
        foreach ($options as $key=>$option) {
            if ($option) {
                $optionsCost += $this->options[$key];
            }
        }
        return $optionsCost;
    }

    /**
     * Function for showing error if product price offset from config price range
     */
    public function getErrorMessage(){
        return "Product at this price is not subject of this offer yet";
    }
}