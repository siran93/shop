<!-- second -->

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->helper(array('form'));
		$this->load->view('header');
		$this->load->view('loginView');
		$this->load->view('footer');
	}

	public function register(){
		$this->load->library('form_validation');

		if($this->input->post('register')){
			$this->load->model('authModel');

			$this->form_validation->set_rules('firstname', 'firstname', 'required|trim');//set_rules() functiony validation kanonneri ustanovkayi hamar e
			$this->form_validation->set_rules('username', 'username', 'required|trim');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[5]|trim');

			if($this->form_validation->run()){
			
				$data['firstname'] = $this->input->post('firstname');// post-ic ekacy, konkret'title'-y, kynkni mer nshac popoxakani mej
				$data['username'] = $this->input->post('username');
				$data['password'] = md5($this->input->post('password'));
				$this->authModel->usersInsert($data);
				
				redirect('login');
			}
		}
		$this->load->view('header');
		$this->load->view('registerView');
		$this->load->view('footer');
	}
}

?>