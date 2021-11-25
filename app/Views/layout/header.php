<?php $control = new \CodeIgniter\HTTP\URI(uri_string(true)); ?>
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

	<title>Teste de conhecimento</title>

	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/favicon.png');?>" />
	<link href="<?php echo base_url('css/index.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('css/internas.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('fontawesome/css/all.css');?>" rel="stylesheet" />

	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.10.2.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/checkboxAll.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/ajax_m.js');?>"></script>
</head>

<body>
	<div id="sidebar">
		<div id="logo">
			<h1>Aplicação de teste</h1>

		<?php if(session()->user_nivel == 0 or session()->user_nivel == 1){ ?>
			<a href="<?php echo site_url('usuarios');?>">Admin</a>
		<?php }else{ ?>
			<a href="<?php echo site_url('usuarios/perfil');?>">Usuário</a>
		<?php } ?>
		<a href="<?php echo site_url('login/logout');?>">Sair</a>

		</div>

		<ul id="main-nav">
			<li>
				<a class="item <?php if($control->getSegment(1) == 'clientes'){echo 'current';}?>">Clientes</a>
				<ul class="lista">
					<li><a href="<?php echo site_url('clientes');?>">Todos</a></li>
					<li><a href="<?php echo site_url('clientes/cadastro');?>">Cadastrar</a></li>
				</ul>
			</li>
		</ul>

		<div class="copyright">Wagner Lemos<br/>Front-End e Back-End</div>
	</div>

	<div id="container">