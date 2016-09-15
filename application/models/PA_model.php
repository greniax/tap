<?php 
class PA_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getpaDBForOP()
	{
	
		$query = $this->db->get_where('TBL_paccion', array ('pa_statusgral <> ' => '2')); // where 2 is closed
		return $query;

	}

	public function getpaDBbyUserId($iduser)
	{
		$query = $this->db->get_where('TBL_paccion', array ('pa_asignado' => $iduser, 'pa_statusgral <> ' => '2')); // where 2 is closed
		return $query;

	}

	public function getPAbyId($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('TBL_origen');
			return $query->result_array();
		}
	
		$query = $this->db->get_where('TBL_paccion', array('pa_id' => $id));
		return $query->row_array();
	}

	public function getCreateDate($id)
	{
		$query = $this->db->get_where('TBL_paccion', array('pa_id' => $id));
		$row = $query->row();
		$createdate = date_format(date_create($row->pa_creado), 'Y-m-d'); 
		return $createdate;
	}

	public function getExpireDate($id)
	{
		$query = $this->db->get_where('TBL_paccion', array('pa_id' => $id));
		$row = $query->row();
		$expiredate = date_format(date_create($row->pa_fechacumplimiento), 'Y-m-d'); 
		return $expiredate;
	}

	public function getProgDate($id)
	{
		$query = $this->db->get_where('TBL_paccion', array('pa_id' => $id));
		$row = $query->row();
		$progdate = date_format(date_create($row->pa_fechareprog), 'Y-m-d'); 
		return $progdate;
	}

	public function getCloseDate($id)
	{
		$query = $this->db->get_where('TBL_paccion', array('pa_id' => $id));
		$row = $query->row();
		$closedate = date_format(date_create($row->pa_fechacierre), 'Y-m-d'); 
		return $closedate;
	}

	public function getToday()
	{
		$today = date('Y-m-d');

		return $today;
	}
}
?>
