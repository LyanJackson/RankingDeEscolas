<?php 
	include '../../../web/seguranca.php';

	$ativo = $_POST['ativo'];
	$id = $_POST['id'];

	if($ativo == 1){
		$query = "UPDATE escola SET ativo = 0 WHERE id_escola = $id";

		$query2 = "UPDATE usuario SET h = 0 WHERE id_escola = $id";

		if(mysqli_query($_SG['link'], $query) AND mysqli_query($_SG['link'], $query2)){
		    $id_usuario = $_SESSION['usuarioID'];
		    $time = date("Y-m-d H:i:s");

		    $res = mysqli_query($_SG['link'], "INSERT INTO log_sistema_nucleos (id_usuario, id_escola_afetado, acao, date_time) VALUES ('$id_usuario','$id', 'desativar', '$time')");


			echo '<span class="pull-left glyphicon glyphicon-ok"></span> Ativar';
		}else {
			echo '<div class="alert-danger">'.mysqli_error().'</div>';
		}
	}
	else {
		$query = "UPDATE escola SET ativo = 1 WHERE id_escola = $id";

		if(mysqli_query($_SG['link'], $query)){
	   		$id_usuario = $_SESSION['usuarioID'];
		    $time = date("Y-m-d H:i:s");

		    $res = mysqli_query($_SG['link'], "INSERT INTO log_sistema_nucleos (id_usuario, id_escola_afetado, acao, date_time) VALUES ('$id_usuario','$id', 'ativar', '$time')");


			echo '<span class="pull-left glyphicon glyphicon-trash"></span> Desativar';
		}else {
			echo '<div class="alert-danger">'.mysqli_error().'</div>';
		}		
	}
?>