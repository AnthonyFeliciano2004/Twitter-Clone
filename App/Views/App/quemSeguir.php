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
				<div class="col">
					<div class="card">
						<div class="card-body">
							<form action="/quemSeguir" method="GET">
								<div class="input-group mb-3">
									<input type="text" name="pesquisa" class="form-control" placeholder="Quem você está procurando?">
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit">Procurar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

            <?php foreach($this->view->usuarios as $key => $usuario){ ?>
			<div class="row mb-2">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<?= $usuario['NOME']?>
								</div>

							
								<div class="col-md-6 d-flex justify-content-end">
									<div>
                                        <?php if($usuario['SEGUINDO_SN'] == 0){?>
										    <a href="/quemSeguir?acao=seguir&id_usuario=<?= $usuario['ID']?>" class="btn btn-success">Seguir</a>
										<?php } ?>
                                        <?php if($usuario['SEGUINDO_SN'] > 0){?>
                                            <a href="/quemSeguir?acao=deixar_de_seguir&id_usuario=<?= $usuario['ID']?>" class="btn btn-danger">Deixar de seguir</a>
                                        <?php } ?>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <?php } ?>

		</div>
	</div>
</div>