<?php 
include '../../../web/seguranca.php';

$id_escola = $_POST['id_escola'];

$nome_escola = htmlentities(strtoupper($_POST['nome_escola']));
$supervisor = htmlentities(strtoupper($_POST['supervisor']));

$categoria = $_POST['categoria'];
$cidade = htmlentities($_POST['cidade']);
$estado =  htmlentities($_POST['estado']);
$logradouro = htmlentities($_POST['logradouro']);
$bairro = htmlentities($_POST['bairro']);
$cep = $_POST['cep'];
$email_esc = htmlentities($_POST['email_esc']);
$tel_fixo_esc = $_POST['tel_fixo_esc'];
$cel_esc = $_POST['cel_esc'];


$nome_diretor = htmlentities($_POST['nome_diretor']);
$email_dir = htmlentities($_POST['email_dir']);
$tel_fixo_dir = $_POST['tel_fixo_dir'];
$cel_dir = $_POST['cel_dir'];

$nome_vdir = htmlentities($_POST['nome_vdir']);
$email_vdir = htmlentities($_POST['email_vdir']);
$tel_fixo_vdir = $_POST['tel_fixo_vdir'];
$cel_vdir = $_POST['cel_vdir'];

$nome_cp = htmlentities($_POST['nome_cp']);
$email_cp = htmlentities($_POST['email_cp']);
$tel_fixo_cp = $_POST['tel_fixo_cp'];
$cel_cp = $_POST['cel_cp'];

$nome_cl = htmlentities($_POST['nome_cl']);
$email_cl = htmlentities($_POST['email_cl']);
$tel_fixo_cl = $_POST['tel_fixo_cl'];
$cel_cl = $_POST['cel_cl'];

$nome_ej = htmlentities($_POST['nome_ej']);
$email_ej = htmlentities($_POST['email_ej']);
$tel_fixo_ej = $_POST['tel_fixo_ej'];
$cel_ej = $_POST['cel_ej'];

$query = "UPDATE escola SET nome_escola = '$nome_escola', categoria = '$categoria', cidade = '$cidade', estado = '$estado', logradouro = '$logradouro', bairro = '$bairro', cep = '$cep', email_esc = '$email_esc', tel_fixo_esc = '$tel_fixo_esc', cel_esc = '$cel_esc', supervisor ='$supervisor', nome_diretor = '$nome_diretor', email_dir = '$email_dir', tel_fixo_dir = '$tel_fixo_dir', cel_dir = '$cel_dir', nome_vdir = '$nome_vdir', email_vdir = '$email_vdir', tel_fixo_vdir = '$tel_fixo_vdir', cel_vdir = '$cel_vdir', nome_cp = '$nome_cp', email_cp = '$email_cp', tel_fixo_cp = '$tel_fixo_cp', cel_cp = '$cel_cp', nome_cl = '$nome_cl', email_cl = '$email_cl', tel_fixo_cl = '$tel_fixo_cl', cel_cl = '$cel_cl', nome_ej = '$nome_ej', email_ej = '$email_ej', tel_fixo_ej = '$tel_fixo_ej', cel_ej = '$cel_ej'WHERE id_escola = '$id_escola'";

if(mysqli_query($_SG['link'], $query)){
	$id_usuario = $_SESSION['usuarioID'];
    $time = date("Y-m-d H:i:s");

    $res = mysqli_query($_SG['link'], "INSERT INTO log_sistema_nucleos (id_usuario, id_escola_afetado, acao, date_time) VALUES ('$id_usuario','$id_escola', 'editar', '$time')");
	echo '<script>$(".alerta").addClass("alert-success");</script>';
	echo '<i class="fa fa-check"></i>&ensp;Núcleo editado com sucesso!';
}
else {
	echo '<script>$(".alerta").addClass("alert-danger");</script>';
	echo '<i class="fa fa-remove"></i>&ensp;Erro na edição, tente novamente mais tarde.';
	echo mysqli_error();	
}



 ?>