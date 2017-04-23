<?php
if (!$user || !can($user['id_role'],array("add_mess"))) {
    $text = "Доступ запрещен!";
    $content = render(TEMPLATE . "error.tpl", array("text"=>"$text"));
} else {
    if($_POST) {
        $msg = add_mess($_POST, $user['user_id']);
        if($msg === TRUE) {
            $_SESSION['msg'] = "Ваше объявление успешно добавлено и ожидает проверки модератором";
        } else {
            $_SESSION['msg'] = $msg;
        }
        header("Location:?action=add_mess");
        exit();
    }
    $content = render(TEMPLATE . "add_mess.tpl", array('categories'=>$categories,
        'razd'=>$razd));
}