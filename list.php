<?php


//Je crée PDO
require '/inc/db.php';

 //Je recupère le ses_id via GET
if (!empty($_GET['ses_id'])){
	$sessionID = $_GET['ses_id'];
	
//nombre d'étudiants par page
	$nbPerPage = 4;
	$currentOffset = 0;
	if (isset($_GET['offset'])){
		$currentOffset = intval($_GET['offset']);
	}

//Je crée ma variable
	$etudiantListe = array();
	$sql = '
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate as birthdate
		FROM student
		LEFT OUTER JOIN country ON country.cou_id = student.cou_id
		LEFT OUTER JOIN city ON city.cit_id = student.cit_id
		LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
		WHERE ses_id = :sessionId
		LIMIT :offset,:nbPerPage
	';

	//J'execute ma requete
	$pdoStatement = $pdo->prepare($sql);
	//bindValue
	$pdoStatement->bindValue(':sessionId', $sessionID, PDO::PARAM_INT);
	$pdoStatement->bindValue(':nbPerPage', $nbPerPage, PDO::PARAM_INT);
	$pdoStatement->bindValue(':offset', $currentOffset, PDO::PARAM_INT);

	//Je teste si la requete est non valide
	if($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else if ($pdoStatement && $pdoStatement->rowcount() > 0){

		$etudiantListe = $pdoStatement->fetchall();

	}
	
}

	//j'affiche ma page
// < - - - -  HEADER - - - VIEW - - - FOOTER - - - - >
	require 'inc/header.php';

	require 'inc/list_view.php';

	require 'inc/footer.php';
// < - - - -  HEADER - - - VIEW - - - FOOTER - - - - >
	