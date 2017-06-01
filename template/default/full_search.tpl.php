<h3>Поиск</h3>
<form method="GET">
    <input name="action" value="search" type="hidden">
    Поиск<br>
    <input name="search" type="text">
    <br>
    <br>
    Категория:<br>
    <select name="id_categories">
        <option selected="selected" value="">Выберите категорию</option>
        <optgroup label="Транспорт">
            <option value="5">--Автомобили</option>
            <option value="6">--Мото</option>
        </optgroup>
        <optgroup label="Интернет">
            <option value="7">--Компьютеры</option>
            <option value="8">--Игры</option>
        </optgroup>
        <optgroup label="Дом">
            <option value="9">--Мебель</option>
            <option value="10">--Сантехника</option>
        </optgroup>
        <optgroup label="Сад, огород">
            <option value="11">--Интсрумент</option>
            <option value="12">--Строй материалы</option>
        </optgroup>
    </select>
    <br>
    <br>
    Тип объявления:<br>
    <input name="id_razd" value="1" type="radio">Предложение
    <input name="id_razd" value="2" type="radio">Спрос
    <br><br>
    Диапазон цен:<br>
    От <input name="p_min" class="p_search" type="text">	До <input name="p_max" class="p_search" type="text">
    <br><br>
    <input value="Поиск" type="submit">
</form>