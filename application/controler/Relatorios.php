<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);

class Relatorio extends Form   {
	
	
	public $conexaoDB;
	public $fieds;
	public $table;
	
	
	#Construtor - Conecta e seleciona a tabela
	function __construct($tabela) {
		$this->table=$tabela;
		$this->conexaoDB=new DB();
		$this->fields=$this->conexaoDB->ListarCampos($this->table);
		
	}
	
	function RelRet($print="s") {
		
	
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);

		echo '<a href="relatorios/geraRelRet.php" target="blanck">IMPRIMIR</a>';

		echo '<h1>Relatório de '.$this->table.'</h1><br><br>';
		echo '<table class="css-form">
		<tr class="css-form">';
		foreach ($campos as $campo) {
			$campo=str_replace("_"," ",$campo);
			echo '<td class="header">'.ucfirst($campo).'</td>';
			
		}
		echo '</tr>';
		$dados=$this->conexaoDB->PesquisaTabela($this->table);
		while($dado=mysql_fetch_object($dados)){
			
		echo '<tr class="css-form">'	;
		
		foreach ($dado as $campo) {
			
			echo '<td>'.$campo.'</td>';
			
		}
		echo '</tr>';	
		}
		echo '</table>';		
	}

	function RelFornecedor($print="s") {
		
	
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);

		echo '<a href="relatorios/geraRelFornecedor.php" target="blanck">IMPRIMIR</a>';

		echo '<h1>Relatório de '.$this->table.'</h1><br><br>';
		echo '<table class="css-form">
		<tr class="css-form">';
		foreach ($campos as $campo) {
			$campo=str_replace("_"," ",$campo);
			echo '<td class="header">'.ucfirst($campo).'</td>';
			
		}
		echo '</tr>';
		$dados=$this->conexaoDB->PesquisaTabela($this->table);
		while($dado=mysql_fetch_object($dados)){
			
		echo '<tr class="css-form">'	;
		
		foreach ($dado as $campo) {
			
			echo '<td>'.$campo.'</td>';
			
		}

		echo '</tr>';
			
		}
		
		echo '</table>';
	}
		
	function RelProd($print="s") {
			
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);

		// Para Impressão
		// if($print=="n")
		// 	echo '<br>
		// 		  <a href="application/view/printrelatorio.php?acao=Visualizar&tabela='.$this->table.'">
		// 		 	SALVAR PARA ARQUIVO
		// 		  </a>';
		// else
		// 	echo '<br><a href="#" onclick="window.print()">IMPRIMIR</a>';
		
		echo '<a href="relatorios/geraRelProdutos.php" target="blanck">IMPRIMIR</a>';
		
		echo '<h1>Relatório de '.$this->table.'</h1><br><br>';
		echo '<table class="css-form">
				<tr class="css-form">
				<td class="header">ID</td>
			     <td class="header">CATEGORIA</td>
				 <td class="header">NOME</td>
				 <td class="header">EST. MIN.</td>
				 <td class="header">SALDO ATUAL</td>
				 <td class="header">ID SAP</td>
				 <td class="header">ALOCACAO</td>
			  </tr>';

		$dados=$this->conexaoDB->PesquisaTabela($this->table);
		
		while($dado=mysql_fetch_object($dados)){
		echo '<tr class="css-form">'	;
		
		foreach ($dado as $campo) {
			
			echo '<td>'.$campo.'</td>';
		}

		echo '</tr>';
		}
		echo '</table>';
	}
	
	
	function Entrada($datainicial, $datafinal,$print="s"){
		
		if(empty($datainicial) && empty($datafinal)){
			echo '<h1>Relatório de '.$this->table.'</h1><br><br>';	
			echo '<form class="css-form" action="main.php?url=relatorio&acao=entrada" method="post">';
			//echo '<p><h4 id="id-" class="css-h4">Data Inicial:</h4>';
			echo '<p><h4 id="id-label" class="css-h4">Data Inicial:<input class="css-input" type="date" name="datainicial" /></h4></p><br><br>';
			echo '<p><h4 id="id-label" class="css-h4">Data Final:<input class="css-input" type="date" name="datafinal"/></h4></p><br>';
			echo '<input id="id-btn" class="btn_enviar" type="Submit" value="Enviar" />';
			echo'</form>';
			
					
		}
		else{
			$datai =  $datainicial;
			$dataf =  $datafinal;
			$sql="Select date_format(e.data, '%d-%m-%Y - %H:%i') as data,  p.nome as produto, f.nome as fornecedor,
			e.quantidade, e.num_nota, e.num_pedido, e.valor_unitario, e.obs from srs_input e
			inner join srs_product p on e.produto=p.id
			left join srs_supplier f on f.id=e.fornecedor
			where date(e.data) between '$datai' and '$dataf'";
			
			echo '<h1>Relatório de '.$this->table.'</h1><br><br>';	
			echo '<table class="css-form">';
			echo '<tr class="css-form">
					<td class="header" style="width:220px; padding:10px">Data / Hora</td>
					<td class="header">Produto</td >
					<td class="header">Fornecedor</td>
					<td class="header">Quantidade</td>
					<td class="header">Num Nota</td>
					<td class="header">Num Pedido</td>
					<td class="header">Valor Nota</td>
					<td class="header">Observação</td>
				</tr>';
			$dados=$this->conexaoDB->ExecutaQuery($sql);
			while($dado=mysql_fetch_object($dados)){
				
				echo '<tr class="css-form">'	;
				
				foreach ($dado as $campo) {
					
					echo '<td style="padding:2px">'.$campo.'</td>';
					
				}
		
				echo '</tr>';
				
			}
			
			echo '</table>';
			if($print=="n")
				echo '<br><a href="application/view/printrelatorio.php?acao=Entrada&tabela='.$this->table.
			'&datainicial='.$datainicial.'&datafinal='.$datafinal.'">
			SALVAR PARA ARQUIVO</a>';
			else
				echo '<br><a href="#" onclick="window.print()">IMPRIMIR</a>';
		
			
		}
		
		
		
	}
	
