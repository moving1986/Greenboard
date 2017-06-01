
    <h1>Ваши объявления</h1>
    <? if($_SESSION['msg']) : ?>
        <?=$_SESSION['msg'];?>
        <? unset($_SESSION['msg']);?>
    <? endif;?>

<?php if($text): ?>
    <? foreach ($text as $item): ?>
     <div class="post">
        <img src="files/mini/<?=$item['img'];?>" width="220" alt="" />
        <div class="post-text">
            <h3><a href="?action=view_mess&id=<?=$item['id'];?>"><?=$item['title'];?></a></h3>
            <? if($item['confirm'] == 0) : ?>
                <p class="no_moder">Ваше объявление еще не проверено модератором</p>
            <? endif;?>
            <? if($item['is_actual'] == 0) : ?>>
                <h1>Уже не актуально</h1>
            <? endif;?>
            <p><?=$item['text'];?> </p>
            <strong><?=$item['price'];?> руб/т.</strong><em><?=date("d.m.Y",$item['date']) ?></em><br />
        </div>
         <p>
             <form method="post">
             Период актуальности объявления
             <select name="time">
                 <option value="10">10 дней</option>
                 <option value="15">15 дней</option>
                 <option value="20">20 дней</option>
                 <option value="30">30 дней</option>
             </select>
             <input type="hidden" name = "id" value="<?=$item['id'];?>">
             <input type="submit" value="Ok">
             &nbsp; | &nbsp;<a href="?action=edit_mess&id=<?=$item['id'];?>">Изменить объявление</a>
             &nbsp; | &nbsp;<a href="?action=p_mess&delete=<?=$item['id'];?>">Удалить объявление</a>
         </form>
         </p>
</div>

<? endforeach;?>
<?php endif;?>