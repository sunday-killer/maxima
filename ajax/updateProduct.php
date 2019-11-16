<?php
require_once "../config/init.php";
if ($_POST) {
  $productDetail = new \app\models\ProductDetail();
  echo json_encode($productDetail->update($_POST["id"], $_POST["name"], $_POST["price"], $_POST["description"], $_POST["details"]));
  exit();
}