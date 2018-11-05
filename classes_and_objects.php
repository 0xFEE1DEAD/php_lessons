<?php

class Thing {
  public function __construct($weight = null, $color = null, $category = null) {
    if (isset($weight)) {
      $this -> weight = $weight;
    }
    if (isset($color)) {
      $this -> color = $color;
    }
    if (isset($category)) {
      $this -> category = $category;
    }
  }
  
  public function getWeight() {
  	return $this -> weight; 
  }
  public function getColor() {
    return $this -> color;
  }
  public function getCategory() {
    return $this -> category;
  }
  public function setWeight($value) {
  	$this -> weight = $value; 
  }
  public function setColor($value) {
    $this -> color = $value; 
  }
  public function setCategory($value) {
    $this -> category = $value;
  }
  
	private $weight = 'None';
  private $color = 'None';
  private $category = 'None';
}

class Computer extends Thing {
  
  function __construct(
    $weight = null, 
    $color = null, 
    $category = null, 
    $ram_capacity = null,
    $hdd_capacity = null,
    $manufacturer = null,
    $model = null
 	)
  {
    if (isset($ram_capacity)) {
      $this -> ram_capacity = $ram_capacity;
    }
    if (isset($hdd_capacity)) {
      $this -> hdd_capacity = $hdd_capacity;
    }
    if (isset($manufacturer)) {
      $this -> manufacturer = $manufacturer;
    }
    if (isset($model)) {
      $this -> model = $model;
    }
    parent::__construct($weight, $color, $category);
  }
  
  public function getRamCapacity() {
  	return $this -> ram_capacity; 
  }
  
  public function getHDDCapacity() {
  	return $this -> hdd_capacity; 
  }
  
  public function getManufacturer() {
  	return $this -> manufacturer; 
  }
  
  public function getModel() {
  	return $this -> model; 
  }
  
  public function setRamCapacity($value) {
  	$this -> ram_capacity = $value; 
  }
  
  public function setHDDCapacity($value) {
  	$this -> hdd_capacity = $value; 
  }
  
  public function setManufacturer($value) {
  	$this -> manufacturer = $value; 
  }
  
  public function setModel($value) {
  	$this -> model = $value; 
  }
  
  private $ram_capacity = 'None';
  private $hdd_capacity = 'None';
  private $manufacturer = 'None';
  private $model = 'None';
}

$comp1 = new Computer('5,74kg', 'black', 'Компьютеры', '8GiB', '1TiB', 'HaP', 'some-model334v7');
echo $comp1 -> getWeight() . '<br>';
echo $comp1 -> getColor() . '<br>';
echo $comp1 -> getCategory() . '<br>';
echo $comp1 -> getRamCapacity() . '<br>';
echo $comp1 -> getHDDCapacity() . '<br>';
echo $comp1 -> getManufacturer() . '<br>';
echo $comp1 -> getModel() . '<br><hr>';

$comp2 = new Computer('6kg', 'black', 'Компьютеры', '16GiB', '1TiB', 'HaP', 'some-model334v8');
echo $comp2 -> getWeight() . '<br>';
echo $comp2 -> getColor() . '<br>';
echo $comp2 -> getCategory() . '<br>';
echo $comp2 -> getRamCapacity() . '<br>';
echo $comp2 -> getHDDCapacity() . '<br>';
echo $comp2 -> getManufacturer() . '<br>';
echo $comp2 -> getModel() . '<br><hr>';

$comp2 -> setWeight('6,2kg');
$comp2 -> setRamCapacity('32GiB');
$comp2 -> setModel('some-model334v9');
  
echo $comp2 -> getWeight() . '<br>';
echo $comp2 -> getColor() . '<br>';
echo $comp2 -> getCategory() . '<br>';
echo $comp2 -> getRamCapacity() . '<br>';
echo $comp2 -> getHDDCapacity() . '<br>';
echo $comp2 -> getManufacturer() . '<br>';
echo $comp2 -> getModel() . '<br><hr>';