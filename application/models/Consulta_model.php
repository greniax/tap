<?php 
class Consulta_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getConsultaDB()
	{
		$query = $this->db->get('TBL_paccion');
		return $query;
	}

}
?>
