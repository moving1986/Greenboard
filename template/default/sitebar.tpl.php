<div id="right">
        <img src="<?=TEMPLATE;?>src/up_left_m.png" alt="" id="m_img" />
        <nav class="nav">
            <ul><?php if($user) : ?>
                    <? if($add_mess): ?>
                         <li><a href="?action=add_mess" title="">Подать объявление</a></li>
                        <? endif; ?>
                <li><a href="?action=p_mess" title="">Мои объявления</a></li>
               <? endif; ?>
                <li><a href="" title="">Помощь</a></li>
                <li><a href="" title="">Безопасность</a></li>
                <li><a href="" title="">Реклама на сайте</a></li>
                <li><a href="" title="">Магазин</a></li>
                <li><a href="" title="">О нас</a></li>
            </ul>
        </nav>

    </div>
