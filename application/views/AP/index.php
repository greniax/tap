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
<?php if ($this->session->operador == 1 ) { ?> 
<div><button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span> Agregar Plan de Acción </button> </div>
<?php } ?>
<br \>
