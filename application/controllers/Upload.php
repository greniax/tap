<?php
class Upload extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->helper(array ('form', 'url', 'directory'));
	}

	public function index() {
	
	}

	public function do_upload($id) {

		$this->load->library('upload', $this->config->load('tap_file'));
		
		$this->make_uploaddir();
		$this->make_dir($id);

		if ( !$this->upload->do_upload('ticketfile')) {
			$error = array('error' => $this->upload->display_errors());
	#		print_r($error);
	#		echo base_url();
			$this->session->set_flashdata('Msg_Success', $error['error']);
				redirect ('AP/index');
		#	print_r($this->config->item('file_upload_path'));
		}
		else {
				redirect ('AP/index');
		#	print_r($this->config);
		}
	}

		function make_uploaddir() {
			if (!is_dir($this->config->item('file_upload_path'))) mkdir($this->config->item('file_upload_path'), 0777, TRUE);

		}

		function make_dir($id) {
			if (!is_dir($this->config->item('file_upload_path').$id)) {
				mkdir($this->config->item('file_upload_path').$id, 0777, TRUE);
			}

		}

		function dir_list($id) {
			$map = directory_map($this->config->item('file_upload_path').$id, 1);
			return $map;
		}

}
?>
