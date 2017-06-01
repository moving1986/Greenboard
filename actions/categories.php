<?php
if($_GET['id_r']) {
    $id_r =(int) $_GET['id_r'];
}
if($_GET['page']) {
    $page =(int) $_GET['page'];
    if(!$page) {
        $page = 1;
    }
} else {
    $page = 1;
}
$count_mess = count_mess($id_r);
if($count_mess) {
    $text = get_mess($id_r,FALSE,$page,PERPAGE);
    if (is_array($text)) {
        $text = small_text($text);
    }
    $navigation = get_navigation($page,$count_mess,PERPAGE);
}
foreach($razd as $item) {
    if(array_search($id_r,$item)) {
        $name_razd = $item['name'];
        break;
    }
}
if($id_r) {
    $id_r = "&id_r=".$id_r;
}

$content = render(TEMPLATE."main.tpl",array(
    "text"=>$text,
    "navigation"=>$navigation,
    'id_r' => $id_r,
    'name_razd' => $name_razd
));
