<?php

header("Content-Type: text/html; charset=ISO-8859-1", true);

class Produtos {
	
	
	public $tabela;
	public $id;
	public $conexaoDB;
	public $quantidadeatual;
		
	#Construtor - Conecta e seleciona a tabela
	function __construct($tabela="produto",$produto="0") {
		
		
		$this->conexaoDB=new DB();
		$this->tabela=$tabela;
		$produto=$this->conexaoDB->PesquisaUnica($this->tabela,$produto);
		$this->quantidadeatual=$produto['estoque_atual'];
		
		$this->pesquisa=new DB();
		$produto=$this->pesquisa->PesquisaCamposNome($this->tabela,$produto);
				
		}
	
	#Cadastra ou chama o o metodo para atualizacao dos produtos
	function Cadastrar($id=""){

		echo '<h1>Produto Cadastrado</h1><br>';
		echo '<a class="css-input" href="main.php?url=produto&acao=formcadastro">Novo Produto</a>';
		//echo '<input class="btn_enviar" type="submit" value"Novo"></input>';

		$funcao=(empty($id))?"Insert into":"Update";
		$where=(empty($id))?" ":" where id = $id";
		$dados=$_POST;
		
        $campos="";		
		foreach ($dados as $campo=>$valor){
			
			$campos.=$campo."='$valor', ";			
		
		}
		
		$campos=strip_tags($campos);
		$campos=substr($campos,0,-2);
		
		//"de para" com nomes das tabelas
		switch($this->tabela) {
			case produto:
				$newtable = 'srs_product';
				break;
			case categoria:
				$newtable = 'srs_category';
				break;
			case entrada:
				$newtable = 'srs_input';
				break;
			case saida:
				$newtable = 'srs_output';
				break;
			case retirante:
				$newtable = 'srs_requester';
				break;
			case fornecedor:
				$newtable = 'srs_supplier';
				break;
		}
		
		$this->conexaoDB->ExecutaQuery("$funcao $newtable SET $campos $where");
		header("Location:main.php");
	}
	
	
	#Atualiza produto
	function Atualizar($id){
		
		header("Content-Type: text/html; charset=ISO-8859-1", true);
		$this->Cadastrar($id);
		
		
	}
	
	
	#Deleta produto
	function Deletar($id){
				
		//"de para" com nomes das tabelas
		switch($this->tabela) {
			case produto:
				$newtable = 'srs_product';
				break;
			case categoria:
				$newtable = 'srs_category';
				break;
			case entrada:
				$newtable = 'srs_input';
				break;
			case saida:
				$newtable = 'srs_output';
				break;
			case retirante:
				$newtable = 'srs_requester';
				break;
			case fornecedor:
				$newtable = 'srs_supplier';
				break;
		}
		
		$this->conexaoDB->ExecutaQuery("Delete from $newtable where id=$id");
		header("Location:main.php?url=$this->tabela&acao=listar");
	}
	
		
	#Lista produtos
	function Listar(){
				
		$produtos=$this->conexaoDB->PesquisaCampos("id,nome,id_sap, alocacao, estoque_atual",$this->tabela);
		
		//echo '<img src="img/lista_01.png">';

		echo '<a href="relatorios/geraRelListaProd.php" target="blanck">IMPRIMIR</a>';
		
		echo '<h1>Listando '.$this->tabela.'</h1><br><br>';
		// Campo para pesquisa pelo Nome

		echo '<table align="center" class="css-form">';
		//echo '<tr><td class="header">ID</td><td class="header">Nome</td><td></td><td></td></tr>';
		echo '<tr class="css-form">
				<td class="header">ID</td>
			     <td class="header">Nome</td>
				 <td class="header">Id SAP</td>
				 <td class="header">Alocacao</td>
				 <td class="header">Saldo Atual</td>
				 <td class="header">Alterar</td>
			  </tr>';
		
		while($produto=mysql_fetch_array($produtos)){
			
			echo '<tr class="css-form">';
			echo '<td>'.$produto['id'].'</td>';
			echo '<td>'.$produto['nome'].'</td>';
			echo '<td>'.$produto['id_sap'].'</td>';
			echo '<td>'.$produto['alocacao'].'</td>';
			echo '<td>'.$produto['estoque_atual'].'</td>';
			echo '<td><a href="main.php?url='.$this->tabela.'&acao=formeditar&id='.$produto['id'].'">Editar</a></td>';
			//echo '<td><a href="main.php?url='.$this->tabela.'&acao=deletar&id='.$produto['id'].'">Excluir</a></td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	

	function Entrada($produto,$quantidade){
	
		echo '<a href="main.php?url=estoque&acao=formcadastroentrada">Cadastrar nova Entrada</a>';
		$dados=$_POST;
		foreach ($dados as $campo=>$valor){
		if($campo=='data'){
			$valor="NOW()";	
		}
			$campos.=$campo."='$valor' ,";			
		}
		
		//"de para" com nomes das tabelas
		switch($this->tabela) {
			case produto:
				$newtable = 'srs_product';
				break;
			case categoria:
				$newtable = 'srs_category';
				break;
			case entrada:
				$newtable = 'srs_input';
				break;
			case saida:
				$newtable = 'srs_output';
				break;
			case retirante:
				$newtable = 'srs_requester';
				break;
			case fornecedor:
				$newtable = 'srs_supplier';
				break;
		}
		
		$campos=strip_tags($campos);
		$campos=substr($campos,0,-2);
		$campos=str_replace("'NOW()'","NOW()",$campos);
		$id=mysql_insert_id($this->conexaoDB->ExecutaQuery("Insert into srs_input SET $campos"));
		$this->conexaoDB->ExecutaQuery("Update $newtable set estoque_atual=estoque_atual+$quantidade where id=$produto");
		header("Location:main.php?url=produto&acao=entrada");
				
		
	}
	
	function Saida($produto,$quantidade){
				
		if($this->quantidadeatual<$quantidade){
		echo '<h3>A quantidade a Ser Retirada é maior do que a existente no estoque</h3>';
		echo '<br>
		      <a href="main.php?url=estoque&acao=formcadastrosaida">Click aqui para voltar</a>';
		exit();
		}
		else
		{
		$dados=$_POST;
		foreach ($dados as $campo=>$valor){
			if($campo=='data'){
			$valor="NOW()";	
		}	
			$campos.=$campo."='$valor' ,";			
		}
		
		//"de para" com nomes das tabelas
		switch($this->tabela) {
			case produto:
				$newtable = 'srs_product';
				break;
			case categoria:
				$newtable = 'srs_category';
				break;
			case entrada:
				$newtable = 'srs_input';
				break;
			case saida:
				$newtable = 'srs_output';
				break;
			case retirante:
				$newtable = 'srs_requester';
				break;
			case fornecedor:
				$newtable = 'srs_supplier';
				break;
		}
		
		$campos=strip_tags($campos);
		$campos=substr($campos,0,-2);
		$campos=str_replace("'NOW()'","NOW()",$campos);
		$id=mysql_insert_id($this->conexaoDB->ExecutaQuery("Insert into srs_output SET $campos"));
		$this->conexaoDB->ExecutaQuery("Update $newtable set estoque_atual=estoque_atual-$quantidade where id=$produto");
		}
		header("Location:main.php");
	}
	
	
	function EstoqueMinimo(){
		
		//"de para" com nomes das tabelas
		switch($this->tabela) {
			case produto:
				$newtable = 'srs_product';
				break;
			case categoria:
				$newtable = 'srs_category';
				break;
			case entrada:
				$newtable = 'srs_input';
				break;
			case saida:
				$newtable = 'srs_output';
				break;
			case retirante:
				$newtable = 'srs_requester';
				break;
			case fornecedor:
				$newtable = 'srs_supplier';
				break;
		}
	
		$sql="Select nome from $newtable where estoque_atual<=estoque_minimo"; //+2
	
		$produtos=$this->conexaoDB->ExecutaQuery($sql);
		$nlinhas=$this->conexaoDB->Nlinhas($produtos);
		
			echo '<a href="relatorios/geraRelCritico.php" target="blanck">IMPRIMIR ESTOQUE CRITICO</a><br><br>';
		if($nlinhas>0){
			
			echo '<table class="css-form" align="center" height=50 width=350>';
			
			echo '<tr align="left" class="css-form">
					<td class="header" colspan="2">
					<span style="color:red;">
					Estoque critico</span></td>	

				  </tr>';
					
			while($produto=mysql_fetch_array($produtos)) {
	
				echo '<tr align=left class="css-form">';
				echo '<td colspan="2">'.$produto['nome'].'</td>';
				echo '</tr>';
				
			}		
				echo '</table>';
			
				
		} else {
			echo '<h3>Nenhum alerta para hoje</h3>';
		}
	}
	
	/*function EstoqueMinimo(){
	
		//"de para" com nomes das tabelas
		switch($this->tabela) {
			case produto:
				$newtable = 'srs_product';
				break;
			case categoria:
				$newtable = 'srs_category';
				break;
			case entrada:
				$newtable = 'srs_input';
				break;
			case saida:
				$newtable = 'srs_output';
				break;
			case retirante:
				$newtable = 'srs_requester';
				break;
			case fornecedor:
				$newtable = 'srs_supplier';
				break;
		}
	
	$sql="Select nome from $newtable where estoque_atual<=estoque_minimo";	
		
	$produtos=$this->conexaoDB->ExecutaQuery($sql);
	$nlinhas=$this->conexaoDB->Nlinhas($produtos);
		
		if($nlinhas>0){
			echo '<img src="img/alert.png"><br />';	
			while($produto=mysql_fetch_array($produtos)) {

			   echo '<big><b><span style="color:red;">'.$produto['nome']." chegou ao estoque mínimo</span></b></big><br>";
			}
			
		} else {
			echo '<img src="img/ok.png" class="img">';
			echo 'Nenhum alerta para hoje';
		}
	}*/
	/*
	function EstoqueBom(){
		
		//"de para" com nomes das tabelas
		switch($this->tabela) {
			case produto:
				$newtable = 'srs_product';
				break;
			case categoria:
				$newtable = 'srs_category';
				break;
			case entrada:
				$newtable = 'srs_input';
				break;
			case saida:
				$newtable = 'srs_output';
				break;
			case retirante:
				$newtable = 'srs_requester';
				break;
			case fornecedor:
				$newtable = 'srs_supplier';
				break;
		}
		
	$sql="Select nome from $newtable where estoque_atual<=estoque_minimo+2";	
		
	$produtos=$this->conexaoDB->ExecutaQuery($sql);
	$nlinhas=$this->conexaoDB->Nlinhas($produtos);
		
		if($nlinhas<0){
			while($produto=mysql_fetch_array($produtos)) {

			   echo '<big><b><span style="color:green;">'.$produto['nome']." +2 vezes estoque mï¿½nimo</span></b></big><br>";
			}
		} 
	}*/
}

?>