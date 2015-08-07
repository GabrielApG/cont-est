<?php
/* Tratando erros qualquer duvida consulte link http://www.rafaelbiriba.com/2009/02/27/php-ocultando-erros-de-codigo.html*/
header("Content-Type: text/html; charset=ISO-8859-1", true);

error_reporting(0);
ini_set(display_errors, 0);


class Form {
	
	public $table;
	public $conexaoDB;
	public $fields;
	
	
	function __construct($table){
		
		$this->table=$table;
		$this->conexaoDB=new DB();
		$this->fields=$this->conexaoDB->ListarCampos($this->table);
		
		
	}
	
	#Campo de produtos
	function FormListaProdCategoria($filtro){
		
		
		echo '<h1>Lista de produtos cadastrados</h1>'; //: '.$filtro.'

		$sql_select = "Select * from srs_product where categoria like '$filtro%'";
		$resultado = mysql_query($sql_select);

		echo '<table class="css-form" align="center">';
			
			echo '<tr class="css-form">
				<td class="header">ID</td>
				<td class="header">Nome</td>
				<td class="header">Id Sap</td>
				<td class="header">Alocação</td>
				<td class="header">Saldo Atual</td>
				<td class="header">Alterar</td>
			</tr>';
	
			while($produto = mysql_fetch_array($resultado)){
	
			echo '<tr class="css-form">';
			echo '<td>'.$produto['id'].'</td>';
			echo '<td>'.$produto['nome'].'</td>';
			echo '<td>'.$produto['id_sap'].'</td>';
			echo '<td>'.$produto['alocacao'].'</td>';
			echo '<td>'.$produto['estoque_atual'].'</td>';
			echo '<td><a href="main.php?url=produto&acao=formeditar&id='.$produto['id'].'">Editar</a></td>';
			echo '</tr>';
				}
				
			echo '</table>';	
			echo '</form>';
		
		echo '<td><a href="main.php?url=categoria&acao=listar">Voltar</a></td>';
	
	}

	#Campo de produtos
	function FormBuscaCatPord(){
		
		$conecta_banco = mysql_select_db($db, $conexao);

		mysql_query("SET NAMES 'latin1_swedish_ci'");
		mysql_query('SET character_set_connection=latin1_swedish_ci');
		mysql_query('SET character_set_client=latin1_swedish_ci');
		mysql_query('SET character_set_results=latin1_swedish_ci');
			
		
		echo '<form id="form_busca_prod" name="form_busca_prod" method="get" action="recebePesCat.php">';
		
		echo '<h1>Insira a "categoria" para pesquisa</h1><br><br>';
		echo '<input type="text" name="field_nome"  id="field_nome" size="25" />';
		echo '<input type="submit" value="Pesquisar">';
		
		echo '</form>';
		
	}


	#Campo de produtos
	function FormListaPesq($filtro){
				
		echo '<h1>Pesquisa p/ o produto: '.$filtro.'</h1>';

		$sql_select = "Select * from srs_product where nome like '$filtro%'";
		$resultado = mysql_query($sql_select);

		echo '<table class="css-form" align="center">';
			
			echo '<tr class="css-form">
				<td class="header">ID</td>
				<td class="header">Nome</td>
				<td class="header">Id Sap</td>
				<td class="header">Alocação</td>
				<td class="header">Saldo Atual</td>
				<td class="header">Alterar</td>
			</tr>';
	
			while($produto = mysql_fetch_array($resultado)){
	
			echo '<tr class="css-form">';
				echo '<td>'.$produto['id'].'</td>';
				echo '<td>'.$produto['nome'].'</td>';
				echo '<td>'.$produto['id_sap'].'</td>';
				echo '<td>'.$produto['alocacao'].'</td>';
				echo '<td>'.$produto['estoque_atual'].'</td>';
				echo '<td><a href="main.php?url=produto&acao=formeditar&id='.$produto['id'].'">
					Editar</a></td>';
			echo '</tr>';
			
			}
				
			echo '</table>';	
			echo '</form>';
		
		echo '<td><a href="main.php?url='.produto.'&acao=formpesquisar">Voltar</a></td>';
	
	}
	
	
	#Campo de produtos
	function FormPesq(){

		echo '<h1>Insira o nome do produto para pesquisa</h1><br><br>';
			
		echo '<form class="css-form" id="form_pesquisa" name="form_pesquisa" method="get" action="recebePesq.php">';
		echo '<table class="header">';
		echo '<tr class="css-input">
		 		<td><label>Nome Produto</label>';
		echo '<input class="css-input" type="text" name="field_nome" size="55" aria-required="true" required="" class="required"/></td>
		 		</tr>';

		echo '<tr class="css-input">
				<td><input id="id-btn" class="btn_enviar" type="submit" value="Pesquisar"></td>
			  </tr>';
		
		echo '</table>';	
		echo '</form>';	
		
	}


