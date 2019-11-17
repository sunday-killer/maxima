<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-11-17
 * Time: 9:13 PM
 */

class Product extends \PHPUnit\Framework\TestCase
{
  protected $product;

  public function setUp()
  {
    $this->product = new \app\models\Product();
  }

  /*public function testCreateProduct()
  {
    $this->assertIsInt($this->product->create('test', 'test'));
  }*/

}