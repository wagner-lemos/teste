<?php
namespace app\controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
 
class Usuarios extends Controller
{
	private $model;
	const niveis = [UserModel::admin => 'Administrador', UserModel::autor => 'Autor', UserModel::editor => 'Editor'];

	public function __construct()
	{
		//carrega a helper;
		helper("utilidades");

		$this->model = new UserModel();
	}

    public function index()
    {
		if($this->request->getPost('bath_act') == "DEL_ALL")
		{
			$this->model->deleteAll($post = $this->request->getPost());	
		}

		$dados = $this->model->where(['nivel !=' => UserModel::super])->orderBy('nome', 'ASC')->findAll();
		$title = 'Usuários';
		
		echo view('layout/header');
		echo view('usuarios/index', ['titulo' => $title, 'model' => $dados]);
		echo view('layout/footer');

		session()->remove('msg');
    }
	
	public function cadastro()
    {
		$title = 'Usuários - cadastro';
		$nivel = array(['id' => UserModel::admin, 'titulo' => 'Administrador'], ['id' => UserModel::autor, 'titulo' => 'Autor'], ['id' => UserModel::editor, 'titulo' => 'Editor']);

		$erro = null;
		if($this->request->getPost()){

			if($this->validate($this->model->rules())){
				$data = [
					'nome'     => $this->request->getPost('nome'),
					'email'    => $this->request->getPost('email'),
					'login'    => $this->request->getPost('login'),
					'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
					'nivel'    => $this->request->getPost('nivel'),
				];

				$this->model->insert($data);

				return redirect()->to('/usuarios')->with('msg', 'Usuário adicionado com sucesso!');
			}
	
			$erro = $this->validator;

		}

		echo view('layout/header');
		echo view('usuarios/cadastro', ['titulo' => $title, 'nivel' => $nivel, 'error' => $erro]);
		echo view('layout/footer');
    }
	
	public function editar($id)
	{
		$title = 'Usuários - editar';
		$nivel = array(['id' => UserModel::admin, 'titulo' => 'Administrador'], ['id' => UserModel::autor, 'titulo' => 'Autor'], ['id' => UserModel::editor, 'titulo' => 'Editor']);

		$model = $this->model->where(['nivel !=' => UserModel::super])->find($id);

		$erro = null;		
		if($this->request->getPost())
		{
			$salva = $this->model->where(['nivel !=' => UserModel::super]);
			
			$password = $this->request->getPost('password');

			$rules = $password == '' ? $salva->rules(['password']) : $salva->rules();
			if($this->validate($rules)){

				$dados = [
					'nome'     => $this->request->getPost('nome'),
					'email'    => $this->request->getPost('email'),
					'login'    => $this->request->getPost('login'),
					'password' => password_hash($password, PASSWORD_DEFAULT),
					'nivel'    => $this->request->getPost('nivel'),
				];

				if($password == ''){ unset($dados['password']); }

				if(!$salva->update($id, $dados)){
					return redirect()->to('/usuarios')->with('msg', 'O registro não pode ser atualizado!');
				}

				return redirect()->to('/usuarios')->with('msg', 'Usuário editado com sucesso!');
			}
	
			$erro = $this->validator;
		}

		echo view('layout/header');
		echo view('usuarios/cadastro', ['titulo' => $title, 'nivel' => $nivel, 'user' => $model, 'error' => $erro]);
		echo view('layout/footer');
	}

	public function excluir($id)
	{
		$msg = $this->model->where(['nivel !=' => UserModel::super])->delete($id) ? 'Excluído com sucesso' : 'Não pode ser excluído';

		return redirect()->to('/usuarios')->with('msg', $msg);
	}

	public function status($id, $status)
    {
		$newStatus = $status == "on" ? "off" : "on";

		$data = ['status' => $newStatus];
		$this->model->update($id, $data);

		return status($id, $newStatus, 'usuarios/status');
    }
	
	public function perfil()
	{
		$id = session()->user_id;
		$title = 'Dados do Perfil';

		$model = $this->model->find($id);

		$erro = null;		
		if($this->request->getPost())
		{
			$salva = $this->model;
			
			$password = $this->request->getPost('password');

			$rules = $password == '' ? $salva->rules(['password']) : $salva->rules();
			if($this->validate($rules)){

				$dados = [
					'nome'     => $this->request->getPost('nome'),
					'email'    => $this->request->getPost('email'),
					'login'    => $this->request->getPost('login'),
					'password' => password_hash($password, PASSWORD_DEFAULT),
				];

				if($password == ''){ unset($dados['password']); }

				if(!$salva->update($id, $dados)){
					return redirect()->to('usuarios/perfil')->with('msg', 'O registro não pode ser atualizado!');
				}

				return redirect()->to('usuarios/perfil')->with('msg', 'Usuário editado com sucesso!');
			}
	
			$erro = $this->validator;
		}

		echo view('layout/header');
		echo view('usuarios/perfil', ['titulo' => $title, 'user' => $model, 'error' => $erro]);
		echo view('layout/footer');
	}
}
?>
