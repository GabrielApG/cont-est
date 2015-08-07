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

$sql="SELECT * FROM srs_product ORDER BY 'NOME'";
$connect = mysql_connect("localhost","root","");

	if(!$connect) die ("<h1> Falha de Conexão.</h1>");
	$db = mysql_select_db("bi_server");
	$exe_sql=mysql_query($sql) or die (mysql_error());


		//CABECALHO
		//escreve no pdf largura,altura,conteudo,borda,quebra de linha,alinhamento
		$pdf->SetFont('Arial','',10);
		$pdf->Image("../img/Cnh.png");
		$pdf->Cell(0,1,'Almoxarifado Iveco Sete Lagoas -  LISTA DE PRODUTOS',0,0,'L');
		$pdf->Ln(1);		

		//data atual
		$data=date("d/m/Y");
		$conteudo="Criado em ".$data;
		
		$pdf->Cell(0,1,'http://www.almoxiveco.esy.es  - '.$conteudo,0,1,'R');
		$pdf->Cell(0,0,'',1,1,'L');
		$pdf->Ln(1);
		
		$pdf->SetFont('arial','B',8);
		$pdf->Cell(1,1,'ID',1,0,'1');
		$pdf->Cell(8,1,'NOME',1,0,'1');
		$pdf->Cell(2,1,'SALDO',1,0,'1');
		$pdf->Cell(2,1,'ALOCACAO',1,0,'1');
		$pdf->Cell(2,1,'ID SAP',1,0,'1');
		$pdf->Ln(1);
	
	while($resultado=mysql_fetch_array($exe_sql)){

		$cont++;

		$pdf->SetFont('arial','',6);

		$pdf->Cell(1,1,$resultado['id'],1,0,'L');
		$pdf->Cell(8,1,$resultado['nome'],1,0,'L');
		$pdf->Cell(2,1,$resultado['estoque_atual'],1,0,'L');
		$pdf->Cell(2,1,$resultado['alocacao'],1,0,'L');
		$pdf->Cell(2,1,$resultado['id_sap'],1,0,'L');
		$pdf->Ln(1);

	}

	$pdf->SetFont('arial','',6);
	$pdf->Cell(3,1,'Total de registros:',1,0,'L');
	$pdf->Cell(2,1,$cont,1,0,'L');
	
	$pdf->Output();

	?>