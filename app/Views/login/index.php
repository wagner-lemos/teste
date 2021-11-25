<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Wagner Lemos">
	<meta name="reply-to" content="wagnerlemosce@gmail.com">
	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noarchive">
	<?= csrf_meta() ?>
	<title>Gerenciador de Conteúdo</title>
	
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/favicon.png');?>" />
	<link href="<?php echo base_url('css/login.css')?>" rel="stylesheet" type="text/css" />

	<script type="text/javascript">function focu(){document.form.login.focus(); return false;}</script>
</head>

<body onload="focu();">
	<div id="content">
		<div id="formulario">
			<form name="form" action="login" method="post" autocomplete="off">
				<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
				Nome de usuário<br/><input name="login" type="text" class="campos" value="" /><br/>
				Senha<br/><input name="password" type="password" class="campos" /><br/>
				<input name="bt" type="submit" class="bt" value="Entrar" />
			</form>

			<?php if(session()->getFlashdata('msg')){ ?>
                <p id="error"><?= session()->getFlashdata('msg') ?></p>
			<?php } ?>
		</div>
	</div>
</body>
</html>