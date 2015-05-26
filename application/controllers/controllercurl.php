<?php 
	if(!defined('BASEPATH')) exit('No direct script access allowed');
		class Controllercurl extends CI_Controller{
			public function __construct(){
				parent::__construct();
				set_time_limit (1000);
			}
			public function index(){
			
				$this->load->library('curl');

				$curl = curl_init();
				$url = 'http://eli.am/shop/category/dutch_design/';

				curl_setopt($curl,CURLOPT_URL, $url);
				curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl,CURLOPT_CONNECTTIMEOUT, 5);
				$curlRes = curl_exec($curl);

				$doc = new DOMDocument();
				@$doc->loadHTML($curlRes);
				$finder = new DomXPath($doc);
		    	$links = $finder->query('//*[@id="main"]/ul/li');
		    	$data = array();
				foreach($links as $link){
					$item = array();
					if(empty($link->childNodes[1]->childNodes[1])){
						continue;
					}
						$source = $link->childNodes[1]->childNodes[1]->getAttribute('src');
						$name = explode("/", $source)[7];
						file_put_contents('assets/photos/eli_am/'.$name, fopen($source, 'r'));
						$item['image'] = $name;

					if (empty($link->childNodes[2]->nextSibling->firstChild->nextSibling)){
						continue;
					}
						$item['title'] = $link->childNodes[2]->nextSibling->firstChild->nextSibling->nodeValue;

					if(empty($link->childNodes[2]->nextSibling->firstChild->nextSibling)){
						continue;
					}
						$item['description'] = $link->childNodes[2]->nextSibling->firstChild->nextSibling->nodeValue;

					if (empty($link->childNodes[2]->nextSibling->lastChild->previousSibling->firstChild)) {
						continue;
					}
						$price = explode(',', explode('դր', $link->childNodes[2]->nextSibling->lastChild->previousSibling->firstChild->nodeValue)[0]);
		   				$price = $price[0].$price[1];
						$item['price'] = $price;	

					$data[] = $item;
				}

				curl_close($curl);
				$this->load->model('addProductModel');
				for ($i=0; $i < count($data); $i++) { 
					if(empty($this->addProductModel->betwen())){
						$this->addProductModel->productInsert($data[$i]);
					}
				}
				redirect('admin');
			}
		}








// if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// class Controllercurl extends CI_Controller {
// 	public function __construct() {
// 		parent::__construct();
// 		set_time_limit (1000);
// 	}
// 	public function index(){
	
// 		$this->load->library('curl');

// 		$curl = curl_init();
// 		$url = 'http://www.menu.am/restaurant/type.html';

// 		curl_setopt($curl,CURLOPT_URL, $url);
// 		curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT, 5);
// 		$curlRes = curl_exec($curl);

// 		$doc = new DOMDocument();
// 		@$doc->loadHTML($curlRes);
// 		$finder = new DomXPath($doc);
//     	$links = $finder->query("//*[@id='mainCntent']/div/div[6]/div[2]/div");
//     	$data = array();
   
// 		foreach($links as $link){
// 			$item = array();
// 			if(empty($link->childNodes[0]->firstChild->firstChild)){
// 				continue;
// 			}
// 				$source = "http://www.menu.am".$link->childNodes[0]->firstChild->firstChild->getAttribute('src');
// 				$name = explode("/", $source)[8];
// 				file_put_contents('assets/photos/menu_am/'.$name, fopen($source, 'r'));
// 				$item['image'] = $name;


// 			if (empty($link->childNodes[1]->childNodes[0])) {
// 				continue;
// 			}
// 				$item['title'] = $link->childNodes[1]->childNodes[0]->getAttribute('title');

// 			if(empty($link->childNodes[1]->childNodes[2])){
// 				continue;
// 			}
// 				$item['description'] = $link->childNodes[1]->childNodes[2]->getAttribute('title');
// 			$data[] = $item;
// 		}

// 		curl_close($curl);
// 		$this->load->model('addProductModel');
// 		for ($i=0; $i < count($data); $i++) { 
// 			if(empty($this->addProductModel->betwen())){
// 				$this->addProductModel->productInsert($data[$i]);
// 			}
// 		}
// 		redirect('admin');
// 	}
// }




