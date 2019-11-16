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

  public function read($id)
  {
    $id = (int)$id;
    return R::load('productdetail', $id);
  }

  public function get($id)
  {
    $id = (int)$id;
    return R::getAssoc('
    SELECT
    pd.id, pd.product_id, p.name, p.description, pd.price, pd.details
    FROM `productdetail` pd
    INNER JOIN `product` p
    ON pd.product_id = p.id
    WHERE pd.id = ?
    ', [$id]);
  }

  public function getList()
  {
    return R::getAssoc('
    SELECT
    pd.id, pd.product_id, p.name, p.description, pd.price, pd.details
    FROM `productdetail` pd
    INNER JOIN `product` p
    ON pd.product_id = p.id
    ORDER BY pd.id DESC
    ');
  }

  public function update($id, $name, $price, $description, $details)
  {
    $name = $this->safe($name);
    $price = (int)($price);
    $description = $this->safe($description);
    $details = $this->safe($details);

    $productDetail = $this->read($id);

    $instance_of_product = new Product();
    $product = $instance_of_product->findByName($name);

    if (is_null($product)) {
      $productId = $instance_of_product->create($name, $description);
      $productDetail->product_id = $productId;
    } else {
      $productDetail->product_id = $product->id;
      $product->description = $description;
      $productUpdate = R::store($product);
    }

    $productDetail->price = $price;
    $productDetail->details = $details;

    return R::store($productDetail);
  }

  public function delete($id)
  {
    $productDetail = $this->read($id);
    return R::trash($productDetail);
  }

}