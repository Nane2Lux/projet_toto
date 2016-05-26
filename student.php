<?php


//Je crée PDO
require '/inc/db.php';

//inclut automatiquement tous les packages de Composer
require_once __DIR__.'/vendor/autoload.php';

use Whatsma\ZodiacSign;

 //Je recupère le stu_id via GET
if (!empty($_GET['stu_id'])){
	$studentID = $_GET['stu_id'];
	

//Je crée ma variable
	
	$sql = '
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate as birthdate
		FROM student
		LEFT OUTER JOIN country ON country.cou_id = student.cou_id
		LEFT OUTER JOIN city ON city.cit_id = student.cit_id
		LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
		WHERE stu_id = :studentID
	';


	//J'execute ma requete
	$pdoStatement = $pdo->prepare($sql);
	//bindValue
	$pdoStatement->bindValue(':studentID', $studentID, PDO::PARAM_INT);

	//Je teste si la requete est non valide
	if($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else if ($pdoStatement && $pdoStatement->rowcount() > 0){
		$etudiantListe = $pdoStatement->fetch();
	}
	
		$calculator = new ZodiacSign\Calculator();

		$jour = $etudiantListe['birthdate'][8].$etudiantListe['birthdate'][9];
		$mois = $etudiantListe['birthdate'][5].$etudiantListe['birthdate'][6];

		$zodiacSign = $calculator->calculate(intval($jour),intval($mois));

		  switch ($zodiacSign) {
		  	case 'aries':
		  		$ZodiacSign = 'Belier';
		  		break;
		  	case 'taurus':
		  		$ZodiacSign = 'Taureau';
		  		break;
		  	case 'gemini':
		  		$ZodiacSign = 'Gémeaux';
		  		break;
		  	case 'cancer':
		  		$ZodiacSign = 'Cancer';
		  		break;	
		  	case 'leo':
		  		$ZodiacSign = 'Lion';
		  		break;
		  	case 'virgo':
		  		$ZodiacSign = 'Vierge';
		  		break;
		  	case 'libra':
		  		$ZodiacSign = 'Balance';
		  		break;
		  	case 'scorpio':
		  		$ZodiacSign = 'Scorpion';
		  		break;
		  	case 'sagitarius':
		  		$ZodiacSign = 'Sagitaire';
		  		break;
		  	case 'capricorn':
		  		$ZodiacSign = 'Capricorne';
		  		break;
		  	case 'aquarius':
		  		$ZodiacSign = 'Verseau';
		  		break;;
		  	case 'pisces':
		  		$ZodiacSign = 'Poisson';
		  		break;
		  	default:
		  		$ZodiacSign = '????';
		  		break;
		  }

		try {
		  //echo $ZodiacSign . "\n";
		} catch (ZodiacSign\InvalidDayException $e) {
		  echo "ERROR: Invalid Day";
		} catch (ZodiacSign\InvalidMonthException $e) {
		  echo "ERROR: Invalid Month";
		}
	



}
	//j'affiche ma page
// < - - - -  HEADER - - - VIEW - - - FOOTER - - - - >
	require 'inc/header.php';

	require 'inc/student_view.php';

	require 'inc/footer.php';
// < - - - -  HEADER - - - VIEW - - - FOOTER - - - - >
	