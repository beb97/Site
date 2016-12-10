<?php
class Ligne {

	var $nom;
	var $numero;
	var $terminus;
	var $type;
	var $typeCode;
	var $typeListe;
	
	function __construct($pNom, $pNumero, $pTerminus, $pTypeCode) {
		$this->$nom = $pNom;
		$this->$numero = $pNumero;
		$this->$terminus = $pTerminus;
		$this->typeCode = $pTypeCode;
		$this->typeListe = array(1 => 'Tram', 2 => 'BusWay', 3 => 'Bus', 4 => 'NaviBus');
		$this->type = getTypeFromCode($this->typeCode);
	}
	
	function getTypeFromCode($typeCode) {
		$type = 'N/A';
		// Si le typeCode est défini et qu'il existe dans le tableau
		if ( isset($typeCode) && array_key_exists ( $typeCode , $this->typeListe) ) {
			$type = $this->typeListe[$typeCode];
		}
		return $type;
	}

	
}

?>