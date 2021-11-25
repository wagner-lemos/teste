<?php
namespace app\controllers;

use CodeIgniter\Controller;
use App\Models\ClientesModel;
 
class Clientes extends Controller
{
	private $model;

	public function __construct()
	{
		//carrega a helper;
		helper("utilidades");

		$this->model = new ClientesModel();
	}

    public function index()
    {
		$model = $this->model;
		$title = 'Clientes';

		if($this->request->getPost('bath_act') == "DEL_ALL")
		{
			$model->deleteAll($this->request->getPost());	
		}

		$pesquisa = [];
		if($this->request->getPost('search') == "SEARCH"){
			$pesquisa = [
				'palavra' => $this->request->getPost('palavra'),
				'coluna' => $this->request->getPost('coluna')
			];
		}

		$dados = $model->search($pesquisa);

		echo view('layout/header');
		echo view('clientes/index', ['titulo' => $title, 'model' => $dados, 'page' => $model->pager]);
		echo view('layout/footer');

		session()->remove('msg');
    }
	
	public function cadastro()
    {
		$title = 'Clientes - cadastrar';

		$erro = null;
		if($this->request->getPost()){

			$model = $this->model;

			if($this->validate($model->rules())){
				$dados = [
					'codigo' => rand(0, 9).date("dHis").rand(100, 999),
					'nome' => $this->request->getPost('nome'),
					'data' => incluirData($this->request->getPost('data')),
					'slug' => slug($this->request->getPost('nome')),
				];

				$model->insert($dados);

				return redirect()->to('/clientes')->with('msg', 'Registro adicionado com sucesso!');
			}
	
			$erro = $this->validator;
		}

		echo view('layout/header');
		echo view('clientes/form', ['titulo' => $title, 'error' => $erro]);
		echo view('layout/footer');
    }
	
	public function editar($id)
	{
		$title = 'Clientes - editar';

		$model = $this->model->select('*, date_format(data, "%d/%m/%Y") as datas')->find($id);

		$erro = null;		
		if($this->request->getPost())
		{
			$salva = $this->model;

			if($this->validate($salva->rules())){
				$dados = [
					'nome' => $this->request->getPost('nome'),
					'data' => incluirData($this->request->getPost('data')),
					'slug' => slug($this->request->getPost('nome')),
				];

				if(!$salva->update($id, $dados)){
					return redirect()->to('/clientes')->with('msg', 'O registro não pode ser atualizado!');
				}

				return redirect()->to('/clientes')->with('msg', 'Registro atualizado com sucesso!');
			}

			$erro = $this->validator;
		}

		echo view('layout/header');
		echo view('clientes/form', ['titulo' => $title, 'model' => $model, 'error' => $erro]);
		echo view('layout/footer');
	}
	
	public function status($id, $status)
    {
		$newStatus = $status == "on" ? "off" : "on";

		$data = ['status' => $newStatus];
		$this->model->update($id, $data);

		return status($id, $newStatus, 'clientes/status');
    }

	public function excluir($id, $codigo)
	{
		if($this->model->where(['id' => $id, 'codigo' => $codigo])->delete())
		{
			$msg = 'Excluído com sucesso';
		}else{
			$msg = 'Não pode ser excluído';
		}

		return redirect()->to('/clientes')->with('msg', $msg);
	}
}
?>
