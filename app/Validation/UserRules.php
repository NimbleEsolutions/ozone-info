<?php 
	namespace App\Validation;
	use App\Models\HomeModel;

	class UserRules
	{
		public function validateUser(string $str, string $fields, array $data)
		{
			$home = new HomeModel();
			$user = $home->where(array('user_email'=>$data['user_email'],'user_isDelete'=>0))
							->first();
			// print_r($user);die();
			if(!$user){
				return true;
			}elseif(password_verify($data['user_password'], $user['user_password'])){
				return false;
			}else{
				return true;
			}
		}
	}
?>