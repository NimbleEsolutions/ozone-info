<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\UserModel;
use \App\Models\ClientModel;
use \App\Models\StatesModel;
use \App\Models\CitiesModel;
use \App\Models\DepartmentModel;
use \App\Models\ProductModel;
use \App\Models\ContactPersonModel;

class Master extends Controller
{
	function client_details(){

		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"client_details"=>(new HomeModel())->getData(array('client_isDelete'=>0),'sales_client'),			
		];

		if($this->request->getMethod() == 'get' && !empty($this->request->getVar('client_id'))){
			(new ClientModel())->update($this->request->getVar('client_id'),array('client_isDelete'=>1));
			session()->setFlashdata('success','Client successfully deleted...!!');
			return redirect()->to('clients');
		}

		return view('masters/client_details', $data);
	}

	function register_client_details(){

		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"client_details"=>(new HomeModel())->getData(array('client_isDelete'=>0),'sales_client'),
			"state"=>(new StatesModel())->where('country_id',101)->findAll(),
			"departments"=>(new DepartmentModel())->where('dept_isDelete', 0)->findAll(),
		];

		if($this->request->getMethod() == 'post'){
			$client = [
				"client_name" => $this->request->getVar('client_name'),
				"client_contact" => $this->request->getVar('client_contact'),
				"client_email" => $this->request->getVar('client_email'),
				"client_other_contact" => $this->request->getVar('client_other_contact'),
				"client_other_email" => $this->request->getVar('client_other_email'),
				"client_website" => $this->request->getVar('client_website'),
				"client_state" => $this->request->getVar('client_state'),
				"client_city" => $this->request->getVar('client_city'),
				"client_address" => $this->request->getVar('client_address'),
				"client_pincode" => $this->request->getVar('client_pincode'),
			];
			(new ClientModel())->insert($client);
			$contact = [
				"cp_company" => (new ClientModel())->insertID(),
				"cp_first_name" => $this->request->getVar('cp_first_name'),
				"cp_middle_name" => $this->request->getVar('cp_middle_name'),
				"cp_last_name" => $this->request->getVar('cp_last_name'),
				"cp_mobile" => $this->request->getVar('cp_mobile'),
				"cp_other_contact" => $this->request->getVar('cp_other_contact'),
				"cp_email" => $this->request->getVar('cp_email'),
				"cp_department" => $this->request->getVar('cp_department'),
			];
			(new ContactPersonModel())->insert($contact);
			session()->setFlashdata('success','Client created successfully...!!');
			return redirect()->to('clients');
		}

		return view('masters/register_client_details', $data);
	}

	function update_client_details(){
		helper('text');
		$home = new HomeModel();
		// print_r($data["client_details"]);die();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"client_details" => (new ClientModel())->where(array('client_isDelete'=>0,'client_id'=>(service('uri'))->getSegment(2)))->findAll(),
			"state"=>(new StatesModel())->where('country_id',101)->findAll(),			
			"departments"=>(new DepartmentModel())->where('dept_isDelete', 0)->findAll(),
		];

		if($this->request->getMethod() == 'post'){
			$client = [
				"client_name" => $this->request->getVar('client_name'),
				"client_contact" => $this->request->getVar('client_contact'),
				"client_email" => $this->request->getVar('client_email'),
				"client_other_contact" => $this->request->getVar('client_other_contact'),
				"client_other_email" => $this->request->getVar('client_other_email'),
				"client_website" => $this->request->getVar('client_website'),
				"client_state" => $this->request->getVar('client_state'),
				"client_city" => $this->request->getVar('client_city'),
				"client_address" => $this->request->getVar('client_address'),
				"client_pincode" => $this->request->getVar('client_pincode'),
			];
			(new ClientModel())->update($this->request->getVar('client_id'), $client);
			session()->setFlashdata('success','Client updated successfully...!!');
			return redirect()->route('master/clients');
		}

		return view('masters/update_client_details', $data);
	}

	function department_details()
	{
		$data = [];
		helper(['form']);
		
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"departments" => (new DepartmentModel())->where('dept_isDelete', 0)->findAll()
		];

		if($this->request->getMethod() == 'get' && !empty($this->request->getVar('dept_id'))){
			(new DepartmentModel())->update($this->request->getVar('dept_id'),array('dept_isDelete'=>1));
			session()->setFlashdata('success','Department successfully deleted...!!');
			return redirect()->to('departments');
		}
		if($this->request->getMethod() == 'post'){
			$dept['dept_name'] = $this->request->getVar('dept_name');
			(new DepartmentModel())->insert($dept);
			session()->setFlashdata('success','Department created successfully...!!');
			return redirect()->to('departments');
		}
		
		return view('masters/department_details', $data);
	}

	function product_details()
	{
		$data = [];
		helper(['form']);

		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"products" => (new ProductModel())->where('product_isDelete', 0)->findAll()
		];

		if($this->request->getMethod() == 'post'){
			$product['product_name'] = $this->request->getVar('product_name');
			(new ProductModel())->insert($product);
			session()->setFlashdata('success','Product created successfully...!!');
			return redirect()->to('products');
		}
		
		return view('masters/product_details', $data);
	}

	function getClientInfo()
	{
		$chkVal = $_POST['chkVal'];	
		$clientInfo=(new HomeModel())->getData(array('client_id'=>$chkVal,'client_isDelete'=>0),'sales_client');
		echo json_encode($clientInfo);
	}

	function getDepartment()
	{
		$chkVal = $_POST['chkVal'];	
		$cpInfo = (new HomeModel())->getDepartment($chkVal);
		echo json_encode($cpInfo);
	}

	function getContactPersons()
	{
		$chkVal = $_POST['chkVal'];	
		$cpInfo=(new HomeModel())->getData(array('cp_company'=>$chkVal,'cp_isDelete'=>0,'cp_contact_for'=>1),'sales_contact_person');
		echo json_encode($cpInfo);
	}

	function getContactPersonsDept()
	{
		$dept = $_POST['dept'];	
		$client = $_POST['client'];	
		$cpInfo=(new HomeModel())->getData(array('cp_company'=>$client,'cp_isDelete'=>0,'cp_contact_for'=>1,'cp_department'=>$dept),'sales_contact_person');
		echo json_encode($cpInfo);
	}

	function getCity()
	{
		$chkVal = $_POST['chkVal'];	
		$cityInfo = (new HomeModel())->getData(array('st_id'=>$chkVal),'sales_cities');
		echo json_encode($cityInfo);
	}	
}

?>