<?php
// Fixe l'encodage des accents
header( 'Content-type: text/html; charset=utf-8' );
include_once 'arret.php';
include_once 'arretDAO.php';
include_once 'arretWEB.php';
// echo $_SERVER['DOCUMENT_ROOT'];
// echo $_SERVER['PHP_SELF'];

class ArretAPP {

	public function displayArrets() {
		$lattitude = null;
		$longitude = null;
		
		if (isset($_GET['lattitude']) && isset($_GET['longitude'])) {
			$lattitude = $_GET['lattitude'];
			$lattitude = $this->cleanCoord($lattitude);
			$longitude = $_GET['longitude'];
			$longitude = $this->cleanCoord($longitude);
		}
		
		$arretDAO = new ArretDAO();
		$arretWEB = new ArretWEB();
		$arrets = $arretDAO->getArrets($lattitude, $longitude);
		$arretWEB->displayBlocArretGeo($arrets);
	}
	
	public function displayArretsFavori() {
		$arretDAO = new ArretDAO();
		$arretWEB = new ArretWEB();
		$favoris = $arretDAO->getFavoris();
		$arrets = $arretDAO->getArretsFromCode($favoris);
		$arretWEB->displayBlocArretGeo($arrets);
	}
	
	public function cleanCoord($pCoord) {
		$cleanedCoord = str_replace('.', ',', $pCoord); 
		return $cleanedCoord;
	}
	
}
?>

 
