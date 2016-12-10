<?php
class Arret {
	var $nom;
	var $code;
	var $lignes;
	var $lattitude;
	var $longitude;
	var $distance;
	
	function __construct($pNom, $pNumero, $pLignes = array(), $pLattitude = null, $pLongitude = null, $pDistance = null) {
		$this->nom = $pNom;
		$this->code = $pNumero;
		$this->lignes = $pLignes;
		$this->lattitude = $pLattitude;
		$this->longitude = $pLongitude;
		$this->distance = $pDistance;
	}
	
	
}