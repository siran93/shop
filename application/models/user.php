<?php
	Class User extends CI_Model
	{
		public function login($username, $password){
			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->security->xss_clean(md5($this->input->post('password')));

			$this->db->select('id, username, password, email');
			$this->db->from('admin');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1){
				return $query->result();
			}else{
				return false;
			}
		}
		public function activated($email){
			$this->db->select('activated');
			$this->db->from('admin');
			$this->db->where('email', $email);
			$this->db->where('activated', 0);
			$query = $this->db->get()->num_rows();
			return $query;
		}
	}
?>