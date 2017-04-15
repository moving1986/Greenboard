<?php
//print_r($_REQUEST);
//die();**
if ($_GET['hash']) {

//    print_r($_GET);
//    die();
    $confirm = confirm();

    if ($confirm === TRUE) {
        $_SESSION['msg'] = "Ваша учетная запись активирована. Можете авторизироваться на сайте.";
        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
} else {
//	$_SESSION['msg'] = $msg;
//	echo '<pre>';
//	print_r($_SERVER);
//	die();
//	header("Location:".$_SERVER['PHP_SELF']);
//
//	exit();
}

if (isset($_POST['reg'])) {

//	print_r($_POST);
//	die();
    $msg = registration($_POST);

    if ($msg === TRUE) {
        $_SESSION['msg'] = "Вы успешно зарегистрировались на сайте. И для подтвержения регистрации  Вам на посту отправлено писмо с инструкциями.";
        header("Location:" . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['msg'] = $msg;
    }

}
$content = render(TEMPLATE . "registration.tpl", array("title" => "hello"));
