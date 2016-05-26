<?php

//Je crée PDO
require '/inc/db.php';

$etudiantListe = array();
$citiesList = array(
	
	1 => 'Luxembourg',
	2 => 'Longwy',
	3 => 'Esch-sur-Alzette',
	4 => 'Verdun',
	5 => 'Arlon',
	6 => 'Leudelange',
	7 => 'Mamer',
	9 => 'Pissange',
	10 => 'Bruxelles',
	11 => 'Metz',
	12 => 'Rodange'
);
$countriesList = array(
	1 => 'France',
	2 => 'Luxembourg',
	3 => 'Belgique',
	4 => 'Chine',
	5 => 'Allemagne'
);
$maritalStatusList = array(
	1 => 'Célibataire',
	2 => 'Marié(e)',
	3 => 'Divorcé(e)',
	4 => 'Veuf/veuve'
);
//GESTION DU POST



	// si le formulaire a été soumis
	if(!empty($_POST)){
		//                  IF                     THEN                  ELSE
		$name = isset($_POST['studentName']) ? $_POST ['studentName'] : '';
		$firstname = isset($_POST['studentFirstname']) ? $_POST['studentFirstname'] : '';
		$email = isset($_POST['studentEmail']) ? $_POST['studentEmail'] : '';
		$birthdate = isset($_POST['studentBirhtdate']) ? $_POST['studentBirhtdate'] : '';
		$cityID = isset($_POST['cit_id']) ? intval($_POST['cit_id']) : 0;
		$countryID = isset($_POST['cou_id']) ? intval($_POST['cou_id']) : 0;
		$maritalID = isset($_POST['mar_id']) ? intval($_POST['mar_id']) : 0;
		

		if (empty($name)){
			$errorList[] = 'Le nom est vide';
		}
		if (empty($firstname)){
			$errorList[] = 'Le prénom est vide';
		}
		if (empty($email)){
			$errorList[] = 'L\'email est vide';
		}
		if (empty($birthdate)){
			$errorList[] = 'La date de naissance est vide';
		}
		if (empty($cityID)){
			$errorList[] = 'Le nom de ville est vide';
		}
		if (empty($countryID)){
			$errorList[] = 'La nationnalité est vide';
		}

		if(empty($errorList)){
			echo 'Je peux insérer dans BDD<br/>';
			$nbLignes = 0;
			$sql = "
				INSERT 
				INTO student (stu_name, stu_firstname, stu_email, stu_birthdate, cit_id, cou_id, mar_id) 
				VALUES ('$name', '$firstname', '$email', '$birthdate', '$cityID', '$countryID', '$maritalID')
			";

			//J'execute ma requete
			$nbLignes = $pdo->exec($sql);
			//Je teste si la requete est non valide
			if($nbLignes === false) {
				print_r($pdo->errorInfo());
			}
			else{
				echo 'Insertion réussie BDD<br/>';
			}
		}
	}

//j'affiche ma page
// < - - - -  HEADER - - - VIEW - - - FOOTER - - - - >
	require 'inc/header.php';

	require 'inc/add_view.php';

	require 'inc/footer.php';
// < - - - -  HEADER - - - VIEW - - - FOOTER - - - - >
	