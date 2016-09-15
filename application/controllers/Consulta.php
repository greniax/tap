<?php
class Consulta extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();

		$this->load->model('Users_model');
		$this->load->model('Consulta_model');
		$this->load->helper('Url_helper');

		if (!$this->session->usuario) header('location: '. site_url().'/auth/');
	}

	public function index()
	{
		$data['title'] = 'Lista de Planes de Accion';
		$data['datatable'] = $this->getDataForDatagrid();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/assets');
		$this->load->view('consulta/index', $data);
		$this->load->view('consulta/dataTable_Consulta', $data);
		$this->load->view('templates/footer');
	}

	public function ver()
	{
		$data['title'] = 'Ver Plan de Acción';
	}

		function getDataForDatagrid()
	{
		$this->load->model('Consulta_model');
		$this->load->model('Origen_model');
		$datatable = $this->Consulta_model->getConsultaDB();

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
				$col1 .='<li><span class="glyphicon glyphicon-calendar"></span> <span data-toggle="tooltip" data-placement="top" title="Fecha Cumplimiento">'.$row->pa_fechacumplimiento.'</span></li>';
				$col1 .='<li><span data-toggle="tooltip" data-placement="top" title="Fecha Reprogramacion">'.$row->pa_fechareprog.'</span></li>';
				$col1 .='<li><span  data-toggle="tooltip" data-placement="top" title="Fecha de Cierre">'.$row->pa_fechacierre.'</span></li></ul>';
				$col4 ='<span title="ver" class="glyphicon glyphicon-hand-up"> </span>';
				$col4 .= anchor("AP/byId/".$row->pa_id, '<span class="glyphicon glyphicon-search" title="ver"></span>');
				$col4 .='<span class="glyphicon glyphicon-trash" title="Eliminar"> </span>';
				$col4 .='<span class="glyphicon glyphicon-remove" title="Cancelar"></span>';


			

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

} //end Class
?>
