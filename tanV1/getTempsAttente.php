<?php
// header( 'Content-type: text/html; charset=utf-8' );
include_once 'arretDAO.php';
include_once 'tempsAttente.php';
?>

<table class="table table-condensed table-striped table-bordered">
<!--  <caption><?php // echo (isset($_GET['codeLieu']) ? $_GET['codeLieu'] : null) ?></caption>  --> 
<thead>
<tr class="bg-info">
<th>Ligne</th>
<th>Terminus</th>
<th>Arrive dans : </th>
<!-- <th></th> -->
</tr>
</thead>
<tbody>
<?php 
	$tempsAttente = new TempsAttente();
	$tempsAttente->getTempsAttente();
?>
	</tbody>
</table>