	function FormCadastroFornecedor($url,$action,$combos="",$ajax=array()){

		$url=(empty($url))?$this->table:$url;
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);
		$combos=explode(',',$combos);
		
		$busca=mysql_query("SELECT * FROM srs_category ORDER BY nome")or die(mysql_error()); 

		echo '<h1>Cadastro de '.$this->table.'</h1>';
		echo '<form class="css-form" action="main.php?url='.$url.'&acao='.$action.'" method="post">';
		echo '<table class="header">';


		echo '<tr class="css-input">
		 		<td><label>Nome</label>
		 		<input class="css-input" maxlength="30" name="nome" type="text" aria-required="true" required="" class="required" size="30"></td>
		 		</tr>';

		echo '<tr class="css-input">
		 		<td><label>Telefone</label>
		 		<input class="css-input" maxlength="30" name="telefone" type="text" aria-required="true" required="" class="required" size="30"></td>
		 		</tr>';

		// echo '<tr class="css-input">
		//  		<td><label>Email</label>
		//  		<input class="css-input" maxlength="30" name="email" type="text" aria-required="true" required="" class="required" size="30"></td>
		//  		</tr>';

		echo '<tr class="css-input">
		 		<td><label>Estado</label>
		 		<input class="css-input" maxlength="30" name="estado" type="text" aria-required="true" required="" class="required" size="30"></td>
		 		</tr>'; 

		echo '<tr class="css-input">
		 		<td><label>Cidade</label>
		 		<input class="css-input" maxlength="30" name="cidade" type="text" aria-required="true" required="" class="required" size="30"></td>
		 		</tr>';

		// echo '<tr class="css-input">
		//  		<td><label>Rua</label>
		//  		<input class="css-input" maxlength="30" name="rua" type="text" aria-required="true" required="" class="required" size="30"></td>
		//  		</tr>';

		// echo '<tr class="css-input">
		//  		<td><label>Numero</label>
		//  		<input class="css-input" maxlength="30" name="numero" type="text" aria-required="true" required="" class="required" size="30"></td>
		//  		</tr>';

