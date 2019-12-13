<?php
class Session {
    public static function is_user($login) {
        return (!empty($_SESSION['loginthsa']) && ($_SESSION['loginthsa'] == $login));
    }

    public static function is_admin() {
    return (!empty($_SESSION["adminthsa"]) && $_SESSION["adminthsa"]);
	}
}
?>