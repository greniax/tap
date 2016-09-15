<script type="text/javascript">
	$(document).ready(function() {
		var otable = $('#tblusuarios')
			.removeClass('display')
			.addClass('table table-striped table-bordered table-hover')
			.dataTable({
			
			// "bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"language": {
					"lengthMenu": "Mostrar _MENU_ registros por página",
					"paginate": {
						"first": "Inicio",
						"last": "último",
						"previous": "previo",
						"next": "siguiente"
						},
					"zeroRecords": "No se encontraron registros",
					"info": "Mostrando página _PAGE_ de _PAGES_",
					"infoEmpty": "No se encontraron registros",
					"infoFiltered": "(Filtrando de _MAX_ registros totales)",
					"search": "Buscar"
				},
				responsive: true
		});
	});
</script>
<div id="dataTableUsers" class="table display">
<?php
$CI = & get_instance();
$CI->load->library('table');
$tmpl = array('table_open'=>'<table class="display table-responsive no-wrap" id="tblusuarios"; > '); 
$CI->table->set_template($tmpl);
$CI->table->set_heading('Id', 'Nombre', 'Paterno', 'Materno', 'Usuario', 'Email', 'Op', 'Links');
echo $CI->table->generate($datatable);
?>
</div> <!-- /div DataTableUsers -->
