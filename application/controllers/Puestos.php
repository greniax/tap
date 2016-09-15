<?php
class Puestos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
			
		$this->load->model('Puestos_model');
		$this->load->helper('url_helper');
	
		if (!$this->session->usuario) header('location: '. site_url().'/auth/');
	}

	public function index()
	{
		$data['title'] = 'Puestos / Perfiles';
		$data['puestos'] = $this->Puestos_model->get_puestos();
		$data['datatable'] = $this->getDataForDatagrid();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/assets');
		$this->load->view('puestos/index', $data);
		$this->load->view('puestos/dataTable_Puesto', $data);
		$this->load->view('templates/footer');
}

	public function view($id = NULL)
	{
		$data['puestos'] = $this->Puestos_model->get_puestos($id);
		if (empty($data['puestos']))
		{
			show_404();
		}
		$data['Puesto'] = $data['puestos']['puesto'];

		$this->load->view('templates/header', $data);
		$this->load->view('puestos/view', $data);
		$this->load->view('templates/footer');

	}

	public function delpuesto()
	{
		$id = $this->uri->segment(3);
		$this->load->model('Puesto_model');
		$this->Origen_model->unset_puestos($id);
		$this->session->set_flashdata('Msg_Success',' Se ha eliminado exitosamente el Registro ');

		redirect('puestos/index');
	}	

	public function updatepuesto($id)
	{
	#	$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Actualiza Puesto / Perfil';
		$data['puestos'] = $this->Puestos_model->get_puestos($id);
		$data['datatable'] = $this->getDataForDatagrid();

		$this->form_validation->set_rules('puesto', 'Puesto', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion del Puesto / Perfil', 'required');
		$this->form_validation->set_rules('depto', 'Departamento', 'required');
		$this->form_validation->set_rules('activo', 'Activo', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/assets');
			
			$this->load->view('puestos/updatepuesto', $data);
			$this->load->view('puestos/dataTable_Puesto', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$data = array (
				'puesto' => $this->input->post('puesto'),
				'descripcion' => $this->input->post('descripcion'),
				'depto' => $this->input->post('depto'),
				'activo' => $this->input->post('activo')
			);

			$this->Puestos_model->update_puestos($id, $data);
			$this->session->set_flashdata('Msg_Success',' Se ha creado exitosamente el Registro ');
			redirect ('puestos/index');
	
		}
	}


	public function addpuesto()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Nuevo Puesto / Perfil';
		$data['puestos'] = $this->Puestos_model->get_puestos();
		$data['datatable'] = $this->getDataForDatagrid();

		$this->form_validation->set_rules('puesto', 'Puesto', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion del Puesto / Perfil', 'required');
		$this->form_validation->set_rules('depto', 'Departamento', 'required');
		$this->form_validation->set_rules('activo', 'Activo', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/assets');
			
			$this->load->view('puestos/addpuesto', $data);
			$this->load->view('puestos/dataTable_Puesto', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->Puestos_model->set_puestos();
			$this->session->set_flashdata('Msg_Success',' Se ha creado exitosamente el Registro ');
			redirect ('puestos/index');
	
		}
	}


		function getDataForDatagrid()
	{
		$this->load->model('Puestos_model');
		$datatable = $this->Puestos_model->getPuestosDB();

		$data = '';

		if ($datatable->num_rows() > 0) {
		foreach ($datatable->result() as $row) {
		$links = anchor("puestos/delpuesto/".$row->id , '<span class="glyphicon glyphicon-trash"></span> ', array('onclick' => "return confirm('¿Deseas Eliminar el registro?')"));
			$links .= anchor("puestos/updatepuesto/".$row->id , '<span class="glyphicon glyphicon-pencil"></span>');

			if ($row->activo == 1 ) {
				$activo = '<span class="glyphicon glyphicon-ok"></span> ';
			}
			else { 
				$activo = '<span class="glyphicon glyphicon-minus"></span> ';
			}

			$data[] = array(
					$row->id,
					$row->puesto,
					$row->descripcion,
					$row->depto,
					$activo,
					$links
				);
			}
		}

		$data['datatable'] = $data;
		return $data['datatable'];
	}
}
?>
