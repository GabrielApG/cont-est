<?php

define('FPDF_FRONTPATH', 'font/');
require('../fpdf17/fpdf.php');

//instancia a classe.. P=Retrato, mm =tipo de medida utilizada no casso milimetros, tipo de folha =A4
$pdf= new FPDF("P","cm","A4");
//$pdf = new FPDF('P','cm','A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 6);
$cont=0;

//Outras configurações

//$sql="SELECT * FROM srs_product ORDER BY 'NOME'";
$sql= "SELECT * FROM SRS_SUPPLIER ORDER BY nome";//, b.nome

$connect = mysql_connect("localhost","root","");

	if(!$connect) die ("<h1> Falha de Conexão.</h1>");
	$db = mysql_select_db("bi_server");
	$exe_sql=mysql_query($sql) or die (mysql_error());


		//CABECALHO
		//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
		$pdf->SetFont('Arial','',10);
		$pdf->Image("../img/Cnh.png");
		$pdf->Cell(0,1,'Almoxarifado Iveco Sete Lagoas - FORNECEDORES CADASTRADOS',0,0,'L');
		$pdf->Ln(1);		

		//data atual
		$data=date("d/m/Y");
		$conteudo="Criado em ".$data;
		
		$pdf->Cell(0,1,'http://www.almoxiveco.esy.es  - '.$conteudo,0,1,'R');
		$pdf->Cell(0,0,'',1,1,'L');
		$pdf->Ln(1);
		
		$pdf->SetFont('arial','B',8);
		$pdf->Cell(1,1,'ID',1,0,'1');
		$pdf->Cell(7,1,'NOME',1,0,'1');
		$pdf->Cell(4,1,'TELEFONE',1,0,'1');
		$pdf->Cell(3,1,'ESTADO',1,0,'1');
		$pdf->Cell(3,1,'CIDADE',1,0,'1');

		$pdf->Ln(1);
	
	while($resultado=mysql_fetch_array($exe_sql)){

		$cont++;

		$pdf->SetFont('arial','',6);

		$pdf->Cell(1,1,$resultado['id'],1,0,'L');
		$pdf->Cell(7,1,$resultado['nome'],1,0,'L');
		$pdf->Cell(4,1,$resultado['telefone'],1,0,'L');
		$pdf->Cell(3,1,$resultado['estado'],1,0,'L');
		$pdf->Cell(3,1,$resultado['cidade'],1,0,'L');
		$pdf->Ln(1);

	}

	$pdf->SetFont('arial','',6);
	$pdf->Cell(3,1,'Total de registros:',1,0,'L');
	$pdf->Cell(2,1,$cont,1,0,'L');
	
	$pdf->Output();

	?>