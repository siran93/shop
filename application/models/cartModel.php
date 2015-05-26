<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class CartModel extends CI_Model{

		function  __construct(){
			parent::__construct();

		}
		public function cartInsert($data = array()){
			$this->db->insert('cart', $data);
		}
		public function getCount($user_id){
			$this->db->select();
			$this->db->from('cart');
			$this->db->where('user_id', $user_id); 
			$query = $this->db->get()->num_rows();
			return $query;
		}
		public function getProduct($id){
			$this->db->select('p.*, c.id as cart_id, a.id as admin_id');
			$this->db->from('cart as c');
	        $this->db->join('admin as a', 'c.user_id = a.id', 'left');
	        $this->db->join('products as p', 'c.product_id = p.id', 'left');
	      	$this->db->where('a.id', $id);
	        return $this->db->get()->result_array();

	// SELECT p.*, c.id as cart_id, a.id as admin_id
	// FROM cart c
	// LEFT JOIN admin a ON c.user_id = a.id
	// LEFT JOIN products p ON c.product_id = p.id 
	// WHERE a.id = 6
		}
		public function deleteProduct($id){
			$this->db->where('id', $id);
			$this->db->delete('cart'); 
		}

		public function insertRate($data){
			$this->db->insert('rate', $data);
		}

		public function getRate($id){
			$this->db->select('sum(value) as sum, count(product_id) as count');
			$this->db->from('rate');
			$this->db->where('product_id', $id);

			return $this->db->get()->result_array();
		}
	}
?>
