<?php
include_once 'arret.php';
class ArretWEB {

	
	public function displayBlocArretGeo($arrets) {
		foreach ($arrets as $arret) {
			$boutonTitre = $this->getLibelleArret($arret);
// 			print_r($arret);
			echo "<div>";
			echo "<button type='button' codeLieu='$arret->code' class='btn btn-sm btn-info' onclick='getTempsAttente(this);'>$boutonTitre</button>";
			foreach ($arret->lignes as $ligne) {
				echo "<button type='button' codeLieu='$arret->code' ligne='$ligne' class='btn btn-sm btn-default' onclick='getTempsAttente(this);'>$ligne</button>";
		
			}
			echo "</div>";
		}
	}
	
	public function displayBlocArretAll($arrets) {
		foreach ($arrets as $arret) {
			$boutonTitre = $this->getLibelleArret($arret);
			// 			print_r($arret);
			echo "<div>";
			echo "<button type='button' codeLieu='$arret->code' class='btn btn-sm btn-info' onclick='getTempsAttente(this);'>$boutonTitre</button>";
			foreach ($arret->lignes as $ligne) {
				echo "<button type='button' codeLieu='$arret->code' ligne='$ligne' class='btn btn-sm btn-default' onclick='getTempsAttente(this);'>$ligne</button>";
	
			}
			echo "</div>";
		}
	}
	
	public function getLibelleArret($pArret) {
		$libelle = '';
		$libelle = $libelle.$pArret->nom;
		if (isset($pArret->distance)) {
			$libelle = $libelle." ($pArret->distance m)";
		}
		return $libelle;
	}

	
}
?>