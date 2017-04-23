<?php
function db($host,$user,$pass,$db_name) {
	$db = mysql_connect($host,$user,$pass);
	if(!$db) {
		exit(mysql_error());
	}

	if(!mysql_select_db($db_name,$db)) {
		exit(mysql_error());
	}

	mysql_query("SET NAMES UTF8");
}

function clear_str($str) {
	return trim(strip_tags($str));
}

function render($path,$param = array()) {
	extract($param);

	ob_start();

	if(!include($path.".php")) {
		exit("Нет такого шаблона");
	}

	return ob_get_clean();

}

function registration($post) {

	$login = clear_str($post['reg_login']);
	$password = trim($post['reg_password']);
	$conf_pass= trim($post['reg_password_confirm']);
	$email = clear_str($post['reg_email']);
	$name = clear_str($post['reg_name']);

	$msg = '';

	if(empty($login)) {
		$msg .= "Введите логин <br />";
	}
	if(empty($password)) {
		$msg .= "Введите пароль <br />";
	}
	if(empty($email)) {
		$msg .= "Введите адресс почтового ящика <br />";
	}
	if(empty($name)) {
		$msg .= "Введите имя <br />";
	}



	if($msg) {
		$_SESSION['reg']['login'] = $login;
		$_SESSION['reg']['email'] = $email;
		$_SESSION['reg']['name'] = $name;
		return $msg;
	}

	if($conf_pass == $password) {
		$sql = "SELECT user_id
					FROM ".PREF."users
					WHERE login='%s'";
		$sql = sprintf($sql,mysql_real_escape_string($login));

		$result = mysql_query($sql);

		if(mysql_num_rows($result) > 0) {
			$_SESSION['reg']['email'] = $email;
			$_SESSION['reg']['name'] = $name;

			return "Пользователь с таким логином уже существует";
		}

		$password = md5($password);
		$hash = md5(microtime());

		$query = "INSERT INTO ".PREF."users (
						name,
						email,
						password,
						login,
						hash
						)
					VALUES (
						'%s',
						'%s',
						'%s',
						'%s',
						'$hash'
					)";
		$query = sprintf($query,
			mysql_real_escape_string($name),
			mysql_real_escape_string($email),
			$password,
			mysql_real_escape_string($login)
		);
		$result2 = mysql_query($query);

		if(!$result2) {
			$_SESSION['reg']['login'] = $login;
			$_SESSION['reg']['email'] = $email;
			$_SESSION['reg']['name'] = $name;
			return "Ошибка при добавлении пользователя в базу данных".mysql_error();
		}
		else {
			$headers = '';
			$headers .= "From: Admin <admin@mail.ru> \r\n";
			$headers .= "Content-Type: text/plain; charset=utf8";

			$tema = "registration";

			$mail_body = "Спасибо за регистрацию на сайте. Ваша ссылка для подтверждения  учетной записи: http://board/index.php?action=registration&hash=".$hash;

			mail($email,$tema,$mail_body,$headers);

			return TRUE;

		}
	} else {
		$_SESSION['reg']['login'] = $login;
		$_SESSION['reg']['email'] = $email;
		$_SESSION['reg']['name'] = $name;
		return "Вы не правильно подтвердили пароль";
	}

}
	function confirm() {
	
	$new_hash = clear_str($_GET['hash']);
	
	$query = "UPDATE ".PREF."users
				SET confirm='1'
				WHERE hash = '%s'
				";
	$query = sprintf($query,mysql_real_escape_string($new_hash));	
	
	$resutl = mysql_query($query);
	
	if(mysql_affected_rows() == 1) {
		return TRUE;
	}
	else {
		return "Не верный код подтверждения регистрации";
	}
		
}
function login($post) {
	
	
	if(empty($post['login']) || empty($post['password'])) {
		return "Заполните поля";
	}
	
	$login = clear_str($post['login']);
	$password = md5(trim($post['password']));
	
	$sql = "SELECT user_id,confirm
			FROM ".PREF."users
			WHERE login = '%s'
			AND password = '%s'";
	$sql = sprintf($sql,mysql_real_escape_string($login),$password);
	
	$result = mysql_query($sql);
	
	if(!$result || mysql_num_rows($result) < 1) {
		return "Не правильный логи или пароль";
	}
	if(mysql_result($result,0,'confirm') == 0) {
		return "Пользователь с таким логином еще не продтвержден";
	}		
	
	$sess = md5(microtime());
	
	$sql_update = "UPDATE ".PREF."users SET sess='$sess' WHERE login='%s'";
	$sql_update = sprintf($sql_update,mysql_real_escape_string($login));
	
	if(!mysql_query($sql_update)) {
		return "Ошибка авторизации пользователя";
	}
	
	$_SESSION['sess'] = $sess;
	
	if($post['member'] == 1) {
		$time = time() + 10*24*3600;
		
		setcookie('login',$login,$time);
		setcookie('password',$password,$time);
		
	}
	
	return TRUE;
}
function logout() {
	unset($_SESSION['sess']);
	
	setcookie('login','',time()-3600);
	setcookie('password','',time()-3600);
	
	return TRUE;
}

