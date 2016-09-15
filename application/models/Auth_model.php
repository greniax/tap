<?php
Class Auth_model extends CI_Model {

	public function __construct() {
	
		parent::__construct();
	}

	// Obtiene el usuario y passwd de la DB
	public function GetUser($usr, $pwd)
	{
		$this->db->where('usr_usuario', $usr);
		$this->db->where('usr_passwd', md5($pwd));
		$query = $this->db->get('TBL_Usuarios');

		return $query->num_rows();
	}

	// Insert registration data in database
	 public function registration_insert($data) {
	
		 // Query to check whether username already exist or not
		$condition = "usr_usuario =" . "'" . $data['user_name'] . "'";
	 	$this->db->select('*');
		$this->db->from('TBL_Usuarios');
		$this->db->where($condition);
	 	$this->db->limit(1);
	 	$query = $this->db->get();
	 	if ($query->num_rows() == 0) {
	
	 		// Query to insert data in database
	 	$this->db->insert('user_login', $data);
	 	if ($this->db->affected_rows() > 0) {
	 	return true;
	 		}
	 	} else {
	 	return false;
		}
	 }
	
	 // Read data using username and password
	 public function login($data) {
	
	 	$condition = "usr_usuario =" . "'" . $data['username'] . "' AND " . "usr_passwd =" . "'" . $data['password'] . "'";
	 	$this->db->select('*');
	 	$this->db->from('TBL_Usuarios');
	 	$this->db->where($condition);
	 	$this->db->limit(1);
	 	$query = $this->db->get();
	
	 	if ($query->num_rows() == 1) {
	 		return true;
	 	} else {
	 		return false;
	 	}
	 }
	
	 // Read data from database to show data in admin page
	 public function UserInfo($username) {
	
	 	$condition = "usr_usuario =" . "'" . $username . "'";
	 	$this->db->select('*');
	 	$this->db->from('TBL_Usuarios');
	 	$this->db->where($condition);
	 	$this->db->limit(1);
	 	$query = $this->db->get();
	
	 	if ($query->num_rows() == 1) {
	 		return $query->result();
	 	} else {
	 		return false;
	 	}
	 }

	 public function getUserid($username)
	 {
		 $query = $this->db->get_where('TBL_Usuarios', array ('usr_usuario' => $username));
		 $row = $query->row();
		 $iduser = $row->usr_uuid;

		 return $iduser;
	 }

	 public function IsOp($username = FALSE){
		 
		 $this->db->where('usr_usuario', $username);
		 $query = $this->db->get('TBL_Usuarios');
		 $row = $query->row();
		 if ($row->usr_operador == 1 )
			 {
				return 1;
			 }
			 else
			 {
				 return 0;
			 }
		 }
	 

 }
	
?>
