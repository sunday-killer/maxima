<?php
require_once "../config/init.php";
if ($_POST) {
  $productDetail = new \app\models\ProductDetail();

  $validator = new \Rakit\Validation\Validator([
    'required' => 'Поле :attribute обязательно для заполнения',
    'numeric' => 'Значение поля :attribute должно быть числовым',
  ]);

  $validation = $validator->make($_POST, [
    'name'                  => 'required',
    'price'                 => 'required|numeric',
    'description'           => 'required',
    'details'               => 'required',
  ]);

  $validation->validate();

  if ($validation->fails()) {
    echo json_encode(['error' => $validation->errors()->firstOfAll()]);
    exit();
  } else {
    echo json_encode($productDetail->create($_POST["name"], $_POST["price"], $_POST["description"], $_POST["details"]));
  }
  exit();
}