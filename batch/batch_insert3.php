<?php

/*
On veut insérer la liste complète des étudiants de la session 2 dans la table student.
On dispose de certaines informations dans le tableau se trouvant dans students_session2.php.
Cependant, des étudiants sont déjà renseignés dans la table student. Il ne faut donc ajouter que les étudiants n'y figurant pas.
Pour savoir si un étudiant est déjà dans la table, on se basera sur le champ "email".
D'ailleurs, pour plus de sécurité, on va ajouter un attribut d'unicité sur ce champ, dans la table student.

Copiez ces 2 fichiers dans un répertoire batch de votre projet Toto, puis éditez ce fichier pour effectuer les insertions en DB.
*/

require 'students_session2.php';

// A vous de jouer ^^
$errorList = array();
$etudiantAjout = array();

$sql = 'SELECT stu_email
     FROM student
     ';

$pdoStatement = $pdo->query($sql);

if ($pdoStatement === false) {
	print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount() > 0) {
	//fetchall des elements du tableau et ensuite faire un boucle....
	$etudiantAjout = $pdoStatement->fetchAll();
}
$i = 0;
$name = $studentsList[$i]['name'];
$firstname = $studentsList[$i]['firstname'];
$email = $studentsList[$i]['email'];
$birthdate = $studentsList[$i]['birthdate'];
$sex = $studentsList[$i]['sex'];
$with_experience = $studentsList[$i]['with_experience'];
$is_leader = $studentsList[$i]['is_leader'];

$sqlIns='
	INSERT INTO student(stu_name,stu_firstname,stu_birthdate,stu_email,stu_sex,stu_experience,stu_is_leader,stu_session)
	VALUES (:name,:firstname,:birthdate,:email,:sexe,:experience,:leader,:session)
';

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':name',$name);
$pdoStatement->bindValue(':firstname',$firstname);
$pdoStatement->bindValue(':email',$email);
$pdoStatement->bindValue(':birthdate',$birthdate);
$pdoStatement->bindValue(':sex',$sex);
$pdoStatement->bindValue(':experience',$with_experience, PDO::PARAM_INT);
$pdoStatement->bindValue(':leader',$is_leader, PDO::PARAM_INT);
$pdoStatement->bindValue(':session',2, PDO::PARAM_INT);
$pdoStatement->execute();

if ($pdoStatement->execute()===false) {
	print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount() > 0) {
		echo 'Etudiant inséré dans la DB<br />';
}
		