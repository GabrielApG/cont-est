<?php

header("Content-Type: text/html; charset=ISO-8859-1", true);

class Retirantes extends Produtos   {
	
	
	public $tabela;
	public $id;
	public $conexaoDB;
	
	#Construtor - Conecta e seleciona a tabela
	function __construct() {
		
		$this->conexaoDB=new DB();
		$this->tabela="retirante";
	
	}

	#Lista produtos
	function Listar(){
				
		$retirantes=$this->conexaoDB->PesquisaCampos("id,nome,empresa",$this->tabela);
			
		echo '<h1>Listando '.$this->tabela.'</h1><br><br>';
		// Campo para pesquisa pelo Nome

		echo '<table align="center" class="css-form">';
		//echo '<tr><td class="header">ID</td><td class="header">Nome</td><td></td><td></td></tr>';
		echo '<tr class="css-form">
				<td class="header">ID</td>
			     <td class="header">Nome</td>
				 <td class="header">Empresa</td>
				 <td class="header">Alterar</td>
			  </tr>';
		
		while($retirante=mysql_fetch_array($retirantes)){
			
			echo '<tr class="css-form">';
				echo '<td>'.$retirante['id'].'</td>';
				echo '<td>'.$retirante['nome'].'</td>';
				echo '<td>'.$retirante['empresa'].'</td>';
				echo '<td><a href="main.php?url='.$this->tabela.'&acao=formeditar&id='.$retirante['id'].'">
				Editar</a></td>';
				//echo '<td><a href="main.php?url='.$this->tabela.'&acao=deletar&id='.$produto['id'].'">Excluir</a></td>';
		   echo '</tr>';
		}
		echo '</table>';
	}
		
}

?>