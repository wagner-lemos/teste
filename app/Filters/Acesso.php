<?php namespace app\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class Acesso implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
		if(session()->get('user_nivel') != 0 and session()->get('user_nivel') != 1){
			return redirect()->to('/clientes');
        }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}