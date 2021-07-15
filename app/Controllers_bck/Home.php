<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\BidModel;
use \App\Models\LeadModel;

class Home extends Controller
{
	function index()
	{
		return redirect()->route('login');
	}

	public function login_details()
	{
		$data = [];
		helper(['form']);

		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
		];
		
		if($this->request->getMethod() == 'post'){
			// let's do the validation rule
			$rules = [
				'user_email' => 'required|valid_email',
				'user_password' => 'required|validateUser[user_email,user_password]',
			];

			$errors = [
				'user_password' => [
					'validateUser' => "Email or Password don't match"
				],
			];
			// session()->setFlashdata('error',`Email or Password don't match`);

			if($this->validate($rules, $errors)){
				$data['validation'] = $this->validator;
			}else{
				$home = new HomeModel();
				$user = $home->where(array('user_email'=>$this->request->getVar('user_email')))
							->first();
				$this->setUserSession($user);
				session()->setFlashdata('success','Welcome to Ozone Info.');
				if (session()->get('role_id') == 1) {
					return redirect()->to('dashboard');
				}else if(session()->get('role_id') == 2) {
					return redirect()->to('dashboard');
				}else if(session()->get('role_id') == 3) {
					return redirect()->to('dashboard');
				}else if(session()->get('role_id') == 4) {
					return redirect()->to('dashboard');
				}else if(session()->get('role_id') == 5) {
					return redirect()->to('dashboard');
				}
			}	
		}
		return view('home/signIn', $data);
	}

	private function setUserSession($user)
	{
		$data = [
			'id'=>$user['user_id'],
			'role_id'=>$user['user_role_id'],
			'language'=>'eng',
			'isLoggedIn'=>true,
		];
		session()->set($data);
		$agent = $this->request->getUserAgent();
		$user_session = [
			'user_id' => $user['user_id'],
			'islogedinn' => 1,
			'ip_address' => $this->request->getIPAddress(),
			'login_time' => date('Y-m-d H:i:s'),
			'os' => $agent->getPlatform(),
			'hash' => password_hash("".date('Y-m-d-H:i:s')."_".$user['user_id']."_".$this->request->getIPAddress()."_".$agent->getPlatform()."", PASSWORD_DEFAULT),
		];
		(new HomeModel())->insertData($user_session,'jinlms_user_session');
		return true;
	}

	function dashboard()
	{	
		$home = new HomeModel();
		$data = [
			"success"=>session()->getFlashdata('success'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
			"bid" => (new BidModel())->where(array('bid_isDelete'=> 0))->findAll(),			
			"lead" => (new LeadModel())->where(array('lead_isDelete'=> 0))->findAll(),			
		];
		// print_r($data['success']);die();
		return view('home/dashboard', $data);
	}

	public function logout()
	{
		session()->destroy();
		session()->setFlashdata('info','Thank You..!');
		return redirect()->route('login');
	}

}
