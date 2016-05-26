<pre>
<?php
require '../inc/db.php';
require 'students_session2.php';
/*
On veut insérer la liste complète des étudiants de la session 2 dans la table student.
On dispose de certaines informations dans le tableau se trouvant dans students_session2.php.
Cependant, des étudiants sont déjà renseignés dans la table student. Il ne faut donc ajouter que les étudiants n'y figurant pas.
Pour savoir si un étudiant est déjà dans la table, on se basera sur le champ "email".
D'ailleurs, pour plus de sécurité, on va ajouter un attribut d'unicité sur ce champ, dans la table student.

Copiez ces 2 fichiers dans un répertoire batch de votre projet Toto, puis éditez ce fichier pour effectuer les insertions en DB.
*/
//print_r($studentsList);

foreach ($studentsList as $key => $value) {
	$name = $value['name'];
	$firstname = $value['firstname'];
	$birthdate = $value['birthdate'];
	$email = $value['email'];
	$sex = $value['sex'];
	$with_experience = $value['with_experience'];
	$is_leader = $value['is_leader'];

	

	//if () {

	//print_r($name.'<br/>');
	$sql= '
		INSERT INTO student (stu_name, stu_firstname, stu_birthdate, stu_email, stu_sex, stu_with_experience, stu_is_leader) VALUES (:name, :firstname, :birthdate, :email, :sex, :with_experience, :is_leader)
	';
	$pdoStatement = $pdo->prepare($sql);
	//print_r($pdoStatement);
	$pdoStatement->bindValue(':name', $name);
	$pdoStatement->bindValue(':firstname', $firstname);
	$pdoStatement->bindValue(':birthdate', $birthdate);
	$pdoStatement->bindValue(':email', $email);
	$pdoStatement->bindValue(':sex', $sex);
	$pdoStatement->bindValue(':with_experience', $with_experience);
	$pdoStatement->bindValue(':is_leader', $is_leader);


	if ($pdoStatement->execute() === false) {
			print_r($pdo->errorInfo());
		}
		else if ($pdoStatement->rowCount() > 0) {
			echo ('ligne insere<br>');
		}


}
// A vous de jouer ^^
?>
<!--</pre>
foreach ($studentsList as $key => $value) {
	$emails = $value['email'];
	print_r($emails.'<br/>');
}-->