<?php
session_start("logado");

$server="localhost";
$db="bi_server";
$user="root";
$pass="";


$conexao = @mysql_connect($server,$user,$pass);

if(!$conexao){
	echo "Conexao não realizada, erro: ".mysql_errno().mysql_error();
}
else{ // Conexão realizada
	$conecta_banco = mysql_select_db($db, $conexao) or die (mysql_error());
	
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	
	$sql = "SELECT * FROM srs_usuario WHERE nome = '".$usuario."' AND  senha = '".$senha."'";
	
	$query = mysql_query($sql);
	$resultado = mysql_fetch_assoc($query);
		
	if (empty($resultado)) {
		
		$query = "INSERT INTO `srs_usuario`(`nome`, `senha`) VALUES ('$usuario','$senha')";
		$insert = mysql_query($query,$conexao);
		
		
		header("Location:main.php");
		
	}else{
	
		
	header("Location:main.php");
	}

}

?>