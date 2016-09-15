<?php
class Users_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	
	public function getUsersDB()
	{
		$query = $this->db->get('TBL_Usuarios');
		return $query;
	}

	public function get_users($usr_uuid = FALSE)
	{
		if ($usr_uuid === FALSE)
		{
			$query = $this->db->get('TBL_Usuarios');
			return $query->result_array();
		}

		$query = $this->db->get_where('TBL_Usuarios', array('usr_uuid' => $usr_uuid));
		return $query->row_array();
	}
	
	public function unset_users($usr_uuid = FALSE)
	{
		if ($usr_uuid !== FALSE)
		{
			$this->load->helper('url');
			return $this->db->delete('TBL_Usuarios', array('usr_uuid' => $usr_uuid));
		}
	}
	
	public function set_users()
	{
		$this->load->helper('url');
		
		$data = array(
			'usr_nombre' => $this->input->post('nombre'),
			'usr_paterno' => $this->input->post('paterno'),
			'usr_materno' => $this->input->post('materno'),
			'usr_usuario' => $this->input->post('usuario'),
			'usr_passwd' => $this->hashpassword($this->input->post('passwd')),
			'usr_puesto' => $this->input->post('puesto'),
			'usr_email' => $this->input->post('email'),
			'usr_operador' => $this->input->post('operador')
		);

		return $this->db->insert('TBL_Usuarios', $data);
	}

		function hashpassword($passwd)
		{
			return MD5($passwd);
		}

		function get_username($uuid) 
		{
			$fullname = '';
			if ($uuid === FALSE)
			{
				$query = $this->db->get('TBL_Usuarios');
				#return $query->result_array();
			}
			
			$query = $this->db->get_where('TBL_Usuarios', array('usr_uuid' => $uuid));
			$row = $query->row_array();

			$fullname = $row['usr_nombre'].' '.$row['usr_paterno'].' '.$row['usr_materno'];
			return $fullname;

		}
}
