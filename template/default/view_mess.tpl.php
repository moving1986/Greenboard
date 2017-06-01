<div id="main">
    <? if($_SESSION['msg']) : ?>
        <?=$_SESSION['msg'];?>
        <? unset($_SESSION['msg']);?>
    <? endif;?>

    <?php if($text): ?>

    <div class="post_view">
        <h3><a href="?action=view_mess&id=<?=$text['id'];?>"><?=$text['title'];?></a></h3>
        <img src="files/<?=$text['img'];?>" width="400"  alt="" /> <br />
        <? if($img_s && is_array($img_s)) : ?>
            <? foreach($img_s as $item) : ?>
                <img src="files/mini/<?=$item;?>" width="220" />
            <? endforeach; ?>
        <? endif;?>
        <div class="post_v_more">
            Город: <?=$text['town'];?>&nbsp; | &nbsp; Автор: <?=$text['uname'];?>
        </div>



            <p><?=$text['text'];?> </p>
            <strong><?=$text['price'];?> руб/т.</strong><em><?=date("d.m.Y",$text['date']) ?></em><br />
        </div>

    </div>
</div>

<?php endif;?>