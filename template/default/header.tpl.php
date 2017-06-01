<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=TEMPLATE;?>style.css" rel="stylesheet" type="text/css" />
    <meta name="keywords" content="keywords" />
    <meta name="description" content="description" />
    <meta name="language" content="Russian">
    <title><?=SITE_NAME_HEADER; ?></title>
    <meta http-equiv= "X-UA-Compatible" content="IE=edge">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/
trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">
 <header>
     <div id="first-line">
         <div id="logo"><img src="<?=TEMPLATE;?>src/logo.png" alt="" /></div>
         <div id="main-slogon">Доска бесплатных<br /> объявлений по продаже<br /> семян и саженцев</div>
         <? if($add_mess): ?>
         <div id="send_mess">Подать объявление</div>
         <? endif; ?>
         <? if(!$user): ?>
         <div id="enter"><a href="?action=login" title="">Вход</a> | <a href="?action=registration" title="">Регистрация</a></div>
         <? else: ?>
         <div id="enter">Здравствуйте <? echo $user['name']; ?> | <a href="?action=login&logout=1" title="">Выход</a></div>
         <? endif; ?>
     </div>
     <ul>
            <? if($razd && is_array($razd)) :?>
             <? foreach($razd as $item) :?>
                 <li><a href="?action=main&amp;id_r=<?=$item['id']?>"><?=$item['name']?></a></li>
             <? endforeach;?>
         <? endif;?>
     </ul>