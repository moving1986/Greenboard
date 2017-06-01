<?php
if (!$user) {
    $text = "Доступ запрещен!";
    $content = render(TEMPLATE . "error.tpl", array("text"=>"$text"));
}else {
    if ($_POST) {
        $id_mess =(int) $_POST['id'];
        $actual_t =(int) $_POST['time'];
        if(check_you_mess($user['user_id'], $id_mess)){
            $msg = update_actual_time($id_mess,$actual_t);
            if($msg === TRUE) {
                $_SESSION['msg'] = "Актуальность объявления изменена";
                header("Location:?action=p_mess");
            }
            else {
                $_SESSION['msg'] = $msg;
            }
            header("Location:?action=p_mess");
            exit();
        }

    }
        if ($_GET['delete']) {
        $id_mess =(int)$_GET['delete'];
        if(check_you_mess($user['user_id'], $id_mess)){
            $msg = delete_mess($id_mess);
            if($msg === TRUE) {
                $_SESSION['msg'] = "Удалено";
                header("Location:?action=p_mess");
            }
            else {
                $_SESSION['msg'] = $msg;
            }
            header("Location:?action=p_mess");
            exit();
        }

    }
    $text = get_p_mess($user['user_id'] );
    if (is_array($text)) {
        $text = small_text($text);
    }
    $content = render(TEMPLATE . "p_mess.tpl", array(
        'text' => $text
    ));
}