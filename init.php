<?php



define("LIBS_DIR",  __DIR__ . DIRECTORY_SEPARATOR. "libs");
define("MODEL_DIR",  __DIR__ . DIRECTORY_SEPARATOR. "models");
define("VIEW_DIR", __DIR__ . DIRECTORY_SEPARATOR . "views");
define("JS_DIR", __DIR__ . DIRECTORY_SEPARATOR . "js");
define("CSS_DIR", __DIR__ . DIRECTORY_SEPARATOR . "css");
define("HOST", $_SERVER["HTTP_HOST"]);

require LIBS_DIR . DIRECTORY_SEPARATOR . "Database.php";
include LIBS_DIR . DIRECTORY_SEPARATOR . "DatabaseHelper.php";
include LIBS_DIR . DIRECTORY_SEPARATOR . "StringHelper.php";



$config = include("config/config.php");

$db = new Database($config['db']);
