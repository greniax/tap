<?php 
class Puestos_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getPuestosDB()
	{
		$query = $this->db->get('TBL_puestos');
		return $query;
	}

	public function get_puestos($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('TBL_puestos');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('TBL_puestos', array('id' => $id));
		return $query->row_array();
	}

	public function set_puestos() 
	{
		$this->load->helper('url');
		$data = array (
			'puesto' => $this->input->post('puesto'),
			'descripcion' => $this->input->post('descripcion'),
			'depto' => $this->input->post('depto'),
			'activo' => $this->input->post('activo'),
		);
			return $this->db->insert('TBL_puestos', $data);
	}

	public function unset_puestos($id = FALSE)
	{
		if ($id !== FALSE)
		{
			$this->load->helper('url');
			return $this->db->delete('TBL_puestos', array('id' => $id));
		}
	}
	
	public function update_puestos($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('TBL_puestos', $data);
	}


}
