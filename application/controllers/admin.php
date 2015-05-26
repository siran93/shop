<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')['username'] == ''){
			redirect('login');
		}
		$this->load->model('addProductModel');
		$this->load->model('adminModel');
		$this->load->model('productItemModel');
		$this->load->model('sliderModel');
	}

	public function index(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['product'] = $this->addProductModel->getRecords();
			$id = $session_data['id'];
			$admin_user['admin'] = $this->adminModel->getAdmin($id);

			if($session_data['username'] == 'admin'){
				$this->load->view('header');
				$this->load->view('adminViewHeader', $admin_user);
				$this->load->view('navbar');
				$this->load->view('adminView', $data);
				$this->load->view('footer', array('isAdmin' => 'true'));
			}else{
				redirect('frontend');
			}
 		}else{
		    	redirect('login', 'refresh');//If no session, redirect to login page
		}
	}
	public function logout(){
		$this->session->unset_userdata('logged_in');
		redirect('login');
	}
	public function addProduct(){
		$this->load->library('form_validation');

		if($this->input->post('save')){

			$this->form_validation->set_rules('title', 'title', 'required|trim|strip_tags');
			$this->form_validation->set_rules('description', 'description', 'required|trim|strip_tags');
			$this->form_validation->set_rules('price', 'price', 'required|trim|numeric|strip_tags');
			if(empty($_FILES['userfile']['name'])){
			    $this->form_validation->set_rules('userfile', 'Document', 'required');
			}

			if($this->form_validation->run()){

				$data['title'] = $this->input->post('title', true);
				$data['description'] = $this->input->post('description', true);
				$data['price'] = $this->input->post('price', true);
				$data['date'] = $this->input->post('date');

				$config['upload_path'] = './assets/photos/upload/';
	            $config['allowed_types'] = 'gif|jpg|png';
	            $config['max_size'] = '10000';
	            $config['encrypt_name'] = TRUE;
	            $config['remove_spaces'] = TRUE;

	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            $this->upload->do_upload();
	            
	            $image_data = $this->upload->data();

				unset($config);

				$config['source_image'] = './assets/photos/upload/'.$image_data['file_name'];
				$config['image_library'] = 'gd2';
				$config['maintain_ratio'] = true;
				$config['new_image'] = './assets/photos/thumbs/'.$image_data['file_name'];
				$config['width'] = 200;
				$config['height'] = 200;
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				
	            $img_thumb = $image_data['file_name'];		

	            $data['image'] = $image_data['file_name'];
	            
	            if(strtolower($image_data['file_ext'])  == '.jpg' || strtolower($image_data['file_ext'])  == '.png' || strtolower($image_data['file_ext'])  == '.jpeg' || strtolower($image_data['file_ext'])  == '.gif'){
					$data['product'] = $this->addProductModel->productInsert($data);
					redirect('admin');
				}else{
					echo 
						'<div class="alert alert-warnning">
						    <a href="#" class="close" data-dismiss="alert">&times;</a>
						    <strong> Warning!</strong> Please Select image with ".jpg", ".jpeg", ".png" or ".gif" extensions.
						</div>';
				}
			}
		}
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('addProduct');
		$this->load->view('footer');
	}
	public function delete($id){
		$this->addProductModel->deleteRecord($id);
		redirect('admin');
	}
	public function edit($id){
		$this->load->library('form_validation');
       
       	$product['product'] = $this->productItemModel->getProduct($id);
		$image = $product['product'][0]['image'];
		$product['display'] = 'none';
       	if($this->input->post('update')){
       		$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'title', 'trim');
			$this->form_validation->set_rules('description', 'description', 'trim');  
			$this->form_validation->set_rules('price', 'price', 'numeric|trim');

			if($this->form_validation->run()){
				$data['title'] = $this->input->post('title');
				$data['description'] = $this->input->post('description');
				$data['price'] = $this->input->post('price');
				$data['date'] = $this->input->post('date');

				$config['upload_path'] = './assets/photos/upload';
	            $config['allowed_types'] = 'gif|jpg|png';
	            $config['max_size'] = '10000';
	            $config['min-height'] = '350';
	            $config['encrypt_name'] = TRUE;
	            $config['remove_spaces'] = TRUE;

	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            $this->upload->do_upload();
	            
	            $image_data = $this->upload->data();
	            unset($config);

				$config['source_image'] = './assets/photos/upload/'.$image_data['file_name'];
				$config['image_library'] = 'gd2';
				$config['maintain_ratio'] = true;
				$config['new_image'] = './assets/photos/thumbs/'.$image_data['file_name'];
				$config['width'] = 200;
				$config['height'] = 200;

				if(!empty($image_data['file_name'])){

					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
				}
	            $img_thumb = $image_data['file_name'];		

	            $data['image'] = $image_data['file_name'];
	            if(empty($image_data['file_name'])){
					$data['image'] = $image;
					$product['display'] = 'block';
					$this->addProductModel->updateRecord($data, $id);
					$product['product'] = $this->productItemModel->getProduct($id);
				}else{
	            	$data['image'] = $image_data['file_name'];
	            	if(strtolower($image_data['file_ext'])  == '.jpg' || strtolower($image_data['file_ext'])  == '.png' || strtolower($image_data['file_ext'])  == '.jpeg' || strtolower($image_data['file_ext'])  == '.gif'){
					$product['display'] = 'block';
					$this->addProductModel->updateRecord($data, $id);
					$product['product'] = $this->productItemModel->getProduct($id);
					}else{
						echo 
							'<div class="alert alert-warnning">
							    <a href="#" class="close" data-dismiss="alert">&times;</a>
							    <strong> Warning!</strong> Please Select image with ".jpg", ".jpeg", ".png" or ".gif" extensions.
							</div>';
					}
				}
				
			}
		}
       	$this->load->view('header');
		$this->load->view('navbar');
        $this->load->view('editView', $product);
        $this->load->view('footer');
    }

    public function slider(){
		$this->load->library('form_validation');
		$slider['slider'] = $this->sliderModel->getSlider();
		$count = count($slider['slider']);

		if($this->input->post('slider')){
			if(!empty($_FILES['userfile']['name'])){
			   	$config['upload_path'] = './assets/photos/slider_photos/';
	            $config['allowed_types'] = 'gif|jpg|png';
	            $config['max_size'] = '10000';
	            $config['encrypt_name'] = TRUE;
	            $config['remove_spaces'] = TRUE;

	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            $this->upload->do_upload();
	            
	            $image_data = $this->upload->data();
	            
				if($image_data['image_height'] < '350'){
					echo 
						'<div class="alert alert-warnning">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong> Warning!</strong> Yntreq 350px height-ic bardzr nkar
						</div>';
				}else{
					if($image_data['image_height'] >= 350 || $image_data['image_width'] >= 1000){
	           			$height = ($image_data['image_height'] - 350)/2;
	           			$width = ($image_data['image_width'] - 1000)/2;
						$image_config['image_library'] = 'gd2';
						$image_config['source_image'] = $image_data["file_path"].$image_data["file_name"];
						$image_config['new_image'] = $image_data["file_path"].$image_data["file_name"];
						$image_config['quality'] = "100%";
						$image_config['maintain_ratio'] = FALSE;
						$image_config['width'] = 1000;
						$image_config['height'] = 350;
						$image_config['x_axis'] = $width;
						$image_config['y_axis'] = $height;

						$this->image_lib->clear();
						$this->image_lib->initialize($image_config); 

						if (!$this->image_lib->crop()){
						    redirect("errorhandler");
						}else{
							$data['image'] = $image_data['file_name'];
							$data['product'] = $this->sliderModel->insertSlider($data);
							redirect(base_url().'admin/slider');
						}
		           	}else{
	       				$data['image'] = $image_data['file_name'];
						$data['product'] = $this->sliderModel->insertSlider($data);
						redirect('admin/slider');
		           	}
				}
			}else{
				echo '<div class="alert alert-warnning">
					    <a href="#" class="close" data-dismiss="alert">&times;</a>
					    <strong> Warning!</strong> You have nothing selected.
					</div>';
			}
		}

   	 	$this->load->view('header');
		$this->load->view('navbar');
        $this->load->view('sliderView', $slider);
		$this->load->view('footer', array('isAdmin' => 'true'));

	}
    public function deleteSlider($id){
		$slider['image'] = $this->sliderModel->getImageSlider($id);
		$path = $slider["image"][0]['image'];
		$this->sliderModel->deleteSlider($id);
		unlink(FCPATH.'assets/photos/slider_photos/'.$path);
		redirect('admin/slider');
	}

	public function cartHistory(){
		$cart['history'] = $this->adminModel->getCartHistory();
		$this->load->view('header');
		$this->load->view('navbar');
        $this->load->view('historyView', $cart);
		$this->load->view('footer', array('isAdmin' => 'true'));
	}
}