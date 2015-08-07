<?

header("Content - Type: text/html; charset=ISO-8859-1", true);

setcookie("logado", "", "time()-1");


?>
<html>
<head>
<title>CONTROLE DE ESTOQUE</title>
<style type="text/css">
@import url("styles/index.css");
@import url("styles/menu.css");
</style>
<script type="text/javascript" src="application/js/jquery.min.js"></script>
<script type="text/javascript" src="application/js/menu.js"></script>
<script type="text/javascript" src="application/js/functions.js"></script>
<meta http-equiv="refresh" content="3;url=index.php">

<script language="JavaScript">
  function deleteCookie(nome){
    var exdate = new Date();
    exdate.setTime(exdate.getTime() + (-1 * 24 * 3600 
       * 1000));
    document.cookie = nome + "=" + escape("")+ ((-1 
       == null) ? "" : "; expires=" + exdate);
  }  
</script>

</head>
<body>
<div id="Full">
<div id="Logo"><h3>CONTROLE DE ESTOQUE</h3></div>
	<div id="Menu">
	</div>
	<ul id="jsddm">
	<br>
	<br>
	<br>
	<br>
	<center>
	<b> Voce foi deslogado! </b>
<script language="JavaScript">
  deleteCookie("logado");
</script>

</body>
</html>
