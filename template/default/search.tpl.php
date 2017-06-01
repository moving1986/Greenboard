<? if($_SESSION['msg']) : ?>
    <?=$_SESSION['msg'];?>
    <? unset($_SESSION['msg']);?>
<? endif;?>
<? if($name_razd): ?>
    <h4>Раздел: <?=$name_razd;  ?></h4>
<? endif; ?>
<?php if(is_array($text)): ?>
    <h2>Результаты поиска:</h2>
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
                    <a href="?<?=$url;?>page=1">Первая</a>
                </li>
            <? endif; ?>

            <? if($navigation['last_page']) :?>
                <li>
                    <a href="?<?=$url;?>page=<?=$navigation['last_page']?>">&lt;</a>
                </li>
            <? endif; ?>

            <? if($navigation['previous']) :?>
                <? foreach($navigation['previous'] as $val) :?>
                    <li>
                        <a href="?<?=$url;?>page=<?=$val;?>"><?=$val;?></a>
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
                        <a href="?<?=$url;?>page=<?=$v;?>"><?=$v;?></a>
                    </li>
                <? endforeach; ?>
            <? endif; ?>
            <? if($navigation['next_pages']) :?>
                <li>
                    <a href="?<?=$url;?>page=<?=$navigation['next_pages']?>">&gt;</a>
                </li>
            <? endif; ?>

            <? if($navigation['end']) :?>
                <li class="last">
                    <a href="?<?=$url;?>page=<?=$navigation['end']?>">Последняя</a>
                </li>
            <? endif; ?>
        </ul>

    <? endif;?>
<? else: ?>
    <h3><?=$msg;?></h3>
<?php endif;?>