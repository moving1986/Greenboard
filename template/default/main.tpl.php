
<? if($_GET['page']<=1) : ?>
<h3>Рад приветствовать вас на нашем сайте.</h3>
<p>Этот сайт является доской объявлений на которой все и каждый может разместить свои объявления,
как вы могли заметить данный сайт имеет тематику саб и огород короче все оригинально и полезно.</p>
<? endif; ?>
<? if($_SESSION['msg']) : ?>
    <?=$_SESSION['msg'];?>
    <? unset($_SESSION['msg']);?>
<? endif;?>
<? if($name_razd): ?>
<h4>Раздел: <?=$name_razd;  ?></h4>
<? endif; ?>
<?php if($text): ?>
    <? foreach ($text as $item): ?>

        <div class="post">
            <img src="files/mini/<?=$item['img'];?>" width="220" alt="" />
            <div class="post-text">
                <h3><a href="?action=view_mess&id=<?=$item['id'];?>"><?=$item['title'];?></a></h3>

                <p><?=$item['text'];?> </p><br /><br /><br /><br /><br />
                <strong><?=$item['price'];?> руб/т.</strong><em><?=date("d.m.Y",$item['date']) ?></em><br />
            </div>
        </div>

    <? endforeach;?>
    <? if($navigation) :?>
        <ul class="pager">
            <? if($navigation['first']) :?>
                <li class="first">
                    <a href="?action=main&page=1<?=$id_r;?>">Первая</a>
                </li>
            <? endif; ?>

            <? if($navigation['last_page']) :?>
                <li>
                    <a href="?action=main&page=<?=$navigation['last_page']?><?=$id_r;?>">&lt;</a>
                </li>
            <? endif; ?>

            <? if($navigation['previous']) :?>
                <? foreach($navigation['previous'] as $val) :?>
                    <li>
                        <a href="?action=main&page=<?=$val;?><?=$id_r;?>"><?=$val;?></a>
                    </li>
                <? endforeach; ?>
            <? endif; ?>

            <? if($navigation['current']) :?>
                <li>
                    <span><?=$navigation['current'];?></span>
                </li>
            <? endif; ?>

            <? if($navigation['next']) :?>
                <? foreach($navigation['next'] as $v) :?>
                    <li>
                        <a href="?action=main&page=<?=$v;?><?=$id_r;?>"><?=$v;?></a>
                    </li>
                <? endforeach; ?>
            <? endif; ?>
            <? if($navigation['next_pages']) :?>
                <li>
                    <a href="?action=main&page=<?=$navigation['next_pages']?><?=$id_r;?>">&gt;</a>
                </li>
            <? endif; ?>

            <? if($navigation['end']) :?>
                <li class="last">
                    <a href="?action=main&page=<?=$navigation['end']?><?=$id_r;?>">Последняя</a>
                </li>
            <? endif; ?>
        </ul>

    <? endif;?>
    <? else: ?>
    <h3>Объявлений нет</h3>
<?php endif;?>