<?php 
class Origen extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();

		
		$this->load->model('Origen_model');
		$this->load->helper('url_helper');
	
		if (!$this->session->usuario) header('location: '. site_url().'/auth/');
	}

	public function index()
	{
		$data['title'] = 'Origen';
		$data['datatable'] = $this->getDataForDatagrid();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/assets');
		$this->load->view('origen/index', $data);
		$this->load->view('origen/dataTable_Origen', $data);
		$this->load->view('templates/footer');
	}

	public function delorigen()
	{
		$id = $this->uri->segment(3);
		$this->load->model('Origen_model');
		$this->Origen_model->unset_origen($id);
		$this->session->set_flashdata('Msg_Success',' Se ha eliminado exitosamente el Registro ');

		redirect('origen/index');
	}	

	public function updateorigen($id)
	{
		$this->load->library('form_validation');

		$data['title'] = 'Actualiza Origen';
		$data['origen'] = $this->Origen_model->get_origen($id);
		$data['datatable'] = $this->getDataForDatagrid();
		
		$this->form_validation->set_rules('origen', 'Origen', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion del Origen', 'required');
		$this->form_validation->set_rules('activo', 'Activo', 'required');

	if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/assets');

			$this->load->view('origen/updateorigen', $data);
			$this->load->view('origen/dataTable_Origen', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$data = array (
				'origen' => $this->input->post('origen'),
				'descripcion' => $this->input->post('descripcion'),
				'activo' => $this->input->post('activo')
			);
		
			$this->Origen_model->update_origen($id, $data);

			$this->session->set_flashdata('Msg_Success',' Se ha actualizado exitosamente el Registro ');
			redirect ('origen/index');
		}
	}

	public function addorigen()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Nuevo Origen';
		$data['origen'] = $this->Origen_model->get_origen();
		$data['datatable'] = $this->getDataForDatagrid();
		
		$this->form_validation->set_rules('origen', 'Origen', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripcion del Origen', 'required');
		$this->form_validation->set_rules('clave', 'Clave Corta', 'required');
		$this->form_validation->set_rules('activo', 'Activo', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/assets');

			$this->load->view('origen/addorigen', $data);
			$this->load->view('origen/dataTable_Origen', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->Origen_model->set_origen();
			$this->session->set_flashdata('Msg_Success',' Se ha creado exitosamente el Registro ');
			redirect ('origen/index');
		}
	}

		function getDataForDatagrid()
	{
		$this->load->model('Origen_model');
		$datatable = $this->Origen_model->getOrigenDB();

		$data = '';

		if ($datatable->num_rows() > 0) {
			foreach ($datatable->result() as $row) {
			$links = anchor("origen/delorigen/".$row->id , '<span class="glyphicon glyphicon-trash"></span> ', array('onclick' => "return confirm('¿Deseas Eliminar el registro?')"));
			$links .= anchor("origen/updateorigen/".$row->id , '<span class="glyphicon glyphicon-pencil"></span>');

			if ($row->activo == 1 ) {
				$activo = '<span class="glyphicon glyphicon-ok"></span> ';
			}
			else { 
				$activo = '<span class="glyphicon glyphicon-minus"></span> ';
			}

			$data[] = array(
					$row->id,
					$row->origen,
					$row->clave,
					$row->descripcion,
					$activo,
					#$row->activo,
					$links
				);
			}
		}

		$data['datatable'] = $data;
		return $data['datatable'];
	}

}
?>
