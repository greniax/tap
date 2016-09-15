<?php
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->usuario) header('location: auth/');

		$this->load->model('Users_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['users'] = $this->Users_model->get_users();
		$data['title'] = 'Usuarios';
		$data['datatable'] = $this->getDataForDatagrid();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/assets');
		$this->load->view('users/index', $data);
		$this->load->view('users/dataTable_User', $data);
		$this->load->view('templates/footer');
	}

	public function view($usr_uuid = NULL)
	{
		$data['users_item'] = $this->Users_model->get_users($usr_uuid);
		if (empty($data['users_item']))
		{
			show_404();
		}
		$data['Nombre'] = $data['users_item']['usr_nombre'];

		$this->load->view('templates/header', $data);
		$this->load->view('users/view', $data);
		$this->load->view('templates/footer');

	}

		function getDataForDatagrid()
	{
		$this->load->model('Users_model');
		$datatable = $this->Users_model->getUsersDB();

		$data = '';

		if ($datatable->num_rows() > 0) {
			foreach ($datatable->result() as $row) {
			$links = anchor("users/delusers/".$row->usr_uuid , '<span class="glyphicon glyphicon-trash"></span> ', array('onclick' => "return confirm('¿Deseas Eliminar el registro?')"));
			$links .= anchor("users/updateusers/".$row->usr_uuid , '<span class="glyphicon glyphicon-pencil"></span>');

			if ($row->usr_operador == 1 ) {
				$op = '<span class="glyphicon glyphicon-user"></span> ';
			}
			else { 
				$op = '<span class="glyphicon glyphicon-minus"></span> ';
			}
			$data[] = array(
					$row->usr_uuid,
					$row->usr_nombre,
					$row->usr_paterno,
					$row->usr_materno,
					$row->usr_usuario,
					$row->usr_email,
					$op,
					$links
				);
			}
		}

		$data['datatable'] = $data;
		return $data['datatable'];
	}

	public function deluser()
	{
		$id = $this->uri->segment(3);
		$this->load->model('Users_model');
		$this->Users_model->unset_users($id);
		redirect('users/index');
	}	

	public function adduser()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Puestos_model');

		$data['title'] = 'Nuevo Usuario';
		$data['puestos'] = $this->Puestos_model->get_puestos();
		$data['users'] = $this->Users_model->get_users();
		$data['datatable'] = $this->getDataForDatagrid();

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('paterno', 'Apellido Paterno', 'required');
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('passwd', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('puesto', 'Puesto / Perfil', 'required');
		$this->form_validation->set_rules('operador', 'Operador', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/assets');

			$this->load->view('users/adduser', $data);
			$this->load->view('users/dataTable_User', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->Users_model->set_users();
			$this->session->set_flashdata('Msg_Success', 'Se ha creado exitosamente el Registro');
			redirect ('users/index');
	
		}
	}
}
?>
