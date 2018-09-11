<?php
	session_start();
	require_once('db.class.php');
	
	if ( !isset ( $_SESSION['usuario'])){
		header ( 'Location: index.php?erro=1');
	}	
	
	$id_usuario = $_SESSION['id_usuario'];	
	$deixar_seguir_id_usuario = $_POST['deixar_seguir_id_usuario'];
	
	if ( $id_usuario == '' || $deixar_seguir_id_usuario == ''){
		die();
	}
	
	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	
	$sql = "delete from usuarios_seguidores where id_usuario = $id_usuario and seguindo_id_usuario = $deixar_seguir_id_usuario";
	echo $sql;
	
	mysqli_query($link, $sql);
	
?>