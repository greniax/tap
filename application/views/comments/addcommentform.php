<?php
	$attributes = array ('class' => 'form-horizontal');

echo '	<!-- { Add Comment } -->';
?>	
<style>
/*.popupcom {display:none;position:fixed; border:10px solid #676767;padding:0px;width:500px;left:20%;margin-left:-100px;height:250px;top:30%;margin-top:-50px; background:rgba(0,0,0,0.5);z-index:1000;border-radius:22px 22px 22px 22px; -moz-border-radius: 22px 22px 22px 22px; -webkit-border-radius: 22px 22px 22px 22px;}
#popupcomment:after {position:fixed;content:" ";top:0;left:0;bottom:0;right:0;background:rgba(0, 0, 0, 0.5);z-index:-2;}
#popupcomment:before {position:absolute;content:" ";top:0;left:0;bottom:0;right:0;background:#FFF;z-index:-1;}
*/
#popupcomment {backgroundcolor:#FFF;border-radius:10px;display:none;padding:30px;min-width=500px;min-height:250px;}

</style>
<div id="comments" class="row">
<div class="popupcom col-md-4" id="popupcomment">
<div class="panel panel-default">
	<div class="panel-heading"> Comentarios / Observaciones </div>
	<div class="panel-body">
<?php echo form_open('comments/addcomments/'. $pa['pa_id'], $attributes); ?>
	<fieldset>
<?php 	echo form_hidden('pa_id',$pa['pa_id']);
	echo form_hidden('usuario', $this->session->usuario);
?>
		<textarea id="comentarios" name="comentarios" rows="5" cols="40" placeholder="Agrega tus comentarios / Observaciones"></textarea>
			<button name="Submit" class="btn btn-primary" type="submit">Agregar Comentario</button>
	</fieldset>
	</form>
	
	<?php echo validation_errors('<div class="alert alert-dismissible alert-danger">', '</div>'); ?>

	</div>
</div>
</div>
</div>