function check_user() {

	if(isset($_SESSION['sess'])) {
		$sess = $_SESSION['sess'];

		$sql = "SELECT user_id,name,id_role
				FROM ".PREF."users
				WHERE sess='$sess'";
		$result = mysql_query($sql);

		if(!$result || mysql_num_rows($result) < 1) {
			return FALSE;
		}

		return mysql_fetch_assoc($result);
	}
	elseif(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
		$login = $_COOKIE['login'];
		$password = $_COOKIE['password'];

		$sql = "SELECT user_id,name,id_role
				FROM ".PREF."users
				WHERE login='$login'
				AND password='$password'
				AND confirm = '1'";
		$result2 = mysql_query($sql);

		if(!$result2 || mysql_num_rows($result2) < 1) {
			return FALSE;
		}

		$sess = md5(microtime());

		$sql_update = "UPDATE ".PREF."users SET sess='$sess' WHERE login='%s'";
		$sql_update = sprintf($sql_update,mysql_real_escape_string($login));

		if(!mysql_query($sql_update)) {
			return "Ошибка авторизации пользователя";
		}

		$_SESSION['sess'] = $sess;

		//return mysql_fetch_assoc($result);
	}
	else {
		return FALSE;
	}

}

function get_password($email)
{
	$email = clear_str($email);

	$sql = "SELECT user_id
			FROM " . PREF . "users
			WHERE email = '%s'";
	$sql = sprintf($sql, mysql_real_escape_string($email));

	$result = mysql_query($sql);

	if (!$result) {
		return "не возможно сгенерировать новый пароль";
	}

	if (mysql_num_rows($result) == 1) {
		$str = "234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";

		$pass = '';

		for ($i = 0; $i < 6; $i++) {
			$x = mt_rand(0, (strlen($str) - 1));

			if ($i != 0) {
				if ($pass[strlen($str) - 1] == $str[$x]) {
					$i--;
					continue;
				}
			}
			$pass .= $str[$x];
		}

		$md5pass = md5($pass);

		$query = "UPDATE " . PREF . "users
					SET password='$md5pass'
					WHERE user_id = '" . mysql_result($result, 0, 'user_id') . "'";
		$result2 = mysql_query($query);

		if (!$result2) {
			return "Не возможно сгенерировать новый пароль";
		}

		$headers = '';
		$headers .= "From: Admin <admin@mail.ru> \r\n";
		$headers .= "Content-Type: text/plain; charset=utf8";

		$subject = 'new password';
		$mail_body = "Ваш новый пароль: " . $pass;

		mail($email, $subject, $mail_body, $headers);

		return TRUE;
	} else {
		return "Пользователя с таким потчтовым ящиком нет";
	}
}
	function can($id,$priv_adm) {
		$priv = getPriv($id);
		if(!$priv) {
			$priv = array();
		}

		$arr = array_intersect($priv_adm,$priv);

		if($arr === $priv_adm) {
			return TRUE;
		}

		return FALSE;


	}

	function getPriv($id) {
		$sql = "SELECT ".PREF."priv.name AS priv
				FROM ".PREF."priv
				LEFT JOIN ".PREF."role_priv
					ON ".PREF."role_priv.id_priv = ".PREF."priv.id
				WHERE ".PREF."role_priv.id_role = '$id'
				"
		;
		$result = mysql_query($sql);

		if(!$result) {
			return FALSE;
		}

		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_NUM);

			$arr[] = $row[0];
		}

		return $arr;

}

	function get_razdel() {
		$sql = "SELECT id,name FROM ".PREF."razd";
		$result = mysql_query($sql);

		return get_result($result);
	}
	function get_result($result) {
		if(!$result) {
			exit(mysql_error());
		}
		if(mysql_num_rows($result)== 0) {
			return FALSE;
		}
		$row = array();
		for($i = 0; mysql_num_rows($result) > $i; $i++) {
			$row[] = mysql_fetch_array($result, MYSQL_ASSOC);
		}
		return $row;
	}
	function get_categories()
	{
		$sql = "SELECT * FROM ".PREF."categories";
		$result = mysql_query($sql);

		if (!$result) {
			exit(mysql_error());
		}

		if (mysql_num_rows($result) == 0) {
			return FALSE;
		}

		$categories = array();

		for ($i = 0; mysql_num_rows($result) > $i; $i++) {
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			if (!$row['parent_id']) {
				$categories[$row['id']][] = $row['name'];
			} else {
				$categories[$row['parent_id']]['next'][$row['id']] = $row['name'];
			}
		} return $categories;
	}
	function get_img() {
		$width = 160;
		$height = 80;

		$r = mt_rand(133,255);
		$g = mt_rand(133,255);
		$b = mt_rand(133,255);

		$im = imagecreatetruecolor($width,$height);
		$background = imagecolorallocate($im,$r,$g,$b);
		imagefilledrectangle($im, 0,0,$width,$height,$background);
		$black = imagecolorallocate($im,7,7,7);
		for($h = mt_rand(1,10);$h < $height; $h = $h + mt_rand(1,10)) {
			for($v = mt_rand(1,30);$v < $width; $v = $v + mt_rand(1,30)) {

				imagesetpixel($im,$v,$h,$black);
			}
		}

		header("Content-Type: image/png");
		imagepng($im);
		imagedestroy($im);
	}