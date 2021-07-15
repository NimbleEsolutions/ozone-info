<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\BidModel;
use \App\Models\BidProductModel;
use \App\Models\HomeModel;
use \App\Models\ClientModel;
use \App\Models\DepartmentModel;
use \App\Models\EligibilityModel;
use \App\Models\TermsModel;
use \App\Models\BideligibilityModel;
use \App\Models\BidTermsModel;
use \App\Models\BidTypeModel;

class Bid extends Controller
{
	function bid_details()
	{
		helper('text');
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
			"clients"=>(new ClientModel())->where('client_isDelete', 0)->findAll(),
			"departments"=>(new DepartmentModel())->where('dept_isDelete', 0)->findAll(),
			"bids"=>(new BidModel())->where('bid_isDelete', 0)->findAll(),
			"all_products"=>(new HomeModel())->getData('product_isDelete=0','sales_product'),
		];
		return view('bid/bid_details', $data);
	}

	function create_bid()
	{
		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"client_details"=>(new HomeModel())->getData('client_isDelete=0','sales_client'),
			"all_products"=>(new HomeModel())->getData('product_isDelete=0','sales_product'),
			"all_region"=>(new HomeModel())->getData('reg_isDelete=0','sales_region'),
			"departments"=>(new DepartmentModel())->where('dept_isDelete', 0)->findAll(),
			"eligibility"=>(new EligibilityModel())->where('el_isDelete', 0)->findAll(),
			"terms"=>(new TermsModel())->where('term_isDelete', 0)->findAll(),
			"bid_type"=>(new BidTypeModel())->where('btype_isDelete', 0)->findAll(),
		];

		if($this->request->getMethod() == 'post'){
			$bid = [
				'bid_type'=>$this->request->getVar('bid_type'),
				'bid_lead_ref'=>$this->request->getVar('bid_lead_ref'),
				'bid_endDate'=>"".date('Y',strtotime($this->request->getVar('bid_endDate')))."-".date('d',strtotime($this->request->getVar('bid_endDate')))."-".date('m',strtotime($this->request->getVar('bid_endDate')))." ".date('H',strtotime($this->request->getVar('bid_endDate'))).":".date('i',strtotime($this->request->getVar('bid_endDate'))).":".date('s',strtotime($this->request->getVar('bid_endDate')))."",
				'bid_openDate'=>"".date('Y',strtotime($this->request->getVar('bid_openDate')))."-".date('d',strtotime($this->request->getVar('bid_openDate')))."-".date('m',strtotime($this->request->getVar('bid_openDate')))." ".date('H',strtotime($this->request->getVar('bid_openDate'))).":".date('i',strtotime($this->request->getVar('bid_openDate'))).":".date('s',strtotime($this->request->getVar('bid_openDate')))."",
				'bid_validity'=>$this->request->getVar('bid_validity'),
				'bid_region'=>$this->request->getVar('bid_region'),
				'bid_client'=>$this->request->getVar('bid_client'),
				'bid_dept'=>$this->request->getVar('bid_dept'),
				'bid_emd'=>$this->request->getVar('bid_emd'),
				'bid_emd_val'=>$this->request->getVar('bid_emd_val'),
				'bid_epbg'=>$this->request->getVar('bid_epbg'),
				'bid_epbg_val'=>$this->request->getVar('bid_epbg_val'),
				'bid_status'=>0,
				'bid_createdBy'=>session()->get('id'),
				'bid_createdOn'=>date('Y-m-d H:i:s'),
			];
			(new BidModel())->insert($bid);
			$bid_id = (new BidModel)->insertID();
			for ($i=0; $i < count($this->request->getVar('bidprod_product_id')); $i++) { 
				$product = [
					'bidprod_bid_id'=>$bid_id,
					'bidprod_product_id'=>$this->request->getVar('bidprod_product_id'.'['.$i.']'),
					'bidprod_qty'=>$this->request->getVar('bidprod_qty'.'['.$i.']'),
					'bidprod_spcification'=>$this->request->getVar('bidprod_spcification'.'['.$i.']'),
					'bidprod_mm'=>$this->request->getVar('bidprod_mm'.'['.$i.']'),
					'bidprod_budget'=>$this->request->getVar('bidprod_budget'.'['.$i.']'),
					'bidprod_gem'=>$this->request->getVar('bidprod_gem'.'['.$i.']'),
					'bidprod_tprice'=>$this->request->getVar('bidprod_tprice'.'['.$i.']'),
					'bidprod_qprice'=>$this->request->getVar('bidprod_qprice'.'['.$i.']'),
					'bidprod_status'=>0,
					'bidprod_createdOn'=>date('Y-m-d H:i:s'),
				];
				(new BidProductModel())->insert($product);
			}

			if(!empty($this->request->getVar('be_eligibility_id'))){
				for ($j=0; $j < count($data['eligibility']); $j++) {
					if(in_array(($j+1), $this->request->getVar('be_eligibility_id')) == 1){ 
						$eligibility = [
							'be_bid_id'=>$bid_id,
							'be_eligibility_id'=>$data['eligibility'][$j]['el_id'],
							'be_value'=>$this->request->getVar('be_value'.'['.$j.']'),
							'be_doc_required'=>$this->request->getVar('be_doc_required'.'['.$j.']'),
							'be_doc_name'=>$this->request->getVar('be_doc_name'.'['.$j.']'),
							'be_createdOn'=>Date('Y-m-d_H-i:s'),
							'be_createdBy'=>session()->get('id')
						];
						(new BideligibilityModel())->insert($eligibility);
					}
				}
			}
			if(!empty($this->request->getVar('bt_term_id'))){
				for ($k=0; $k < count($data['terms']); $k++) { 
					if(in_array(($k+1), $this->request->getVar('bt_term_id')) == 1){ 
						$terms = [
							'bt_bid_id'=>$bid_id,
							'bt_term_id'=>$data['terms'][$k]['term_id'],
							'bt_value'=>$this->request->getVar('bt_value'.'['.$k.']'),
							'bt_doc_required'=>$this->request->getVar('bt_doc_required'.'['.$k.']'),
							'bt_doc_remark'=>$this->request->getVar('bt_doc_remark'.'['.$k.']'),
							'bt_createdOn'=>Date('Y-m-d_H-i:s'),
							'bt_createdBy'=>session()->get('id')
						];
						(new BidTermsModel())->insert($terms);
					}
				}
			}
			session()->setFlashdata('success','Bid successfully created..!');
			return redirect()->route('bid/bid_details');
		}
		return view('bid/create_bid', $data);
	}

	function update_bid_details()
	{
		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"client_details"=>(new HomeModel())->getData('client_isDelete=0','sales_client'),
			"all_products"=>(new HomeModel())->getData('product_isDelete=0','sales_product'),
			"all_region"=>(new HomeModel())->getData('reg_isDelete=0','sales_region'),
			"departments"=>(new DepartmentModel())->where('dept_isDelete', 0)->findAll(),
			"eligibility"=>(new EligibilityModel())->where('el_isDelete', 0)->findAll(),
			"terms"=>(new TermsModel())->where('term_isDelete', 0)->findAll(),
			"bid"=>(new BidModel())->find(service('uri')->getSegment(2)),
			"bid_product"=>(new BidProductModel())->where('bidprod_bid_id',service('uri')->getSegment(2))->findAll(),
			"bid_eligibility"=>(new BideligibilityModel())->where('be_bid_id',service('uri')->getSegment(2))->findAll(),
			"bid_terms"=>(new BidTermsModel())->where('bt_bid_id',service('uri')->getSegment(2))->findAll(),
			"bid_type"=>(new BidTypeModel())->where('btype_isDelete', 0)->findAll(),
		];

		if($this->request->getMethod() == 'post'){
			$bid = [
				'bid_type'=>$this->request->getVar('bid_type'),
				'bid_lead_ref'=>$this->request->getVar('bid_lead_ref'),
				'bid_endDate'=>"".date('Y',strtotime($this->request->getVar('bid_endDate')))."-".date('d',strtotime($this->request->getVar('bid_endDate')))."-".date('m',strtotime($this->request->getVar('bid_endDate')))." ".date('H',strtotime($this->request->getVar('bid_endDate'))).":".date('i',strtotime($this->request->getVar('bid_endDate'))).":".date('s',strtotime($this->request->getVar('bid_endDate')))."",
				'bid_openDate'=>"".date('Y',strtotime($this->request->getVar('bid_openDate')))."-".date('d',strtotime($this->request->getVar('bid_openDate')))."-".date('m',strtotime($this->request->getVar('bid_openDate')))." ".date('H',strtotime($this->request->getVar('bid_openDate'))).":".date('i',strtotime($this->request->getVar('bid_openDate'))).":".date('s',strtotime($this->request->getVar('bid_openDate')))."",
				'bid_validity'=>$this->request->getVar('bid_validity'),
				'bid_region'=>$this->request->getVar('bid_region'),
				'bid_client'=>$this->request->getVar('bid_client'),
				'bid_dept'=>$this->request->getVar('bid_dept'),
				'bid_emd'=>$this->request->getVar('bid_emd'),
				'bid_emd_val'=>$this->request->getVar('bid_emd_val'),
				'bid_epbg'=>$this->request->getVar('bid_epbg'),
				'bid_epbg_val'=>$this->request->getVar('bid_epbg_val'),				
			];
			(new BidModel())->update(service('uri')->getSegment(2),$bid);
			// $bid_id = (new BidModel)->insertID();
			if(!empty($this->request->getVar('bidprod_product_id'))){
				(new BidProductModel())->where('bidprod_bid_id',service('uri')->getSegment(2))->delete();
			}
			for ($i=0; $i < count($this->request->getVar('bidprod_product_id')); $i++) { 
				$product = [
					'bidprod_bid_id'=>service('uri')->getSegment(2),
					'bidprod_product_id'=>$this->request->getVar('bidprod_product_id'.'['.$i.']'),
					'bidprod_qty'=>$this->request->getVar('bidprod_qty'.'['.$i.']'),
					'bidprod_spcification'=>$this->request->getVar('bidprod_spcification'.'['.$i.']'),
					'bidprod_mm'=>$this->request->getVar('bidprod_mm'.'['.$i.']'),
					'bidprod_budget'=>$this->request->getVar('bidprod_budget'.'['.$i.']'),
					'bidprod_gem'=>$this->request->getVar('bidprod_gem'.'['.$i.']'),
					'bidprod_tprice'=>$this->request->getVar('bidprod_tprice'.'['.$i.']'),
					'bidprod_qprice'=>$this->request->getVar('bidprod_qprice'.'['.$i.']'),
					'bidprod_status'=>0,
					'bidprod_createdOn'=>date('Y-m-d H:i:s'),
				];

				(new BidProductModel())->insert($product);
			}

			if(!empty($this->request->getVar('be_eligibility_id'))){
				(new BideligibilityModel())->where('be_bid_id',service('uri')->getSegment(2))->delete();
				for ($j=0; $j < count($data['eligibility']); $j++) {
					if(in_array(($j+1), $this->request->getVar('be_eligibility_id')) == 1){ 
						$eligibility = [
							'be_bid_id'=>service('uri')->getSegment(2),
							'be_eligibility_id'=>$data['eligibility'][$j]['el_id'],
							'be_value'=>$this->request->getVar('be_value'.'['.$j.']'),
							'be_doc_required'=>$this->request->getVar('be_doc_required'.'['.$j.']'),
							'be_doc_name'=>$this->request->getVar('be_doc_name'.'['.$j.']'),
							'be_doc_url'=>'',
							'be_createdOn'=>Date('Y-m-d_H-i:s'),
							'be_createdBy'=>session()->get('id')
						];
						(new BideligibilityModel())->insert($eligibility);
					}
				}
			}
			if(!empty($this->request->getVar('bt_term_id'))){
				(new BidTermsModel())->where('bt_bid_id',service('uri')->getSegment(2))->delete();
				for ($k=0; $k < count($data['terms']); $k++) { 
					if(in_array(($k+1), $this->request->getVar('bt_term_id')) == 1){ 
						$terms = [
							'bt_bid_id'=>service('uri')->getSegment(2),
							'bt_term_id'=>$data['terms'][$k]['term_id'],
							'bt_value'=>$this->request->getVar('bt_value'.'['.$k.']'),
							'bt_doc_required'=>$this->request->getVar('bt_doc_required'.'['.$k.']'),
							'bt_doc_remark'=>$this->request->getVar('bt_doc_remark'.'['.$k.']'),
							'bt_createdOn'=>Date('Y-m-d_H-i:s'),
							'bt_createdBy'=>session()->get('id')
						];
						(new BidTermsModel())->insert($terms);
					}
				}
			}
			session()->setFlashdata('success','Bid successfully updated..!');
			return redirect()->route('bid/bid_details');
		}

		return view('bid/update_bid', $data);
	}

	function update_details()
	{
		count($this->request->getVar('be_eligibility_id'));die();
	}
}