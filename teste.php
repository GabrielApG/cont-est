<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);


include 'application/controler/Produtos.php';
include 'application/controler/Categorias.php';
include 'application/controler/Retirantes.php';
include 'application/controler/Fornecedores.php';
include 'application/controler/Form.php';
include 'application/controler/Relatorios.php';
//include 'application/controler/DB.php';


if(isSet($_COOKIE["logado"])){
	
}
else{
	echo '<meta http-equiv="refresh" content="0;url=/">';
	exit;

}

if(isset($_GET['url'])){
	$url=$_GET['url'];
}
else {
	$url="";
}

$url=(empty($url))?"index":$url;


?>


<html>
<head>

<title>Controle de Estoque U.O. Pintura</title>

<li><a href="#">Relatórios</a>
		<ul>
			<li><a href="main.php?url=relatorio&acao=produto">Produtos</a></li>
			<li><a href="main.php?url=relatorio&acao=fornecedor">Fornecedores</a></li>
			<li><a href="main.php?url=relatorio&acao=retirante">Retirantes</a></li>
			<li><a href="main.php?url=relatorio&acao=entrada">Entrada</a></li>
			<li><a href="main.php?url=relatorio&acao=saida">Saida</a></li>
		</ul>
	</li>

<style type="text/css">
@import url("styles/index.css");
@import url("styles/menu.css");
</style>
<script type="text/javascript" src="application/js/jquery.min.js"></script>
<script type="text/javascript" src="application/js/menu.js"></script>
<script type="text/javascript" src="application/js/functions.js"></script>
</head>
<p>çççççç<p>

<!--  <body background="img/glow_gradient.jpg" bgproperties="fixed">-->

<!--  <body bgcolor="E9F6FF">-->

<body>
<div id="Full">
<div id="Logo"><big><b>CONTROLE DE ESTOQUE U.O. Pintura</b></big>

<img src="img/Cnh.png" alt="Cnh" width="150" height="40" align="left"> <!-- LOGO CNH -->
<img src="img/Iveco.png" alt="Cnh" width="150" height="40" align="right"> <!-- LOGO Iveco -->
</div>
	<div id="Menu">
	<ul id="jsddm">
	<li><a href="main.php">Inicio</a>		
	</li>
	<li><a href="#">Produtos</a>
		<ul>
			<li><a href="main.php?url=categoria&acao=formcadastrocategoria">Cadastrar Categoria</a></li>
			<li><a href="main.php?url=produto&acao=formcadastro">Cadastrar Produtos</a></li>
			<li><a href="main.php?url=produto&acao=listar">Listar Produtos</a></li>
			<li><a href="main.php?url=categoria&acao=listar">Listar Categorias</a></li>
			<li><a href="main.php?url=produto&acao=formpesquisar">Pesquisar Produtos</a></li>
			
		</ul>
	</li>
	<li><a href="#">Estoque</a>
		<ul>
			<li><a href="main.php?url=estoque&acao=formcadastroentrada">Entrada de Material</a></li>
			<li><a href="main.php?url=estoque&acao=formcadastrosaida">Saida de Material</a></li>
		</ul>
	</li>
	<li><a href="#">Fornecedores</a>
		<ul>
			<li><a href="main.php?url=fornecedor&acao=formcadastro">Cadastrar Fornecedor</a></li>
			<li><a href="main.php?url=fornecedor&acao=listar">Listar Fornecedores</a></li>
		</ul>
	</li>
	<li><a href="#">Retirantes</a>
		<ul>
			<li><a href="main.php?url=retirante&acao=formcadastro">Cadastrar Retirante</a></li>
			<li><a href="main.php?url=retirante&acao=listar">Listar Retirantes</a></li>
		</ul>
	</li>
	<li><a href="#">Relatórios</a>
		<ul>
			<li><a href="main.php?url=relatorio&acao=produto">Produtos</a></li>
			<li><a href="main.php?url=relatorio&acao=fornecedor">Fornecedores</a></li>
			<li><a href="main.php?url=relatorio&acao=retirante">Retirantes</a></li>
			<li><a href="main.php?url=relatorio&acao=entrada">Entrada</a></li>
			<li><a href="main.php?url=relatorio&acao=saida">Saida</a></li>
		</ul>
	</li>
	<li><a href="#">Usuários</a>
		<ul>
			<li><a href="usuario.php">Cadastrar</a></li>
			</ul>
	</li>
	<li><a href="logout.php">logout</a>		
	</li>
	
</ul>
</div>
</ul>
</div>
<div id="Content">
<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);
include 'application/view/'.$url.'.phtml'; 

?></div>
</div>
<p align="center"><font color="#C0C0C0"> Developer: Gabriel Ap. </font></p>

</body>
</html>
