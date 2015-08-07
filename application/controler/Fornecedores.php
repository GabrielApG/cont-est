<?php

class Fornecedores extends Produtos   {
	
	
	public $tabela;
	public $id;
	public $conexaoDB;

	
	#Construtor - Conecta e seleciona a tabela
	function __construct() {
		
		$this->conexaoDB=new DB();
		$this->tabela="fornecedor";
	
	}
	
	#Cadastra ou chama o o metodo para atualizacao dos produtos

	#Lista produtos
	function Listar(){
				
		$fornecedores=$this->conexaoDB->PesquisaCampos("id,nome,telefone, estado, cidade",$this->tabela);
			
		echo '<h1>Listando '.$this->tabela.'</h1><br><br>';
		// Campo para pesquisa pelo Nome

		echo '<table align="center" class="css-input">';
		//echo '<tr><td class="header">ID</td><td class="header">Nome</td><td></td><td></td></tr>';
		echo '<tr class="css-input">
				<td class="header">ID</td>
			     <td class="header">Nome</td>
				 <td class="header">Telefone</td>
				 <td class="header">Estado</td>
				 <td class="header">Cidade</td>
				 <td class="header">Alterar</td>
			  </tr>';
		
		while($fornecedor=mysql_fetch_array($fornecedores)){
			
			echo '<tr class="css-input">';
			echo '<td>'.$fornecedor['id'].'</td>';
			echo '<td>'.$fornecedor['nome'].'</td>';
			echo '<td>'.$fornecedor['telefone'].'</td>';
			echo '<td>'.$fornecedor['estado'].'</td>';
			echo '<td>'.$fornecedor['cidade'].'</td>';
			echo '<td><a href="main.php?url='.$this->tabela.'&acao=formeditar&id='.$fornecedor['id'].'">Editar</a></td>';
			//echo '<td><a href="main.php?url='.$this->tabela.'&acao=deletar&id='.$produto['id'].'">Excluir</a></td>';
			echo '</tr>';
		}
		echo '</table>';
	}

	// FormEditar("editar",$id,"categoria,''");*/
	function FormEditar($action,$id,$combos,$block="",$ajax=array()){
	
	
		$produto=$this->conexaoDB->PesquisaUnica($this->table,$id);	
		$combos=explode(',',$combos);
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);
		
		echo '<h1>Atualização de '.$this->table.'</h1>';
		echo '<form action="main.php?url='.$this->table.'&acao='.$action.'&id='.$id.'" method="post">'; 
		echo '<table>';
		
		foreach ($campos as $campo) 
		{
			
			if($campo<>'id' and $campo<>'estoque_atual' and $campo<>'estoque_minimo')
			
			{
				if(array_search($campo,$combos)==FALSE)
				{
						if($campo == 'categoria' ){
							$js="";
						
							echo '<tr><td>'.ucfirst($campo).'</td><td>';
							$this->Combo($campo,$campo,'id','nome',$js);
							echo '</td></tr>';
						}else{
							$campotxt=str_replace("_"," ",$campo);
							echo '<tr><td>'.ucfirst($campotxt)."</td><td><input type='text' name='$campo' value='$produto[$campo]'></td></tr>";
						}
				} else {
					
						if(array_search($campo,$ajax)==FALSE)
						{
								
								$js="";
						} else {
								
								$js="onChange='Ajax(\"categoria\",\"produto\",\"produto\")'";
						}
						echo '<tr><td>'.ucfirst($campo).'</td><td>';
						$this->Combo($campo,$campo,'id','nome',$js,$produto[$campo]);
						echo '</td></tr>';
					
				}
			}
		}
		
		echo '<tr><td><input type="submit" value="Enviar"></td></tr>';
		echo '</table>';	
		echo '</form>';	
	}
	
	
}

?>