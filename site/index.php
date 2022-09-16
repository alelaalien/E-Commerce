<?php 
 
ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "C:\xampp\htdocs\PROYECTOS\eccomerce\php_error_log");
require_once 'view/modules/mail.php';
require_once "controller/template_c.php";
require_once "controller/menu_c.php";
require_once "controller/slide_c.php";
require_once "controller/product_c.php";
require_once "controller/functions.php";
require_once "controller/user_c.php";

require_once "model/template_m.php";
require_once "model/menu_m.php";
require_once "model/slide_m.php";
require_once "model/product_m.php";
require_once "model/user_m.php";
require_once "extensiones/vendor/autoload.php";

 

$template= new Template_c();
$template -> template();