		echo '<tr class="css-input">
				<td><input class="btn_enviar" type="submit" value="Enviar"></td>
			  </tr>';
		echo '</table>';	
		echo '</form>';	
	
	}
	
	function FormCadastroCategoria($url,$action,$combos="",$ajax=array()){

		$url=(empty($url))?$this->table:$url;
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);
		$combos=explode(',',$combos);
		
		$busca=mysql_query("SELECT * FROM srs_category ORDER BY nome")or die(mysql_error()); 

		echo '<h1>Cadastro de '.$this->table.'</h1>';
		echo '<form class="css-form" action="main.php?url='.$url.'&acao='.$action.'" method="post">';
		echo '<table class="header">';


		echo '<tr class="css-input">
		 		<td><label>Categoria</label>
		 		<input class="css-input" maxlength="30" name="nome" type="text" aria-required="true" required="" class="required" size="30"></td>
		 		</tr>'; 

		echo '<tr class="css-input">
				<td><input class="btn_enviar" type="submit" value="Enviar"></td>
			  </tr>';
		echo '</table>';	
		echo '</form>';	
	
	}

	function FormCadastro($url,$action,$combos="",$ajax=array()){

		$url=(empty($url))?$this->table:$url;
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);
		$combos=explode(',',$combos);
		
		$busca=mysql_query("SELECT * FROM srs_category ORDER BY nome")or die(mysql_error()); 

		echo '<h1>Cadastro de '.$this->table.'</h1>';
		echo '<form class="css-form" action="main.php?url='.$url.'&acao='.$action.'" method="post">';
		echo '<table class="header">';


		echo '<tr class="css-input">
		 		<td><label>Categoria</label>';
		 //Preenche combo de categoria
		echo '<select class="css-input" name="categoria" aria-required="true" required="" class="required">
			 <option>Selecione...</option>';
			 
			while($prod = mysql_fetch_array($busca)) {

			 echo '<option value="'.$prod['id'].'">';
			 echo $prod['nome'].'</option>';
			  } 
		 
		echo '</select></td></tr>';

		echo '<tr class="css-input">
		 		<td>
		 		<label name="nome">Nome</label>
		 		<input class="css-input" maxlength="45" name="nome" type="text"  aria-required="true" required="" class="required" size="40"></td>
		 		</tr>';
		 
		echo '<tr class="css-input">
		 		<td>
		 		<label>Estoque Minimo</label>
		 		<input class="css-input" maxlength="3" name="estoque_minimo" type="text" aria-required="true" required="" class="required" size="40"></td>
		 		</tr>';

 		echo '<tr class="css-input">
		 		<td>
		 		<label name="alocacao">Alocacao</label>
		 		<input class="css-input" maxlength="15" name="alocacao" type="text" aria-required="true" required="" class="required" size="40"></td>
		 		</tr>';

		echo '<tr class="css-input">
		 		<td>
		 		<label name="id_sap">ID SAP</label>
		 		<input class="css-input" maxlength="10"  name="id_sap" type="text" aria-required="true" required="" class="required" size="40"></td>
		 		</tr>';
		 

		echo '<tr class="css-input">
				<td><input class="btn_enviar" type="submit" value="Enviar"></td>
			  </tr>';
		echo '</table>';	
		echo '</form>';	
	
	}

	function FormCadastroRetirante($url,$action,$combos="",$ajax=array()){

		$url=(empty($url))?$this->table:$url;
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);
		$combos=explode(',',$combos);
		
		$busca=mysql_query("SELECT * FROM srs_category ORDER BY nome")or die(mysql_error()); 

		echo '<h1>Cadastro de '.$this->table.'</h1>';
		echo '<form class="css-form" action="main.php?url='.$url.'&acao='.$action.'" method="post">';
		echo '<table class="header">';

		echo '<tr class="css-input">
		 		<td>
		 		<label name="nome">Nome</label>
		 		<input class="css-input" maxlength="45" name="nome" type="text"  aria-required="true" required="" class="required" size="15"></td>
		 		</tr>';
		 
		echo '<tr class="css-input">
		 		<td>
		 		<label>Empresa</label>
		 		<input class="css-input" maxlength="3" name="empresa" type="text" aria-required="true" required="" class="required" size="10"></td>
		 		</tr>';		 

		echo '<tr class="css-input">
				<td><input class="btn_enviar" type="submit" value="Enviar"></td>
			  </tr>';
		echo '</table>';	
		echo '</form>';	
	
	}

	function FormCadastroEntrada($url,$action,$combos="",$ajax=array()){
		
		require('conexao.php');
		

		$url=(empty($url))?$this->table:$url;
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);
		$combos=explode(',',$combos);
		
		$id= 1;

		$busca=mysql_query("SELECT * FROM srs_category ORDER BY nome")or die(mysql_error());
		$buscaProd=mysql_query("SELECT * FROM srs_product WHERE categoria= $id ORDER BY nome")or die(mysql_error());
		$buscaForn=mysql_query("SELECT * FROM srs_supplier ORDER BY nome")or die(mysql_error());

		echo '<h1>Cadastro de '.$this->table.'</h1>';
		echo '<form class="css-form" action="main.php?url='.$url.'&acao='.$action.'" method="post">';
		echo '<table class="header">';
		
		echo '<tr class="css-input"><td><label>Data</label>';
		echo '<input class="css-input" type="date" name="data" type="text"></input><br></tr></td>';

		 //Preenche combo de categoria
		echo '<tr class="css-input"><td><label for="">Categoria</label>';
		echo '<select class="css-input" name="categoria" id="categoria" onchange="getValor(this.value, 0)">
			  <option>Selecione...</option>';
			 
			while($prod = mysql_fetch_array($busca)) {

			 echo '<option value="'.$prod['id'].'">';
			 echo $prod['nome'].'</option>';
			  }  
		 echo '</select></tr></td>';

		//Combo Produto
		echo '<tr class="css-input"><td><label for="">Produto</label>';
		echo '<select class="css-input" name="produto" id="produto" aria-required="true" required="" class="required">';
			  //Aqui é preenchido com o AjaxProduto
		 echo '</select></tr></td>';

		//Combo Fornecedor
		echo '<tr class="css-input"><td><label>Fornecedor</label>';
 		echo '<select class="css-input" name="fornecedor" aria-required="true" required="" class="required">
				 <option>Selecione...</option>';
			
			while($forn = mysql_fetch_array($buscaForn)) {

				 echo '<option value="'.$forn['id'].'">';
				 echo $forn['nome'].
				'</option>';
			} 
		echo '</select></tr></td>';
		echo '<tr class="css-input"><td>
		 		<label>Quantidade</label>
		 		<input class="css-input" name="quantidade" type="text" aria-required="true" required="" class="required"></tr></td>';
		
		echo '<tr class="css-input"><td>
		 		<label>Obs</label>
		 		<input class="css-input" name="obs" type="text" aria-required="true" required="" class="required"></tr></td>';
		echo '<tr class="css-input"><td>
		 		<label>N. Nota</label>
		 		<input class="css-input" name="num_nota" type="text" aria-required="true" required="" class="required"></tr></td>';
		 echo '<tr class="css-input"><td>
		 		<label>N. Pedido</label>
		 		<input class="css-input" name="num_pedido" type="text" aria-required="true" required="" class="required"></tr></td>';
		 echo '<tr class="css-input"><td>
		 		<label>Valor Unitario</label>
		 		<input class="css-input" name="valor_unitario" type="text" aria-required="true" required="" class="required"></tr></td>';
		echo '<tr class="css-input">
				<td><input type="submit" class="btn_enviar" value="Enviar"></td>
			  </tr>';
		echo '</table>';	
		echo '</form>';	
	}

	function FormCadastroSaida($url,$action,$combos="",$ajax=array()){
		
		require('conexao.php');
		

		$url=(empty($url))?$this->table:$url;
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);
		$combos=explode(',',$combos);
		
		$id= 1;

		$busca=mysql_query("SELECT * FROM srs_category ORDER BY nome")or die(mysql_error());
		$buscaRet=mysql_query("SELECT * FROM srs_requester ORDER BY nome")or die(mysql_error());

		echo '<h1>Cadastro de '.$this->table.'</h1>';
		echo '<form class="css-form" action="main.php?url='.$url.'&acao='.$action.'" method="post">';
		echo '<table class="header">';
		
		echo '<tr class="css-input"><td><label>Data</label>';
		echo '<input class="css-input" type="date" name="data" id="data" type="text"></input><br></tr></td>';

		 //Preenche combo de categoria
		echo '<tr class="css-input"><td><label for="">Categoria</label>';
		echo '<select class="css-input" name="categoria" id="categoria" onchange="getValor(this.value, 0)">
			  <option>Selecione...</option>';
			 
			while($prod = mysql_fetch_array($busca)) {

			 echo '<option value="'.$prod['id'].'">';
			 echo $prod['nome'].'</option>';
			  }  
		 echo '</select></tr></td>';

		//Combo Produto
		echo '<tr class="css-input"><td><label for="">Produto</label>';
		echo '<select class="css-input" name="produto" id="produto">';
			  //Aqui é preenchido com o AjaxProduto
		 echo '</select></tr></td>';

		//Combo Fornecedor
		echo '<tr class="css-input"><td><label>Retirante</label>';
 		echo '<select class="css-input" name="retirante">
				 <option>Selecione...</option>';
			
			while($ret = mysql_fetch_array($buscaRet)) {

				 echo '<option value="'.$ret['id'].'">';
				 echo $ret['nome'].
				'</option>';
			} 
		echo '</select></tr></td>';
		echo '<tr class="css-input"><td>
		 		<label>Quantidade</label>
		 		<input class="css-input" name="quantidade" type="text"></tr></td>';

		echo '<tr class="css-input"><td>
		 		<label>Observacao</label>
		 		<input class="css-input" name="obs" type="text"></tr></td>';
		
		echo '<tr class="css-input">
				<td><input type="submit" class="btn_enviar" value="Enviar"></td>
			  </tr>';

		echo '</table>';	
		echo '</form>';	
	}
	
	
	function FormEditar($action,$id,$combos,$block="",$ajax=array()){
	
	
		$produto=$this->conexaoDB->PesquisaUnica($this->table,$id);	
		$combos=explode(',',$combos);
		$campos=substr($this->fields,0,-1);
		$campos=explode(',',$campos);
		
		echo '<h1>Atualizacao de '.$this->table.'</h1>';
		echo '<form action="main.php?url='.$this->table.'&acao='.$action.'&id='.$id.'" method="post" class="css-form">'; 
		echo '<table class="header">';
		
		foreach ($campos as $campo) 
		{
			
			if($campo<>'id' and $campo<>'estoque_atual' and $campo<>'estoque_minimo')
			
			{
				if(array_search($campo,$combos)==FALSE)
				{
						if($campo == 'categoria' ){
							$js="";
						
							echo '<tr class="css-form"><td>'.ucfirst($campo).'</td><td>';
							$this->Combo($campo,$campo,'id','nome',$js);
							echo '</td></tr>';
						}else{
							$campotxt=str_replace("_"," ",$campo);
							echo '<tr class="css-form"><td>'.ucfirst($campotxt)."</td>
							<td><input class='css-input' type='text' name='$campo' value='$produto[$campo]'></td></tr>";
						}
				} else {
					
						if(array_search($campo,$ajax)==FALSE)
						{
								
								$js="";
						} else {
								
								$js="onChange='Ajax(\"categoria\",\"produto\",\"produto\")'";
						}
						echo '<tr class="css-form"><td>'.ucfirst($campo).'</td><td>';
						$this->Combo($campo,$campo,'id','nome',$js,$produto[$campo]);
						echo '</td></tr>';
				}
			}
		}
		
		echo '<tr class="css-form"><td><input type="submit" value="Enviar" class="btn_enviar"></td></tr>';
		echo '</table>';	
		echo '</form>';	
	}
	
	/*SELECT OPTION*/
	function Combo($tabela,$nome,$value,$option,$script,$where=""){
		
		if(!empty($where)){
			$values=$this->conexaoDB->PesquisaUnica($tabela,$where);
			$opt='<option value="'.$values[$value].'">'.$values[$option].'</option>';	
			
		}
		else{
			$opt='<option value="" selected="selected"></option>';
		}
		
		$values=$this->conexaoDB->PesquisaTabela($tabela,$where);
		
		echo '<select class="css-option" name="'.$nome.'" '.$script.' id="'.$nome.'" aria-required="true" required="" class="required">';
		echo $opt;	
		while($row=mysql_fetch_array($values)){
			
			echo '<option value="'.$row[$value].'">'.$row[$option].'</option>\n';
		}
		
		echo '</select>';
		
	}
	
	function ConverteDataInput($data){
		
		$novadata=split("[-,/,\]",$data);
		$novadata=$novadata[2]."-".$novadata[1]."-".$novadata[0];
		return $novadata;
	}
	

}

?>