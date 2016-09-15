<?php
class AP extends CI_Controller {
	public function __construct ()
	{
		parent :: __construct();
		$this->load->model('Users_model');
		$this->load->model('Origen_model');
		$this->load->model('PA_model');
		$this->load->helper('Url_helper');
		
	if (!$this->session->usuario) header('location: '. site_url().'/auth/');
	}

	public function index()
	{
		$data['title'] = 'Lista de Planes de Accion';
		$data['datatable'] = $this->getDataForDatagrid($this->session->iduser);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/assets');
		$this->load->view('AP/index', $data);
		$this->load->view('AP/dataTable_AP', $data);
		$this->load->view('templates/footer');
	}

	public function byId($id)
	{
		$data['title'] = 'Vista de Plan de Acción';
		$data['pa'] = $this->PA_model->getPAbyId($id);
		$data['origen'] = $this->Origen_model->get_origen($data['pa']['pa_refauditoria']);
		$data['asignado'] = $this->Users_model->get_username($data['pa']['pa_asignado']);
		$data['expire'] = $this->getexpired($id);	
		$data['comments'] = $this->getDataForCommentDatagrid($id);

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('Url_helper');	
		$this->load->view('templates/header', $data);
		$this->load->view('AP/index', $data);
		$this->load->view('AP/vista_pa', $data);
		$this->load->view('comments/addcommentform');
		$this->load->view('templates/footer');

	}


		function getDataForCommentDatagrid($id)
	{
		$this->load->model('Comments_model');
		$datatable = $this->Comments_model->listCommentsByPA($id);

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
		$data['datatable'] = $data;
		return $data['datatable'];
	}

		function getexpired($id)
	{
		$createdate = strtotime($this->PA_model->getCreateDate($id));
		$expiredate = strtotime($this->PA_model->getExpireDate($id));
		$progdate = strtotime($this->PA_model->getProgDate($id));
		$closedate = strtotime($this->PA_model->getCloseDate($id));
		$today = strtotime($this->PA_model->getToday());
	
	#	if (($expiredate < $today) AND ($closedate <> Null))
	#	{
	#		return 0;
	#	}
		if ($expiredate < $today)
		{
			return 1;
		}

		if ($expiredate > $today )
		{
			return 0;
		}

		if ($progdate < $today)
		{
			return 0;
		}
		if ($progdate > $today)
		{
			return 1;
		}
	}
	
		function getDataForDatagrid($iduser)
	{
		$this->load->model('PA_model');
		$this->load->model('Origen_model');
		
		if ($this->session->operador <> 0 )
		{
			$datatable = $this->PA_model->getpaDBForOP();
		}
		else
		{
			$datatable = $this->PA_model->getpaDBbyUserId($iduser);
		}

		$data = '';

		if ($datatable->num_rows() > 0) {
			foreach ($datatable->result() as $row) {
		
#				$links = anchor("#".$row->id , '<span class="glyphicon glyphicon-mail"></span> ');
#			$links .= anchor("#".$row->id , '<span class="glyphicon glyphicon-calendar"></span>');
				$col0 = '<span>'.$row->pa_id.'</span>';	
				$col1 = '<span><strong>'.$row->pa_noconformidad.'</strong></span>';
				$origen = $this->Origen_model->get_origen($row->pa_refauditoria);
				$col2 = '<span title="'.$origen['origen'].'">'.$origen['clave'].'</span>';
				$col3 = '<span>'.date_format(date_create($row->pa_creado), 'Y-m-d').'</span>';
				#$col4 = '<span>'.$row->pa_id.'</span>';
				$col1 .='<ul class="list-inline"><li><span>'.$row->pa_tiposol.'</span></li>';
				$col1 .='<li><span class="'.$this->displayStatus($row->pa_statusgral).'"></span><span>'.$row->pa_status.'</span></li>';
				$col1 .='<li><span>'.$this->Users_model->get_username($row->pa_asignado).'</span></li>';
				$col1 .='<li><span class="glyphicon glyphicon-time"></span> <span>'.$row->pa_fechacumplimiento.'</span></li>';
				$col1 .='<li><span>'.$row->pa_fechareprog.'</span></li>';
				$col1 .='<li><span>'.$row->pa_fechacierre.'</span></li></ul>';
				$col4 ='<span title="Aceptar" class="glyphicon glyphicon-hand-up"> </span>';
				$col4 .= anchor("AP/byId/".$row->pa_id, '<span class="glyphicon glyphicon-search" title="ver"></span>');
				$col4 .='<span class="glyphicon glyphicon-trash" title="Eliminar"> </span>';
				$col4 .='<span class="glyphicon glyphicon-remove" title="Cancelar"> </span>';

			$data[] = array(
					$col0,
					$col1,
					$col2,
					$col3,
					$col4
				);
			}
		}

		$data['datatable'] = $data;
		return $data['datatable'];
	}

		function displayStatus($status) {
		
			switch ($status) {
			case 1 : $strhtml = 'glyphicon glyphicon-pause text-info';
				 break;
			case 2 : $strhtml = 'glyphicon glyphicon-lock text-primary';
				 break;
			case 3 : $strhtml = 'glyphicon glyphicon-play text-success';
				 break;
			case 0 : $strhtml = 'glyphicon glyphicon-play text-success';
				 break;

			}
			return $strhtml;
		}

			
}
?>
