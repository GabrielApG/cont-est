<?php
header("Content - Type: text/html; charset=ISO-8859-1", true);
echo"<p></p>";

$nome = $_GET['field_nome'];

Header("location:main.php?url=produto&acao=listapesquisa&id=$nome");

?>