<?php
	function expired($int)
	{
		if ($int > 0)
		{
			return 'class= "panel panel-primary"';
		}
		if ($int == 0)
		{
			return 'class= "panel panel-default"';
		}
	}

	function soltotext($sol)
	{
	 if ($sol <> Null)
	 {
		switch ($sol)
		{
		case 'AC' : $str = 'Acción Correctiva';
			 break;
		case 'AP' : $str = 'Acción Preventiva';
			 break;
		case 'CI' : $str = 'Corrección Inmediata';
			 break;
		}
		return $str;
	 }

	}

	$addcomscript ='
<script type="text/javascript">
	;(function($) {
		$(function() {
			$(\'#addcomm\').bind(\'click\', function(e) {
				e.preventDefault();
				$(\'#popupcomment\').bPopup({
					position: [50,50]
						});
			});
		});
	})(jQuery);
</script>';

?>
<div class="row">
<!-- { AP COLUMN LEFT } -->
<div class="col-md-4">  
     <div class="panel panel-default">
     <div class="panel-heading"><strong>#<?php echo $pa['pa_id']; ?></strong> - <span class="label label-primary"><?php echo $asignado; ?></span> -</div>
        <div class="panel-body">
	  <ul class="list-group">
		<li class="list-group-item">
			status : <span><?php echo $pa['pa_status']; ?></span>
		</li>
		<li class="list-group-item">
			Origen : <span title="<?php echo $origen['origen']; ?>"><?php echo $origen['clave'].' - ' .$origen['origen']; ?></span>
		</li>
		<li class="list-group-item">
			Criterio : <span><?php echo $pa['pa_criterio']; ?></span>
		</li>
	  </ul>
	</div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">No Conformidad / Observaciones</div>
      <div class="panel-body"><?php echo $pa['pa_noconformidad']; ?></div>
    </div>
    <div class="panel panel-default">
	  <div class="panel-heading"><span style="font-size:1.5em;" class="glyphicon glyphicon-calendar"></span> Creado </div>
	  <div class="panel-body"><h4><?php echo $pa['pa_creado']; ?></h4></div>
    </div>
<!-- { File Upload } -->
   <div class="panel panel-default">
      <div class="panel-heading">Archivos</div>
      <div class="panel-body">Lista de Archivos
<?php $attributes = array ('class' => 'form-horizontal'); ?>

<?php echo form_open_multipart('upload/do_upload/'.$pa['pa_id'], $attributes); ?>
<form action="" method="">
		<input id="ticketfile" type="file" size="10" name="ticketfile" class="" />
		<button class="btn btn-primary btn-file" type="submit" title="Subir Archivo"><span class="glyphicon glyphicon-upload" style="font-size: 1.5em;"></span> </button>
</form>
	</div>

    </div>
</div>

<!-- { AP COLUMN CENTER } -->
<div class="col-md-4">  
    <div class="panel panel-default">
      <div class="panel-heading">Causa Raiz</div>
      <div class="panel-body"><?php echo $pa['pa_causaraiz']; ?></div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Tipo de Solucion</div>
      <div class="panel-body"><h3><?php echo soltotext($pa['pa_tiposol']); ?></h3></div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Descripcion</div>
      <div class="panel-body"><?php echo $pa['pa_descsol']; ?></div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Responsables</div>
      <div class="panel-body"><?php echo $pa['pa_responsables']; ?></div>
    </div>
    <div <?php echo expired($expire); ?> >
	  <div class="panel-heading"> <span style="font-size:1.5em;" class="glyphicon glyphicon-calendar"></span> Fecha Cumplimiento </div>
	  <div class="panel-body"><span><h4><?php echo $pa['pa_fechacumplimiento']; ?></h4></span><?php echo $expire; ?></div>
    </div>
</div>

<!-- { AP COLUMN RIGHT } -->
<div class="col-md-4">  
    <div class="panel panel-default">
      <div class="panel-heading">Motivo de Reprogramacion</div>
      <div class="panel-body"><?php echo $pa['pa_reprogramado']; ?></div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading"><span style="font-size:1.5em;" class="glyphicon glyphicon-calendar"></span> Fecha de Reprogramacion</div>
      <div class="panel-body"><h4><?php echo $pa['pa_fechareprog']; ?></h4></div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Eficacia de las acciones tomadas</div>
      <div class="panel-body"><?php echo $pa['pa_eficacia']; ?></div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading"><span style="font-size:1.5em;" class="glyphicon glyphicon-calendar"></span> Fecha de Cierre</div>
      <div class="panel-body"><span><h4><?php echo $pa['pa_fechacierre']; ?></h4></span></div>
    </div>
<!-- { COMMENTS } -->
<?php echo $addcomscript; ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.bpopup.min.js"></script>

   <div class="panel panel-default">
     <div class="panel-heading">Comentarios / Observaciones </div>
	<div class="panel-body">
		<div><button id="addcomm" class="glyphicon glyphicon-plus btn btn-primary btn-xs"> Agregar Comentario</button></div>
<?php if (empty($comments ) == 0) { ?>
<?php foreach ($comments as $item):?>
			<div class="media">
				<div class="media-left">
					<a href="#">
						<img class="media-object img-circle" src="http://placekitten.com/50/50" alt="me parecio ver un lindo gatito">
					</a>
				</div>
				<div class="media-body">
				<h5 class="media-heading"> [ <?php echo $item[1];?> ] <small><i><?php echo $item[2]; ?></i></small></h5><p><?php echo $item[3]; ?></p> 
				</div>
			</div>
<?php endforeach; ?>
<?php } ?>
	</div>
     </div>

  </div>
</div>
