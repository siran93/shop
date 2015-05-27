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
			$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');

			if($this->form_validation->run()){
				$email = $this->input->post('email');
				if($this->authModel->getEmail($email) == 0){
					$data['firstname'] = $this->input->post('firstname');// post-ic ekacy, konkret'title'-y, kynkni mer nshac popoxakani mej
					$data['username'] = $this->input->post('username');
					$data['password'] = md5($this->input->post('password'));
					$data['email'] = $this->input->post('email');
					$data['activation_code'] = base_url('login/confirmEmail')."/".md5($this->input->post('email'));

					$this->load->library('email');

		            $config['protocol']     = 'smtp';
		            $config['smtp_host']    = 'ssl://smtp.gmail.com';
		            $config['smtp_port']    = '465';
		            $config['smtp_timeout'] = '7';
		            $config['smtp_user']    = 'softCodeOnlineShop@gmail.com';
		            $config['smtp_pass']    = '123onlineshop123';
		            $config['charset']    	= 'utf-8';
		            $config['newline']   	= "\r\n";
		            $config['mailtype'] 	= 'text'; // or html
		            $config['validation'] 	= TRUE; // bool whether to validate email or not      

		            $this->email->initialize($config);

					$this->email->from("softCodeOnlineShop@gmail.com", "Shop for Good");
					$this->email->to(set_value('email'));
					$this->email->subject("Registration Message");
					$this->email->message($data['activation_code']);

					$this->email->send();
					echo $this->email->print_debugger();


	 				$this->authModel->usersInsert($data);
					
					redirect('waitingEmail');
				}else{
					$data['msg'] = "usrish email";
					// $this->load->view('header');
					// $this->load->view('registerView', $data);
					// $this->load->view('footer');
				}
			}
		}
		$this->load->view('header');
		$this->load->view('registerView');
		$this->load->view('footer');
	}

	public function confirmEmail($id){
		$id = $this->uri->segment(3);
		$data['activated'] = 1;
 		$this->load->model('authModel');
		$this->authModel->getActivationCode($id, $data);
		redirect('login');
	}
}

?>