<?php

if(!$user) {
    $text = "Доступ запрещен";
    $content = render(TEMPLATE."error.tpl",array("text"=>$text));
}
else {
    if($_GET['id']) {
        $id_mess = (int)$_GET['id'];

        if(check_you_mess($user['user_id'],$id_mess)) {

            if($_POST) {
                $msg = edit_mess($_POST,$user['user_id']);

                if($msg === TRUE) {
                    $_SESSION['msg'] = "Успешно изменено. Ожидает проверки модератора.";
                    header("Location:?action=p_mess");
                }
                else {
                    $_SESSION['msg'] = $msg;
                    header("Location:?action=edit_mess&id=".$id_mess);
                }
                exit();
            }

            $text = get_e_mess($id_mess);

            if($text['is_actual'] == 0) {
                $actual = "Не актуально";
            }
            else {
                $d_left = round(($text['time_over']-time())/(60*60*24));
                $e_n = substr($d_left,(strlen($d_left)-1));

                if($d_left > 4 && $d_left < 21) $d_left .= " дней";
                elseif($e_n == 1) $d_left .= " день";
                elseif($e_n == 2 || $e_n == 3 || $e_n == 4) $d_left .= " дня";
                else $d_left .= " дней";
            }
            $content = render(TEMPLATE."edit_mess.tpl",array(
                'categories'=>$categories,
                'razd' => $razd,
                'text'=>$text,
                'd_left' => $d_left
            ));
        }
        else {
            $text = "Доступ запрещен";
            $content = render(TEMPLATE."error.tpl",array("text"=>$text));
        }
    }
}

