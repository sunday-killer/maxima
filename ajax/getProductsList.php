<?php
require_once "../config/init.php";
$productDetail = new \app\models\ProductDetail();
echo json_encode($productDetail->getList());
exit();
