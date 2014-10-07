<?php
class Csrf {
	public static function generate($key) {
		$token = base64_encode(hash("sha512",mt_rand()));
		$_SESSION['csrf_check_'.$key] = $token;
		return $token;
	}

	public static function check($key,$org,$onetime=true) {
		if (!isset($_SESSION['csrf_check_'.$key])) {
			return false;
		}

		if (!isset($org[$key])) {
			return false;
		}

		$token = $_SESSION['csrf_check_'.$key];
		if ($onetime) {
			$_SESSION['csrf_check_'.$key] = null;
		}

		if ($org[$key]!=$token) {
			return false;
		}
		return true;
	}
}
?>