
<?php
include_once 'arretDAO.php';

class TempsAttente {
	
	var $urlTempsAttente = 'https://open.tan.fr/ewp/tempsattente.json/';
	var $listeTypeLigne = array(1 => 'Tram', 2 => 'BusWay', 3 => 'Bus', 4 => 'NaviBus');

	function getTempsAttente() {
		$codeLieu = isset($_GET['codeLieu']) ? $_GET['codeLieu'] : null;
		$ligne = isset($_GET['ligne']) ? $_GET['ligne'] : null;
		
		$url = $this->urlTempsAttente.$codeLieu;
		$json = file_get_contents($url);
		$data = json_decode($json);
// 		print_r($data);
		if (!empty($data) ) {
			if(isset($ligne)) {
				$data = $this->filtrerLigne($data, $ligne);		
			}
			$this->displayBlocTempsAttente($data);
		}
		$dao = new ArretDAO();
		$dao->addFavori($codeLieu);
	}
	
	function filtrerLigne($pTempsAttente, $pLigne) {
		$pTempsFiltre = array();
		foreach ($pTempsAttente as $temp) {
			if ($temp->{'ligne'}->{'numLigne'} == $pLigne) {
				$pTempsFiltre[] = $temp;
			}
		}
		return $pTempsFiltre;
	}

	function displayBlocTempsAttente($pTempsAttente) {
		foreach ($pTempsAttente as $champ) {
		
			$numLigne = $champ->{'ligne'}->{'numLigne'};
			$typeLigneCode = $champ->{'ligne'}->{'typeLigne'};
			$typeLigne = $this->listeTypeLigne[$typeLigneCode];
			$ligneEnCours = $typeLigne.' '.$numLigne;
			$terminus = $champ->{'terminus'};
			$temps = $champ->{'temps'};
			
			if($temps == "Close") {
				$temps = "<1 mn";
			}
		
			if(empty($ligne) || $numLigne == $ligne) {
				echo "<tr>";
				echo "<td>$ligneEnCours</td>";
				echo "<td>$terminus</td>";
				echo "<td>$temps</td>";
				echo "</tr>";
			}
		}
	}

}
?>
