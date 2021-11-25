<?php namespace app\controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
 
class Login extends Controller
{
    public function index()
    {
		if($this->request->getPost()){

			$model = new UserModel();
			
			$login = $this->request->getPost('login');
			$password = $this->request->getPost('password');
			$data = $model->where(['login'=>$login, 'status'=>'on'])->first();

			if($data){
				$pass = $data['password'];
				$verify_pass = password_verify($password, $pass);
				if($verify_pass){
					$ses_data = [
					'user_id'       => $data['id'],
					'user_name'     => $data['nome'],
					'user_nivel'    => $data['nivel'],
					'logged_in'     => TRUE
					];
					session()->set($ses_data);
					return redirect()->to('/clientes');
				}else{
					session()->setFlashdata('msg', 'Acesso não autorizado');
				}
			}else{
				session()->setFlashdata('msg', 'Acesso não autorizado');
			}
			$this->logout();
		}

		return view('login/index');
    }
 
    public function logout()
    {
		$session_items = ['user_id', 'user_name', 'user_nivel', 'logged_in'];

		session()->remove($session_items);
        session()->stop();
        session()->destroy();
        return redirect()->to('/login');
    }
}
?>