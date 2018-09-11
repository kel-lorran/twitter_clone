<?php
	session_start();
	
	if ( !isset( $_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}
	
	require_once('db.class.php');
	
	$id_usuario = $_SESSION['id_usuario'];
	
	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$sql = "select count(*) as qtde_tweets from tweet where id_usuario = $id_usuario";
	
	$resultado_id = mysqli_query($link, $sql);
	if ( !$resultado_id){
		echo 'Erro na consulta de tweets no banco de dados!';
	} 
	$qtde_tweets = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	
	$sql = "SELECT count(*) as qtde_seguidores from usuarios_seguidores where seguindo_id_usuario = $id_usuario";
	
	$resultado_id = mysqli_query($link, $sql);
	if ( !$resultado_id){
		echo 'Erro na consulta de tweets no banco de dados!';
	} 
	$qtde_seguidores = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	
	echo '<div class="col-md-6 text-center">TWEETS<br/>'.$qtde_tweets['qtde_tweets'].'</div>';
	echo '<div class="col-md-6 text-center">SEGUIDORES<br>'.$qtde_seguidores['qtde_seguidores'].'</div>';
	
?>