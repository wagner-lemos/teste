<?php
	namespace app\models;

	use CodeIgniter\Model;
	
	class ClientesModel extends Model
	{
		protected $DBGroup = 'default';
		protected $table = 'clientes';
		protected $primaryKeY = 'id';
		protected $useAutoIncrement = true;
		protected $returnType = "array";

		protected $allowedFields = ['codigo','nome', 'data', 'slug', 'status'];

		protected $useSoftDeletes = true;
		protected $useTimestamps = true;
		protected $createdField  = 'created_at';
		protected $updatedField  = 'updated_at';
		protected $deletedField  = 'deleted_at';

		public function rules($fields = null)
		{
			$campos =
			[
				'nome' =>
				[
					'rules' => 'required|min_length[3]',
					'errors' =>
					[
						'min_length'=>'Campo Nome não pode conter menos que 5 caracteres',
					]
				],
				'data' =>
				[
					'rules' => 'required|valid_date[d/m/Y]',
					'errors' =>
					[
						'valid_date' => 'A Data não é válida, digite uma data válida.',
						'required'=>'Campo Data não pode ser vazio.',
					]
				],
			];
			
			if($fields != null){
				foreach($fields as $c)
				{
					unset($campos[$c]);
				}
			}

			return $campos;
		}

		public function search($post)
		{
			$dados = $this->select('*, date_format(data, "%d/%m/%Y") as datas');

			if(($post) && $post['palavra'] && $post['coluna'] == 'todos')
			{
				$dados->groupStart()
					->like('nome', $post['palavra'], 'after')
				->groupEnd();

			}elseif(($post) && $post['palavra'] && $post['coluna'] != 'todos')
			{
				$dados->like($post['coluna'], $post['palavra'], 'both');
			}

			return $dados->orderBy('data DESC, id DESC')->paginate(50);
		}
		
		public function deleteAll($post)
		{
			foreach ($post as $key => $val)
			{
				$ID_del	= str_replace("ch", '', $key);
				if($this->delete($ID_del))
				{
					(new \App\Models\UploadsModel)->where(['codigo' => $val])->delete();
				}
			}
		}
	}
?>