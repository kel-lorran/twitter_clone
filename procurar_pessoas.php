<?php
	session_start();
	
	if( !isset( $_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		<script type="text/javascript">
			$(document).ready( function(){
				function contaTweetSeguidores(){$.ajax({
					url: 'conta_tweets_seguidores.php',
					success: function(data){
						var qtde_tweets = data;
						$('#qtde_tweets_followers').html(data);
					}
				});
				}
				contaTweetSeguidores();
				//associar o evento de click ao botão
				$('#btn_procurar_pessoa').click( function(){
					if($('#nome_pessoa').val().length > 0){
						$.ajax({
							url: 'get_pessoas.php',
							method: 'post',
							data: $('#form_procurar_pessoas').serialize(),
							success: function(data){
								$('#pessoas').html(data);
								$('.btn-seguir').click( function(){
									var id_usuario = $(this).data('id_usuario');
									
									$('#btn_seguir_' + id_usuario).hide();
									$('#btn_deixar_seguir_' + id_usuario).show();
									
									$.ajax({
										url: 'seguir.php',
										method: 'post',
										data: {seguir_id_usuario: id_usuario},
										success: function(data){
											alert('Você já está seguindo essa pessoa!');
										}
									});
								});
								$('.btn-deixar-seguir').click( function(){
									var id_usuario = $(this).data('id_usuario');
									
									$('#btn_deixar_seguir_' + id_usuario).hide();
									$('#btn_seguir_' + id_usuario).show();
									
									$.ajax({
										url: 'deixar_seguir.php',
										method: 'post',
										data: {deixar_seguir_id_usuario: id_usuario},
										success: function(data){
											alert('Você deixou de seguir essa pessoa!');
										}
									});
								});
							}
						});
					}
				});
				
			});
		</script>
	
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="home.php">Home</a></li>
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">	    	

	    	<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><?= $_SESSION['usuario']?></h4>
						<hr/>
						<div class="row" id="qtde_tweets_followers">
							
						</div>
					</div>
				</div>
			</div>
	    	<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<form id="form_procurar_pessoas" class="input-group">
							<input type="text" name="nome_pessoa" id="nome_pessoa" class="form-control" placeholder="Quem você está procurando?" maxlength="140" />
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn_procurar_pessoa" type="button">Procurar</button>
							</span>
						</form>
					</div>
				</div>
				<div id="pessoas" class="list-group">
					
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
					</div>
				</div>
			</div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>