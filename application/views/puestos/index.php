<?php
	
if ($this->session->flashdata('Msg_Success')) {

	echo '<div id="msg" class="alert alert-success text-center">'. $this->session->flashdata('Msg_Success').' <a href="#" class="close" data-dissmiss="alert" aria-label="close">&times;</a></div>';
	}

echo '<script type="text/javascript">
	window.setTimeout(function() {
		$("#msg").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 3000);
</script>
	' 
?>
<div class="page-header"><h1><?php echo $title; ?></h1></div>
<div><a href="<?php echo base_url(); ?>index.php/puestos/addpuesto/">Agregar Puesto Perfil</a></div>

