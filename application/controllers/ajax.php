<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->session->userdata('logged_in');
	}

	public function cartAjax(){
		$id = $this->input->post('id');
		if(!empty($id)){
			$this->load->model('cartModel');
			$this->cartModel->deleteProduct($id);
		}
	}

	public function insertProduct(){
		$this->load->model('cartModel');

		$session_data = $this->session->userdata('logged_in');
		$this->load->model('adminModel');
		$id_user = $session_data['id'];
		$this->load->model('productItemModel');
		$product = $this->productItemModel->getProduct($this->input->post('id'));

		$product[0]['user_id'] = $session_data['id'];
		$admin_user = $this->adminModel->getAdmin($id_user);
		$cart['user_id'] = $id_user;
		$cart['product_id'] = $product[0]['id'];
		$this->load->model('cartModel');
		$this->cartModel->cartInsert($cart);
	}

	public function editProduct(){
		$this->load->model('addProductModel');
		$id = $this->input->post('id');

		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['price'] = $this->input->post('price');
		$this->addProductModel->updateRecord($data, $id);
		$this->load->view('header');
		$this->load->view('footer');
	}

	public function selectSliderImage(){
		$this->load->model('sliderModel');
		$id = $this->input->post('id');

		$this->sliderModel->updateSlider($id);
	}

	public function rate(){
		$this->load->model('cartModel');
		$id = $this->input->post('id');
		$data['user_id'] = $this->session->userdata('logged_in')['id'];
		$data['product_id'] = $this->input->post('id');
		$data['value'] = $this->input->post('val');
		$this->cartModel->insertRate($data);


		$rate = $this->cartModel->getRate($id);
		$star = $rate[0]['sum']/$rate[0]['count'];

		$prod_rate['rate'] = $star;
		$this->load->model('addProductModel');
		$this->addProductModel->updateRecord($prod_rate, $id);
		// echo $star;
	}
}

