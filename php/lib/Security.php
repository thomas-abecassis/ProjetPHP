<?php
class Security {
	private static $seed="xT1lVluyBi";

	public static function chiffrer($texte_en_clair) {
		$texte_en_claire=Security::$seed.$texte_en_clair;
		$texte_chiffre = hash('sha256', $texte_en_clair);
		return $texte_chiffre;
	}
}
?>
