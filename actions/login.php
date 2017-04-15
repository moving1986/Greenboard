<?php

if(isset($_POST['login']) && isset($_POST['password'])) {

	$msg = login($_POST);
	
	if($msg === TRUE) {
		header("Location:".$_SERVER['PHP_SELF']);
	}
	else {
		$_SESSION['msg'] = $msg;
		header("Location:index.php?action=login");
	}
	exit();
	
}
if(isset($_GET['logout'])) {
	$msg = logout();
	
	if($msg === TRUE) {
		$_SESSION['msg'] = "Вы вышли из системы";
		header("Location:".$_SERVER['PHP_SELF']);
		exit();
	}
}

$content = render(TEMPLATE."login.tpl",array("title"=>"hello"));
?>