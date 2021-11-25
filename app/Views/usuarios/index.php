<h2 class="breadcrumbs"><i class="fas fa-users"></i> <?php echo $titulo;?></h2>

<?php
	if(session()->getFlashdata('msg'))
	{
		echo '<div class="notification"><i class="far fa-times-circle close" title="Fechar"></i>'.session()->getFlashdata('msg').'</div>';
	}
?>

<div class="bloco">
	<div class="bt_add"><a href="<?php echo site_url('usuarios/cadastro');?>">Cadastrar Administrador</a></div>
	<div class="grade">
		<form id="f1" name="f1" method="post">
			<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
			<table width="100%" cellpadding="0" cellspacing="2">
				<tr class="linhaTitulo">
					<td align="center"><input type="checkbox" id="mestre" name="mestre" onclick="javascript:checkboxAll();"></td>
					<td width="40%">Nome</td>
					<td width="30%">E-mail</td>
					<td width="15%">Login</td>
					<td width="15%">Nível</td>
					<td>Opções</td>
				</tr>
			<?php
				$x = 0;
				foreach($model as $rows){

				$x++;
				$id = $rows['id'];
				$nome = $rows['nome'];
				$email = $rows['email'];
				$login = $rows['login'];
				$nivel = $rows['nivel'];
				$status = $rows['status'];

				if($x % 2 == 1) {$cor="#F6F6F6";}else{$cor="#EAEAEA";}
			?>
				<tr id="<?php echo $x;?>" bgcolor="<?php echo $cor;?>">
					<td align="center">
						<input type="checkbox" name="ch<?php echo $x;?>" id="ch<?php echo $x;?>" value="<?php echo $id;?>" onclick="mudaCor('<?php echo $x;?>', ch<?php echo $x;?>.checked);" />
					</td>
					<td><?php echo $nome;?></td>
					<td><?php echo $email;?></td>
					<td><?php echo $login;?></td>
					<td><?php echo \app\Controllers\Usuarios::niveis[$nivel]; ?></td>

					<td align="center">
						<?php echo status($id, $status, 'usuarios/status'); ?>

						<a href="<?php echo site_url('usuarios/editar/'.$id);?>" class="editar" title="Editar"><i class="fas fa-edit"></i></a>
						<a href="<?php echo site_url('usuarios/excluir/'.$id);?>" class="excluir" title="Excluir" onclick="return confirm('Deseja realmete Excluir este registro?')"><i class="far fa-trash-alt"></i></a>
					</td>
				</tr>
			<?php } ?>
			</table>

			<?php if($x == 0){echo '<div class="sem-dados">Não há usuários cadastrados</div>';}else{ ?>
				<button type="submit" name="bath_act" value="DEL_ALL" title="Excluir selecionados" class="bt_all" onclick="return confirm('Deseja realmete Excluir estes registros?')"><i class="fas fa-times"></i></button>
			<?php }?>
		</form>
	</div>
</div>