<?php
define('DEBUG', 1);
define('ROOT', dirname(__DIR__));
define("CORE", ROOT . "/vendor/core");
define("LIBS", ROOT . "/vendor/core/libs");
define("CONF", ROOT . "/config");

require_once ROOT . "/vendor/autoload.php";