<script type="text/javascript" src="<?php echo base_url('js/jquery.click-calendario-1.0-min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/exemplo-calendario.js');?>"></script>
<link href="<?php echo base_url('css/jquery.click-calendario-1.0.css');?>" rel="stylesheet" type="text/css"/>

<h2 class="breadcrumbs"><i class="fas fa-rss"></i> <?php echo $titulo;?></h2>

<?php
	if(isset($error)){
		echo $error->listErrors();
	}
?>

<div class="bloco">
	<form name="form" class="form-table" method="post">

		<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
		<input type="hidden" name="id" value="<?php echo isset($model['id']) ? $model['id'] : 0 ?>">
		<table width="100%" cellpadding="0" cellspacing="8">
			<tr>
				<td width="50%">Nome:<br /><input name="nome" type="text" class="campoA" value="<?php echo isset($model['nome']) ? $model['nome'] : '' ?>" required /></td>
				<td width="50%">Data:<br /><input name="data" type="text" id="data" title="Adicionar data" style="cursor: pointer;" class="campoA" value="<?php echo isset($model['datas']) ? $model['datas'] : date('d/m/Y'); ?>" readonly /></td>
			</tr>
			<tr>
				<td><input name="cadastrar" type="submit" value="CADASTRAR" class="bt_cadastro" /></td>
			</tr>
		</table>
	</form>
</div>