<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-11-16
 * Time: 1:59 PM
 */

namespace app\models;


class AppModel
{
  public function safe($text)
  {
    return trim(htmlspecialchars($text));
  }
}