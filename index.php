<?php

//Je crée PDO
require '/inc/db.php';

//j'écris ma requete
	$sql = '
		SELECT ses_id, ses_opening, ses_ending
		FROM session
	';
	$pdoStatement = $pdo->query($sql);

	//si erreur
	if ($pdoStatement === false){
		print_r($pdo->errorInfo());
	}
	//sinon
	else {
		//Je récupère toues les données
		$sessionList = $pdoStatement->fetchAll();
		//Je vérifie que les données sont correctes
		//print_r($sessionList);
	}

	
	//j'affiche ma page
// < - - - -  HEADER - - - VIEW - - - FOOTER - - - - >
	require 'inc/header.php';

	require 'inc/index_view.php';

	require 'inc/footer.php';
// < - - - -  HEADER - - - VIEW - - - FOOTER - - - - >

//Formulaire de recherche
//lien pour liste de tous les étudiants de la session souhaitée

?>