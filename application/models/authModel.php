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
		public function getEmail($email){
			$this->db->select();
			$this->db->from('admin');
			$this->db->where('email', $email);
			$query = $this->db->get()->num_rows();
			return $query;
		}
		public function getActivationCode($id, $data){
			$id = base_url('login/confirmEmail')."/".$id;
			$this->db->where('activation_code', $id);
			$this->db->update('admin', $data);
		}
	}
		
?>