<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AdminModel extends CI_Model {
		public $id = 'id';
		function  __construct(){
			parent::__construct();
		}
		public function getAdmin($id){
			$this->db->order_by($this->id, 'DESC');
			$result = $this->db->get_where('admin', array($this->id => $id));
			return $result->result_array();
		}

		public function getCartHistory(){

	        return $this->db->query(
	        	'SELECT 
					u.id,
					u.firstname,
					u.created_date,
					COALESCE(MAX(c.last_action), "-") AS last_action,
					COUNT(c.user_id) AS product_count,
					COALESCE(SUM(p.price), 0) AS total_price
				FROM admin u
				LEFT JOIN cart c ON (u.id = c.user_id)
				LEFT JOIN products p ON (p.id = c.product_id)
				GROUP BY u.id')->result_array();

	  //    	 SELECT 
			// 	u.id,
			// 	u.firstname,
			// 	COUNT(c.user_id) AS product_count,
			// 	COALESCE(SUM(p.price), 0) AS total_price
			// FROM admin u
			// LEFT JOIN cart c ON (u.id = c.user_id)
			// LEFT JOIN products p ON (p.id = c.product_id)
			// GROUP BY u.id

		}
	}
?>