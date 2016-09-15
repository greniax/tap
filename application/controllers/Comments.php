<?php 
class Comments extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();

		
		$this->load->model('Comments_model');
		$this->load->helper('url_helper');
	
		if (!$this->session->usuario) header('location: '. site_url().'/auth/');
	}

	public function index()
	{
		$data['title'] = 'Comentarios';
		$this->load->view('templates/header', $data);
#		$this->load->view('templates/assets');
		$this->load->view('comments/index', $data);
		$this->load->view('templates/footer');
	}

	public function addcomments($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Comments_model');
		$this->form_validation->set_rules('comentarios', 'Comentarios / Observaciones', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			redirect ('AP/byId/'.$id);
		}
		else
		{
			$this->Comments_model->set_comment();
			$this->session->set_flashdata('Msg_Success',' Se ha creado exitosamente el Registro ');
			redirect ('AP/byId/'.$id);
		}
	}

	public function showCommentById($pa_id)
	{
		$data['title'] = 'Comentarios / Observaciones';
		$data['datatable'] = $this->getDataForDatagrid($pa_id);

		$this->load->view('comments/dataTable_Comments');
	}

	public function getDataForDatagrid($pa_id)
	{
		$this->load->model('Comments_model');
		$datatable = $this->Comments_model->listCommentsByPA($pa_id);

		$data = '';

		if ($datatable->num_rows() > 0) 
			foreach ($datatable->result() as $row) {
				$data[] = array(
						$row->id,
						$row->usuario,
						$row->fecha,
						$row->comentario
					);
			}
	#	$data['datatable'] = $data;
		#	return $data['datatable'];
		return $data;

	}

}
?>