function Saida($datainicial, $datafinal,$print="s"){
		
		
		if(empty($datainicial) && empty($datafinal)){
			echo '<h1>Relatório de '.$this->table.'</h1><br><br>';	
			echo '<form class="css-form" action="main.php?url=relatorio&acao=saida" method="post">';
			echo '<p><h4 id="id-label" class="css-h4">Data Inicial: <input class="css-input" type="date" name="datainicial" /></h4></p><br><br>';
			echo '<p><h4 id="id-label" class="css-h4">Data Final: <input class="css-input" type="date" name="datafinal" /></h4></p><br>';
			echo '<input id="id-btn" class="btn_enviar" type="Submit" value="Enviar" />';
			echo'</form>';
			
					
		}
		else{
			$datai= $datainicial;
			$dataf= $datafinal;
			$sql="Select date_format(s.data, '%d-%m-%Y - %H:%i') as data,  
			p.nome as produto, r.nome as retirante , 
			s.quantidade, s.obs from srs_output s
			inner join srs_product p on s.produto=p.id
			left join srs_requester r on r.id=s.retirante
			where date(s.data) between '$datai' and '$dataf'";
			
			echo '<h1>Relatório de '.$this->table.'</h1><br><br>';	
			echo '<table class="css-form">';
			echo '<tr class="css-form">
					<td class="header" style="width:220px; padding:10px">Data / Hora</td>
					<td class="header">Produto</td >
					<td class="header">Retirante</td>
					<td class="header">Quantidade</td>
					<td class="header">Observação</td>
				  </tr>';
			$dados=$this->conexaoDB->ExecutaQuery($sql);
			while($dado=mysql_fetch_object($dados)){
				
				echo '<tr class="css-form">'	;
				
				foreach ($dado as $campo) {
					
					echo '<td style="padding:2px">'.$campo.'</td>';
					
				}
		
				echo '</tr>';
				
			}
			
			echo '</table>';
			if($print=="n")
				echo '<br><a href="application/view/printrelatorio.php?acao=Entrada&tabela='.$this->table.'&datainicial='.$datainicial.'&datafinal='.$datafinal.'"><img src="img/save.png" class="img">SALVAR PARA ARQUIVO</a>';
			else
				echo '<br><a href="#" onclick="window.print()">IMPRIMIR</a>';
		
			
		}
			
	}
	
}

?>