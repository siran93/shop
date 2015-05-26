<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AddProductModel extends CI_Model{
		public $tbName = 'products';
		public $id = 'id';
		
		function  __construct(){
			parent::__construct();
		}
		public function productInsert($data){
			$this->db->insert($this->tbName, $data);
		}
		public function getRecords(){//getRecords($num, $offset)
			$this->db->order_by($this->id, 'DESC');
			$query = $this->db->get($this->tbName);//get('products', $num, $offset);
			return $query->result_array();
		}
		public function getRecordsFront($num, $offset){
			$this->db->order_by($this->id, 'DESC');
			$query = $this->db->get($this->tbName, $num, $offset);
			return $query->result_array();
		}
		public function deleteRecord($id){
			$this->db->where($this->id, $id);
			$this->db->delete($this->tbName);
			$this->db->where('product_id', $id);
			$this->db->delete('cart');
		}
		public function updateRecord($data, $id){
			$this->db->where($this->id, $id);
			$this->db->update($this->tbName, $data);
		}
		public function betwen(){
			$this->db->where("id BETWEEN 1468 and 1473");
			$result = $this->db->get("products");

			return $result->result();
		}
	}
?>