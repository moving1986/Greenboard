<?php

if(isset($_POST['email'])) {
	$msg = get_password($_POST['email']);
	
	if($msg === TRUE) {
		$_SESSION['msg'] = "Новый пароль выслан Вам на почту";
		header("Location:".$_SERVER['PHP_SELF']);
	}
	else {
		$_SESSION['msg'] = $msg;
		header("Location:".$_SERVER['PHP_SELF']);
	}
	exit();
}

$content = render(TEMPLATE."returnpass.tpl",array("title"=>"hello"));
?>