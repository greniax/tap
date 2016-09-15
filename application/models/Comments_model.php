<?php 
class Comments_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function listCommentsByPA($pa_id)
	{
		$query = $this->db->get_where('TBL_comentarios', array ('pa_id' => $pa_id));
		return $query;
	}

	public function set_comment()
	{
	
		$this->load->helper('url');
		$data = array (
			'pa_id' => $this->input->post('pa_id'),
			'usuario' => $this->input->post('usuario'),
			'comentario' => $this->input->post('comentarios'),
		);
			return $this->db->insert('TBL_comentarios', $data);
	}
}
?>
