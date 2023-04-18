<?php
session_start();
include_once './valida_login.php';
/* Attempt MySQL server connection. Assuming you are running MySQL
  server with default setting (user 'root' with no password) */
include_once './mysql.php';

include_once './topo.php';


// Attempt insert query execution
try {
    // Create prepared statement
    $id = addslashes($_POST['id_professor']);

    $sql = "SELECT * FROM professor WHERE id_professor = $id";

	$stmt = $pdo->prepare($sql);

	$stmt->execute();

	$arrValues = $stmt->fetchAll(PDO::FETCH_ASSOC);


	if (empty($arrValues)) {
		?>    
		echo "<script type=text/javascript>alert('Professor não encontrado!');window.location='removeProfessor.php'</script>";

		<?php
	} else {

    $sql = "DELETE FROM professor WHERE id_professor = $id";

    $stmt = $pdo->prepare($sql);
    
    $stmt->execute();

    
    echo "<script type=text/javascript>alert('Operação realizada com sucesso!');window.location='removeProfessor.php'</script>";
}
} catch (PDOException $e) {
    //die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        echo "<script type=text/javascript>alert('Operação NÃO realizada!');window.location='removeProfessor.php'</script>";

}

// Close connection
unset($pdo);
include_once './rodape.php';
?>

