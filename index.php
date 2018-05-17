<?php
session_start();
require "init.php";
include "Application.php";
include_once MODEL_DIR . "/User.php";

date_default_timezone_set("Asia/Ho_Chi_Minh");
//echo password_hash("123",PASSWORD_DEFAULT);
$app = new Application($config);
$app->run();
