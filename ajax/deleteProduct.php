<?php
require_once "../config/init.php";
if ($_POST) {
  $productDetail = new \app\models\ProductDetail();
  echo json_encode($productDetail->delete($_POST["id"]));
  exit();
}