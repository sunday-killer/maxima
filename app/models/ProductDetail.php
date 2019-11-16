<?php
namespace app\models;
use RedBeanPHP\R;

class ProductDetail extends AppModel
{

  public function create($name, $price, $description, $details)
  {
    $name = $this->safe($name);
    $price = (int)($price);
    $description = $this->safe($description);
    $details = $this->safe($details);

    $instance_of_product = new Product();
    $product = $instance_of_product->findByName($name);

    $productDetail = R::dispense('productdetail');

    if (is_null($product)) {
      $productId = $instance_of_product->create($name, $description);
      $productDetail->product_id = $productId;
    } else {
      $productDetail->product_id = $product->id;
    }

    $productDetail->price = $price;
    $productDetail->details = $details;

    return R::store($productDetail);
  }

}