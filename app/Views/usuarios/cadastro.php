<h2 class="breadcrumbs"><i class="fas fa-users"></i> <?php echo $titulo;?></h2>

<?php
	if(isset($error)){
		echo $error->listErrors();
	}
?>

<div class="bloco">
	<form name="form" class="form" method="post">
		<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
		<input type="hidden" name="id" value="<?php echo isset($user['id']) ? $user['id'] : 0 ?>">
		<ul>
			<li>
				Nome:<br />
				<input name="nome" type="text" class="campoA" value="<?php echo isset($user['nome']) ? $user['nome'] : '' ?>" required />
			</li>
			<li>
				E-mail:<br />
				<input name="email" type="email" class="campoA" value="<?php echo isset($user['email']) ? $user['email'] : '' ?>" required />
			</li>
			<li>
				Nome de usuário: maximo de 15 caracteres<br />
				<input name="login" type="text" class="campoA" value="<?php echo isset($user['login']) ? $user['login'] : '' ?>" maxlength="15" required />
			</li>
			<li>
				Senha: maximo de 15 caracteres<br />
				<input name="password" type="password" placeholder="Deixe em branco se não quiser alterar a senha" class="campoA" value="" maxlength="15" />
			</li>
			<li>
				Nível de acesso:<br />
				<select name="nivel" class="campoA" required >
					<?php echo selectOption($nivel, $user['nivel']??null); ?>
				</select>
			</li>
		</ul>

		<button name="cadastrar" type="submit" class="bt bt_cadastro">CADASTRAR</button>
	</form>
</div>