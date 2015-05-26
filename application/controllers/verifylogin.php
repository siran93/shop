<!-- second -->

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class VerifyLogin extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->model('user','',TRUE);
		}

		function index(){
			$this->load->library('form_validation');//This method will have the credentials validation

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_checkDatabase');

			if($this->form_validation->run() == FALSE){
				$this->load->view('header');
				$this->load->view('loginView'); //Field validation failed.  User redirected to login page
				$this->load->view('footer');
			}
			else{
				redirect('admin', 'refresh');//Go to private area
			}
		}

		function checkDatabase($password){
			$username = $this->input->post('username');//Field validation succeeded.  Validate against database
	  
			$result = $this->user->login($username, $password); //query the database
			if($result){
				$sess_array = array();
				foreach($result as $row){
					$sess_array = array(
						'id' => $row->id,
						'username' => $row->username
						);
					$this->session->set_userdata('logged_in', $sess_array);
				}
				return TRUE;
			}else{
				$this->form_validation->set_message('checkDatabase', 'Invalid username or password');
				return false;
			}
		}
	}
?>