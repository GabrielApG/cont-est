<?php

include 'application/controler/Produtos.php';
include 'application/controler/Categorias.php';
include 'application/controler/Retirantes.php';
include 'application/controler/Fornecedores.php';
include 'application/controler/Form.php';
include 'application/controler/Relatorios.php';
//include 'application/controler/DB.php';


if(IsSet($_COOKIE["logado"])){
   
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
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width" />
      <title>Almoxarife Painting</title>
   

      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="css/template-style.css">
      
      <link rel="shortcut icon" href="img/cnh.ico" type="image/x-icon" /> 

      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>    
      <script type="text/javascript" src="js/responsee.js"></script>
      <script type="text/javascript" src="js/modernizr.js"></script>
      <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      

    <script type="text/javascript" src="js/jQuery.js"></script>
    <script type="text/javascript">
      
      function getValor(valor){

         $("#produto").html("<option value='0'>Carregando...</option>");
         setTimeout(function(){
            $("#produto").load("application/model/AjaxProduto.php",{id:valor})
         }, 2000);
      };
    </script>

   </head>
   <body class="size-1140">
      <div id="all-content" class="with-sticky-footer">
         <!-- TOP NAV WITH LOGO -->
         <header>
            <nav>
               <div class="line">
                  <div class="s-12 l-2"><a href="main.php">
                     <img class="s-5 l-12 center" src="img/cnh-30.png"></a>
                  </div>
                  <div class="top-nav s-12 l-10 right">
                     <p class="nav-text">Menu</p>
                     <ul class="right">
                        <li><a href="main.php">Inicio</a></li>
                        
                        <li><a>Produtos</a>
                           <ul>
                              <li><a href="main.php?url=categoria&acao=formcadastrocategoria">Cadastrar Categoria</a></li>
                              <li><a href="main.php?url=produto&acao=formcadastro">Cadastrar Produtos</a></li>
                              <li><a href="main.php?url=produto&acao=listar">Listar Produtos</a></li>
                              <li><a href="main.php?url=categoria&acao=listar">Listar Categorias</a></li>
                              <li><a href="main.php?url=produto&acao=formpesquisar">Pesquisar Produtos</a></li>
                           </ul>
                        </li>
                        <li>
                           <a>Estoque</a>
                           <ul>
                              <li><a href="main.php?url=estoque&acao=formcadastroentrada">Entrada de Material</a></li>
                              <li><a href="main.php?url=estoque&acao=formcadastrosaida">Saida de Material</a></li>
                           </ul>
                        </li>
                        <li><a>Fornecedores</a>
                        <ul>
                           <li><a href="main.php?url=fornecedor&acao=formcadastro">Cadastrar Fornecedor</a></li>
                           <li><a href="main.php?url=fornecedor&acao=listar">Listar Fornecedores</a></li>
                        </ul>
                     </li>
                     <li><a>Retirantes</a>
                        <ul>
                           <li><a href="main.php?url=retirante&acao=formcadastro">Cadastrar Retirante</a></li>
                           <li><a href="main.php?url=retirante&acao=listar">Listar Retirantes</a></li>
                        </ul>
                     </li>
                     <li><a>Relatorios</a>
                        <ul>
                           <li><a href="main.php?url=relatorio&acao=produto">Produtos</a></li>
                           <li><a href="main.php?url=relatorio&acao=fornecedor">Fornecedores</a></li>
                           <li><a href="main.php?url=relatorio&acao=retirante">Retirantes</a></li>
                           <li><a href="main.php?url=relatorio&acao=entrada">Entrada</a></li>
                           <li><a href="main.php?url=relatorio&acao=saida">Saida</a></li>
                        </ul>
                     </li>
                     <li><a>Usuarios</a>
                        <ul>
                           <li><a href="usuario.php">Cadastrar</a></li>
                           </ul>
                     </li>
                    <!--  <li><a href="logout.php">logout</a>    
                     </li> -->
                     </ul>
                  </div>
               </div>
            </nav>
         </header>
         <section>
            <!-- FIRST BLOCK -->
            <div id="first-block">
               <div class="line">
                  <div class="margin-bottom">
                     <div class="margin">
                        <article class="s-12">
                           <!-- <h1>Login</h1> -->
                        </article>
                      </div>
                           
                           <div id="Content">
                                    <?php
                                    include 'application/controler/DB.php';
                                    include 'application/view/'.$url.'.phtml'; 
                                    ?>
                           </div>
                        </div>

<!--                         <p align="center"><font color="#C0C0C0"> Developer: Gabriel Ap. </font></p> -->

                           </center>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </body>
</html>