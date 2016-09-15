<?php 
class Origen_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	
	public function getOrigenDB()
	{
		$query = $this->db->get('TBL_origen');
		return $query;
	}

	public function get_origen($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('TBL_origen');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('TBL_origen', array('id' => $id));
		
		return $query->row_array();
	}

	public function set_origen() 
	{
		$this->load->helper('url');
		$data = array (
			'origen' => $this->input->post('origen'),
			'clave' => $this->input->post('clave'),
			'descripcion' => $this->input->post('descripcion'),
			'activo' => $this->input->post('activo'),
		);
			return $this->db->insert('TBL_origen', $data);
	}

	public function unset_origen($id = FALSE)
	{
		if ($id !== FALSE)
		{
			$this->load->helper('url');
			return $this->db->delete('TBL_origen', array('id' => $id));
		}
	}
	
	public function update_origen($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('TBL_origen', $data);
	}

}
