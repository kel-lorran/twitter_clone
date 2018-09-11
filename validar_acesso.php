<?php

	session_start();
	
	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$senha = md5($_POST['senha']);
	
	$sql = "select id, usuario, email from usuarios where usuario = '$usuario' AND senha = '$senha'";
	
	$objDb = new db();
	$link = $objDb->conecta_mysql();
	
	$resultado_id = mysqli_query( $link, $sql);
	
	//update retorno: true/false
	//insert retorno: true/false
	//select retorno: false/ resource
	//delete retorno: true/ false
	
	if( $resultado_id ){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		
		if( isset( $dados_usuario['usuario']) ){
			
			$_SESSION['id_usuario'] = $dados_usuario['id'];
			$_SESSION['usuario'] = $dados_usuario['usuario'];
			$_SESSION['email'] = $dados_usuario['email'];
						
			header('Location: home.php');
		} else {
			header( 'Location: index.php?erro=1');
		}
		
	} else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin so site';
	}
	
	
	var_dump($dados_usuario);
?>