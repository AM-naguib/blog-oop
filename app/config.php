<?php
session_start();
define("MAIN_PATH", dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define("URL", "http://127.0.0.1/my-projects/blogoop/");
require_once MAIN_PATH . "app/db.php";
require_once MAIN_PATH . "app/sanitizer.php";
require_once MAIN_PATH . "app/validation.php";
require_once MAIN_PATH . "app/helper.php";


$validation = new Validation();
$sanitizer = new Sanitizer();
$helper = new Helper();
$db = new Db();



