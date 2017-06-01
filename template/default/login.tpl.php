<h1>Авторизируйтесь</h1>
			<?=$_SESSION['msg'];?>
			<? unset($_SESSION['msg'])?>
				<form method='POST'>
				<label>
				Имя пользователя:<br>
					<input type='text' name='login'>
				</label><br>
				Пароль:<br>
				<label>
					<input type='password' name='password'>
				</label><br>
				<label>Запомнить пароль
					<input type="checkbox" name='member' value="1">
				</label><br>
				<input style="float:left" type='submit' value='Вход'>
			</form>
			<br />
			<p>
				<a href="?action=registration.php">Регистрация</a> | <a href="?action=returnpass">Забыли пароль?</a>
			</p>
<br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />