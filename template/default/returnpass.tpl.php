<h1>Введите свой почтовый адресс</h1>
			<?=$_SESSION['msg']?>
			<?unset($_SESSION['msg'])?>
				<form method='POST'>
				<label>
				EMAIL<br>
					<input type='text' name='email'>
				</label><br>
				<input style="float:left" type='submit' value='Вход'>
			</form>	