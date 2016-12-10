<?php
include_once 'arret.php';

class ArretDAO {

	var $urlArrets = 'https://open.tan.fr/ewp/arrets.json';
	var $nombreDeFavoris = 3;
	var $favoriName = "favoris";
	var $favoriSeparateur = "/";
	
	public function getArretsFromTan($pLattitude = null, $pLongitude = null) {
		// Si lattidude et longitude sont définis.
		$url = $this->urlArrets;
		if ( null != $pLattitude && null != $pLongitude ) {
			$url = $url.'/'.$pLattitude.'/'.$pLongitude;
		}
// 		echo $url;
		$jsonArrets = file_get_contents($url); // this WILL do an http request for you
		$arrets = json_decode($jsonArrets);
		
		return $arrets;
	}
	
	public function getArretsToJson() {
		$arrets = $this->getArrets();

		$listJson = array();
		foreach ($arrets as $arret) {
			$elem = array();
			$elem['value'] = $arret->nom;
			$elem['codeLieu'] = $arret->code;
			$listJson[] = $elem;
		}
		
		$listJson = json_encode($listJson);
	
		return $listJson;
	}
	
	public function mapArret($pArret) {

		$nom = isset($pArret->{'libelle'}) ? $pArret->{'libelle'} : null;
		$code = isset($pArret->{'codeLieu'}) ? $pArret->{'codeLieu'} : null;
		$lattitude = isset($pArret->{'lattitude'}) ? $pArret->{'lattitude'} : null;
		$longitude = isset($pArret->{'longitude'}) ? $pArret->{'longitude'} : null;
		$distance = isset($pArret->{'distance'}) ? $pArret->{'distance'} : null;
		$lignes = isset($pArret->{'libelle'}) ? $pArret->{'libelle'} : null;

		$lignes = null;
		if ( isset($pArret->{'ligne'}) ) {
			$lignes = array();
			foreach ($pArret->{'ligne'} as $ligne) {
				$lignes[] = $ligne->{'numLigne'};
			}
		}
	
		$arret = new Arret($nom, $code, $lignes, $lattitude, $longitude, $distance);
		
		return $arret;
	}
	
	public function getArrets($pLattitude = null, $pLongitude = null) {
		$arrets = array();
		
		$arretsTan = $this->getArretsFromTan($pLattitude, $pLongitude);
		foreach ($arretsTan as $arretTan) {
			$arrets[] = $this->mapArret($arretTan);
		}
		
		return $arrets;		
	}
	

	public function getArretsFromCode($codes) {
		$arrets = $this->getArrets();
		$arretsSelectionnes = array();
		foreach ($codes as $code) {
			foreach ($arrets as $arret) {
				if($arret->code == $code) {
					// On a trouvé l'élement.
					$arretsSelectionnes[] = $arret;
					break;				
				}
			}
		}
	
		return $arretsSelectionnes;
	}
	
	public function addFavori($pFavori) {
		$newFavoris = $this->getFavoris();
		
		// On supprime l'élément si il existait déjà
		if ( in_array($pFavori, $newFavoris) ) {
			$index = array_search($pFavori, $newFavoris);
// 			$newFavoris = array_splice($newFavoris, $index, 1);
			unset($newFavoris[$index]);
		}
		
		// On ajoute l'élément en premier
		array_unshift($newFavoris, $pFavori);
		
		// On supprime les derniers favoris si ils sont trop nombreux
		while ( count($newFavoris) > $this->nombreDeFavori ) {
			array_pop($newFavoris);
		}
		
		// On set les nouveaux favoris
		$this->setFavoris($newFavoris);
	}
	
	public function setFavoris($pFavoris) {
		$favori = implode( $this->favoriSeparateur, $pFavoris );
		$this->setFavori($favori);
	}
	
	public function getFavoris() {
		$favori = $this->getFavori();
		$favoris = explode ( $this->favoriSeparateur, $favori );
		return $favoris;
	}
	
	public function getFavori() {
		return isset($_COOKIE[$this->favoriName]) ? $_COOKIE[$this->favoriName] : null;
	}
	
	public function setFavori($pFavori) {
		setcookie($this->favoriName, $pFavori);
	}

}
?>