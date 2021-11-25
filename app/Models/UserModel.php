<?php
	namespace app\models;

	use CodeIgniter\Model;
	
	class UserModel extends Model
	{
		protected $DBGroup = 'default';
		protected $table = 'users';
		protected $primaryKeY = 'id';
		protected $useAutoIncrement = true;
		protected $returnType = "array";

		protected $allowedFields = ['nome','email', 'login', 'password', 'nivel', 'status'];

		protected $useSoftDeletes = true;
		protected $useTimestamps = true;
		protected $createdField  = 'created_at';
		protected $updatedField  = 'updated_at';
		protected $deletedField  = 'deleted_at';

		const super = 0;
		const admin = 1;
		const autor = 2;
		const editor = 3;

		public function rules($fields = null)
		{
			$campos =
			[
				'nome' =>
				[
					'rules' => 'required|min_length[3]|max_length[50]',
					'errors' =>
					[
						'min_length'=>'Campo Nome não pode conter menos que 3 caracteres',
					]
				],
				'email' =>
				[
					'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email,id,{id}]',
					'errors' =>
					[
						'is_unique' => 'Email já existente, digite outro.',
					]
				],
				'login' =>
				[
					'rules' => 'required|min_length[3]|max_length[15]|is_unique[users.login,id,{id}]',
					'errors' =>
					[
						'is_unique' => 'Login já existente, digite outro.',
						'min_length' => 'Campo Login não pode conter menos que 5 caracteres',
					]
				],
				'password' =>
				[
					'rules' => 'required|min_length[3]|max_length[15]',
					'errors' =>
					[
						'required' => 'Campo Password não pode ser vazio.',
						'min_length' => 'Campo Password não pode conter menos que 5 caracteres.',
						
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

		public function deleteAll($post)
		{
			foreach ($post as $key => $val)
			{
				$ID_del	= str_replace("ch", '', $key);
				is_numeric($ID_del) ? $this->delete($val) : 0;
			}
		}
	}
?>