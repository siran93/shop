<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {
	public $admin_user = array();
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('logged_in')['username'] == ''){
			redirect('login');
		}
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('adminModel');
		$this->load->model('cartModel');
		$this->load->model('addProductModel');
		$this->load->model('sliderModel');
		$this->load->model('productItemModel');
		$this->admin_user['admin'] = $this->adminModel->getAdmin($session_data['id']);
		$this->admin_user['count'] = $this->cartModel->getCount($session_data['id']);
	}

	public function index(){ 
		$this->load->library('pagination');

		$config['base_url'] = base_url().'frontend/index/';
		$config['total_rows'] = $this->db->count_all('products');
		$config['per_page'] = 5;

		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul><!--pagination-->';

		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next';//'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Previous';//'&larr; Previous'
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

		
		$data['product'] = $this->addProductModel->getRecordsFront($config['per_page'], $this->uri->segment(3));
		$slider['slider'] = $this->sliderModel->getSliderImage();
		
		$this->load->view('header');
		$this->load->view('frontendHeader', $this->admin_user);
		$this->load->view('slider', $slider);
		$this->load->view('frontendView', $data);
		$this->load->view('footer');
	}

	public function productItem($id){

		$product_item['product_item'] = $this->productItemModel->getProduct($id);
		$this->load->view('header');
		$this->load->view('frontendHeader', $this->admin_user);
		$this->load->view('productItem', $product_item);
		$this->load->view('footer');

	}

	public function news(){

		$this->load->view('header');
		$this->load->view('frontendHeader', $this->admin_user);
		$this->load->view('newsView');
		$this->load->view('footer');
	}

	public function about(){
		
		$this->load->library('googlemaps');
				
		$marker = array();
		$marker['position'] = 'Yerevan, Armenia, Armenia, Komitas 51/4';
		$marker['title'] = 'A marker title';
		$this->googlemaps->add_marker($marker);

		$this->load->model('mapModel', '', TRUE);
	
		$config['center'] = 'Yerevan, Armenia, Armenia, Komitas 51/4';
		$config['zoom'] = "16";
		$this->googlemaps->initialize($config);
		
		$coords = $this->mapModel->getCoordinates();
	
		// foreach ($coords as $coordinate) {// Loop through the coordinates we obtained above and add them to the map
		// 	$marker = array();
		// 	$marker['position'] = $coordinate->lat.','.$coordinate->lng;
		// 	$this->googlemaps->add_marker($marker);
		// }

		// Create the map
		$data = array();
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('header');
		$this->load->view('frontendHeader', $this->admin_user);
		$this->load->view('footer');
		$this->load->view('aboutView', $data);
	}
	public function cart(){
		$session_data = $this->session->userdata('logged_in');
		
		$id_user = $session_data['id'];
		$admin_user['admin'] = $this->adminModel->getAdmin($id_user);
		$admin_user['count'] = $this->cartModel->getCount($id_user);
		$product_list['product_list'] = $this->cartModel->getProduct($id_user);
		
		$this->load->view('header');
		$this->load->view('frontendHeader', $admin_user);
		$this->load->view('cartView', $product_list);
		$this->load->view('footer');
	}
}

