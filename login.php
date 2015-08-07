<?php

$_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'

$server="localhost";
$db="bi_server";
$user="root";
$pass="";

$conexao = @mysql_connect($server,$user,$pass);
$user = $_POST['user'];
$pass = $_POST['pass'];

global $_SG;

$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
// Usa a função addslashes para escapar as aspas
$nusuario = addslashes($user);
$nsenha = addslashes($pass);

if(!$conexao){
	echo "Conexao não realizada, erro: ".mysql_errno();
}
else{
		
	//echo "Conexao realiza com sucesso";
	$conecta_banco = mysql_select_db($db, $conexao) or die (mysql_error());

	$sql = "SELECT * FROM srs_usuario WHERE nome = '".$nusuario."' AND  senha = '".$nsenha."' LIMIT 1";
	
	$query = mysql_query($sql);
	$resultado = mysql_fetch_assoc($query) or die (mysql_error());
		
		if (empty($resultado)) {

		echo "<font face=verdana size=2>";
		echo "Usuário ou senha incorretos!";
		echo "<br>";
		echo "<a href=index.php>";
		echo "Clique aqui para voltar </a> e tentar novamente.";
		echo "</a></font>";
		
				
		return false;
	} else {
		
	
		setcookie("logado", "1");
		echo "<script>location.href='main.php'</script>";
		

		return true;
	}
}

?>