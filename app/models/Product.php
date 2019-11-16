<?php
namespace app\models;
use RedBeanPHP\R;

class Product extends AppModel
{
  public function __construct()
  {
    \core\Db::instance();
  }

  public function create($name, $description)
  {
    $name = $this->safe($name);
    $description = $this->safe($description);

    $product = R::dispense( 'product' );
    $product->name = $name;
    $product->description = $description;

    return R::store($product);
  }

  public function read($id)
  {
    $id = (int)$id;
    return R::load('product', $id);
  }

  public function update($id, $name, $description)
  {
    $name = $this->safe($name);
    $description = $this->safe($description);

    $product = $this->read($id);
    $product->name = $name;
    $product->description = $description;

    return R::store($product);
  }

  public function delete($id)
  {
    $product = $this->read($id);
    return R::trash($product);
  }

  public function findByName($name)
  {
    return R::findOne('product', ' name LIKE ? LIMIT 1', [ $name ]);
  }

}