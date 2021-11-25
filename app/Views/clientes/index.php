<h2 class="breadcrumbs"><i class="fas fa-rss"></i> <?php echo $titulo;?></h2>

<?php
	if(session()->getFlashdata('msg'))
	{
		echo '<div class="notification"><i class="far fa-times-circle close" title="Fechar"></i>'.session()->getFlashdata('msg').'</div>';
	}
?>

<div class="bloco">
	<div class="pesquisa">
		<form method="post">
			<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
			<input name="palavra" type="text" class="campo" placeholder="Digite a palavra chave para buscar" value="" />
			<select name="coluna" class="campo select">
				<option value="todos" selected>Buscar em</option>
				<option value="nome">Nome</option>
				<option value="todos">Todos</option>
			</select>
			<button type="submit" name="search" class="btSearch" value="SEARCH" title="Pesquisar"><i class="fas fa-search"></i></button>
		</form>
	</div>
	
	<div class="bt_add">
		<a href="<?php echo site_url('clientes/cadastro');?>">Cadastrar</a>
	</div>

	<div class="grade">
		<form id="f1" name="f1" method="post">
			<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
			<table width="100%" cellpadding="0" cellspacing="2">
				<tr class="linhaTitulo">
					<td align="center"><input type="checkbox" id="mestre" name="mestre" onclick="javascript:checkboxAll();"></td>
					<td width="80%">Nome</td>
					<td width="20%">Data</td>
					<td>Opções</td>
				</tr>
			<?php
				$x = 0;
				foreach($model as $rows)
				{
					$x++;
					$codigo = $rows['codigo'];
					$id = $rows['id'];
					$nome = $rows['nome'];
					$data = $rows['datas'];
					$status = $rows['status'];

					if($x % 2 == 1) {$cor="#F6F6F6";}else{$cor="#EAEAEA";}
			?>
				<tr id="<?php echo $x;?>" bgcolor="<?php echo $cor;?>">
					<td align="center">
						<input type="checkbox" name="ch<?php echo $id;?>" id="ch<?php echo $x;?>" value="<?php echo $codigo;?>" onclick="mudaCor('<?php echo $x;?>', ch<?php echo $x;?>.checked);" />
					</td>

					<td><?php echo $nome;?></td>
					<td><?php echo $data;?></td>

					<td align="center">
						<?php echo status($id, $status, 'clientes/status'); ?>

						<a href="<?php echo site_url('clientes/editar/'.$id);?>" class="editar" title="Editar"><i class="fas fa-edit"></i></a>
						<a href="<?php echo site_url('clientes/excluir/'.$id.'/'.$codigo);?>" class="excluir" title="Excluir" onclick="return confirm('Deseja realmete Excluir este registro?')"><i class="far fa-trash-alt"></i></a>
					</td>
				</tr>
			<?php } ?>
			</table>
			<?php if($x == 0){echo '<div class="sem-dados">Não há registros cadastrados</div>';}else{ ?>
				<button type="submit" name="bath_act" value="DEL_ALL" title="Excluir selecionados" class="bt_all" onclick="return confirm('Deseja realmete Excluir estes registros?')"><i class="fas fa-times"></i></button>
			<?php } ?>
			<?php echo $page->links(); ?>
		</form>
	</div>
</div>