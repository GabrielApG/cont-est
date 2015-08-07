<?php 

require('../controler/conexao.php');

$id = $_POST["id"];

$buscaProd = mysql_query("SELECT * FROM srs_product WHERE categoria = $id ORDER BY nome")or die(mysql_error());
		
		while($prod = mysql_fetch_array($buscaProd)) {

		 echo '<option value="'.$prod['id'].'">';
		 echo $prod['nome'].'</option>';
		  } 	 

?>