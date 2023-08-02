<nav class="navbar navbar-expand-lg menu">
	<div class="container">
	  <div class="navbar-nav">
	  	<a class="menuItem" href="/timeline">
	  		Home
	  	</a>

	  	<a class="menuItem" href="/sair">
	  		Sair
	  	</a>
			<img src="/img/twitter_logo.png" class="menuIco" />
	  </div>
	</div>
</nav>

<div class="container mt-5">
	<div class="row pt-2">
		
		<div class="col-md-3">

			<div class="perfil">
				<div class="perfilTopo">

				</div>

				<div class="perfilPainel">
					
					<div class="row mt-2 mb-2">
						<div class="col mb-2">
							<span class="perfilPainelNome"><?= $this->view->informacoes_usuario['USUARIO'] ?></span>
						</div>
					</div>

					<div class="row mb-2">

						<div class="col">
							<span class="perfilPainelItem">Tweets</span><br />
							<span class="perfilPainelItemValor"><?= $this->view->informacoes_usuario['TOTAL_TWEETES'] ?></span>
						</div>

						<div class="col">
							<span class="perfilPainelItem">Seguindo</span><br />
							<span class="perfilPainelItemValor"><?= $this->view->informacoes_usuario['TOTAL_SEGUINDO'] ?></span>
						</div>

						<div class="col">
							<span class="perfilPainelItem">Seguidores</span><br />
							<span class="perfilPainelItemValor"><?= $this->view->informacoes_usuario['TOTAL_SEGUIDORES'] ?></span>
						</div>

					</div>

				</div>
			</div>

		</div>

		<div class="col-md-6">
			<div class="row mb-2">
				<div class="col tweetBox">
					<form action="/tweet" method="POST">
						<textarea class="form-control" name ="tweet" id="exampleFormControlTextarea1" rows="3"></textarea>
						
						<div class="col mt-2 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary">Tweet</button>
						</div>

					</form>
				</div>
			</div>

			<?php foreach($this->view->tweets as $key => $tweets){?>
				<div class="row tweet">
					
					<div class="col">
						<p><strong><?=$tweets['NOME']?> | <?=$tweets['EMAIL']?> </strong> <small><span class="text text-muted"><?=$tweets['DATA']?></span> </small></p>
						<p><?=$tweets['TWEET']?></p>
						<?php if($tweets['ID_USUARIO'] == $_SESSION['id']) {?>
							<form action="/removerTweet" method="POST">
							<input type="hidden" name="id_tweet" value="<?=$tweets['ID']?>">
							<input type="hidden" name="id_usuario" value="<?=$tweets['ID_USUARIO']?>">
								<div class="col d-flex justify-content-end">
									<button type="submit" class="btn btn-danger"><small>Remover</small></button>					
								</div>
							</form>	
						<?php } ?>	
					</div>
				</div>
			<?php } ?>
		</div>


		<div class="col-md-3">
			<div class="quemSeguir">
				<span class="quemSeguirTitulo">Quem seguir</span><br />
				<hr />
				<a href="/quemSeguir" class="quemSeguirTxt">Procurar por pessoas conhecidas</a>
			</div>
		</div>

	</div>
</div>




