<? if($text['msg']) : ?>
    <?=$text['msg'];?>
    <? unset($text['msg']);?>
<? endif;?>
<?php if(is_array($text)) :?>
<h1>Редактирование объявления</h1>
<form method='POST' enctype="multipart/form-data">
    Тема:<br>
    <input type='text'  name='title' value="<?=$text['title'];?>">
    <input type='hidden'  name='id' value="<?=$text['id'];?>">
    <br>
    Текст:<br>
    <textarea rows="10" cols="60" name="text"><?=$text['text'];?></textarea>
    <br>
    Категории:<br />
    <select name="id_categories">
        <? if($categories) :?>
            <? foreach($categories as $key => $item) :?>
                <optgroup label="<?=$item[0]?>">
                    <? foreach($item['next'] as $k => $v) :?>
                        <? if($text['id_categories'] == $k) :?>
                            <option selected value="<?=$k?>">--<?=$v;?></option>
                        <? else: ?>
                            <option value="<?=$k?>">--<?=$v;?></option>
                        <? endif; ?>

                    <? endforeach;?>
                </optgroup>
            <? endforeach;?>
        <? endif;?>
    </select>
    <br />

    Выбеирте тип объявления:<br />
    <? if($razd) :?>
        <? foreach($razd as $item) :?>
            <? if($text['id_razd'] == $item['id']) :?>
            <input checked type="radio" name="id_razd" value="<?=$item['id']?>"><?=$item['name'];?>
            <? else:?>
                <input type="radio" name="id_razd" value="<?=$item['id']?>"><?=$item['name'];?>
            <? endif;?>
        <? endforeach; ?>
    <? endif; ?>
    <br />

    Город:<br>
    <input type='text' name='town' value="<?=$text['town'];?>">
    <br>

    Основное изображение:<br>
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <input type='file' name='img'><br />
    <img src="files/<?=$text['img'];?>" width="80px" /><br />
    Дополнительные изображения:<br>
    <input type='file' name='mini[]'><br />
    <input type='file' name='mini[]'>    <br />
    <? foreach(explode("|",$text['img_s']) as $item) :?>
        <img class="img" width="80px" src="<?=MINI.$item;?>">
    <? endforeach;?>
    <br /><br />

    Период актуальности объявления <? if ($d_left>0) :?>
        (еще актуально: <?=$d_left; ?>):
        <? endif ?>
       <? if ($d_left <= 0) :?>
           Не актуальное!!!
        <? endif; ?>
        <br />
    <select name="time">
        <option value="10">10 дней</option>
        <option value="15">15 дней</option>
        <option value="20">20 дней</option>
        <option value="30">30 дней</option>
    </select>
    <br />

    Цена:<br>
    <input type='text' name='price' value="<?=$text['price'];?>">
    <br>

    Введите строку:<br>
    <img src="capcha.php"><br /><br /><input type='text' name='capcha'>
    <br>

    <input type='submit' name='reg' value='Добавить'>
</form>
<? else: ?>
    <h2>Текст не найден</h2>
<? endif;?>