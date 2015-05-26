<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AuthModel extends CI_Model {

		function  __construct(){
			parent::__construct();
		}
		public function usersInsert($data){
			$this->db->insert('admin', $data);
		}
		public function usersInsertReg($data){
			$this->db->insert('users', $data);
		}
	}
?>