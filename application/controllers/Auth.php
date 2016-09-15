<?php 
Class Auth extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('html');
		$this->load->helper('Url');
		$this->load->database();
	
		$this->load->model('Auth_model');
	}

	public function index () {
		
		// obtiene los valores del formulario
		$username = $this->input->post('txt_usuario');
		$passwd = $this->input->post('txt_passwd');

		// Valida los datos
		$this->form_validation->set_rules('txt_usuario', 'Usuario', 'trim|required');
		$this->form_validation->set_rules('txt_passwd', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			// Fallo en la Validación
			$this->load->view('auth/login');
		}
		else
		{
			if ($this->input->post('btn_login') == 'Ingresar') {

				// Verifica que usuario y passwd son correctos
				$usr_result = $this->Auth_model->GetUser($username, $passwd);
				// Valida si es operador TRUE / FALSE
				if ($usr_result > 0) {
					$usrparam = $this->Auth_model->UserInfo($username);
				//Declara las variables de sesion
					$sessiondata = array (
						'usuario' => $username,
						'loginuser' => TRUE,
						'operador'=> $this->Auth_model->IsOp($username),
						'iduser' => $this->Auth_model->getUserid($username)
					);
				$this->session->set_userdata($sessiondata);
				redirect("/");
				}
				else
				{
					$this->session->set_flashdata('msg','Usuario Invalido');
					redirect('auth/index');
				}
			}
			else
			{
				redirect('auth/index');
			}
		}
	}

	public function logout () {
		// se destruye la session y se redirecciona
		$this->session->sess_destroy();
		redirect('auth/');
	}
}
