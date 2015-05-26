<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ProductItemModel extends CI_Model{

		public function getProduct($id){
			$this->db->where('id', $id);
			$query = $this->db->get('products');
			return $query->result_array();
		}
	}
?>