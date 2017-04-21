<?php
header("content-type:text/html;charset=UTF-8");

session_start();

require_once "config.php";
require_once "functions.php";

db(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$catigories = get_categories();
if(isset($catigories)) {
	echo "Он есть";
} else {echo "Его нет";}
$razd = get_razdel();
$user = check_user();

if ($user) {
	$add_mess = can($user['id_role'],array("add_mess"));
}

$action = clear_str($_GET['action']);
if(!$action) {
	$action = "main";
}

if(file_exists(ACTIONS.$action.".php")) {
	include ACTIONS.$action.".php";
}
else {
	include ACTIONS."main.php";
}

require_once TEMPLATE."/index.php";
