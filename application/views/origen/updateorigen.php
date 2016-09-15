<?php 
	$attributes = array ('class'=> 'form-horizontal');
?>
<div class="row">
	<div class="col-lg-10">
		<div class="page-header">
			<h1 id="updateorigen">Actualizar Origen</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-md-4">
<?php echo form_open('origen/updateorigen/'. $origen['id'], $attributes); ?>
		<fieldset>
			<legend> Actualizar Origen </legend>
			<div class="form-group">
			  <label for="origen" class="col-md-2 control-label">Origen</label>
		   	 <div class="col-lg-10">
			 <input type="text" class="form-control" id="origen"  name="origen" placeholder="Origen" value="<?php echo set_value('origen', $origen['origen']); ?>">
		   	 </div>
			</div> 
			
			<div class="form-group">
				<label for="descripcion" class="col-md-2 control-label">Descripción</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="descripcion" placeholder="Descripción del Origen" value="<?php echo set_value('descripcion', $origen['descripcion']); ?>" name="descripcion" />
				</div>
			</div>
		
			<div class="form-group">
				<label for="clave" class="col-md-2 control-label">Clave</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="clave" placeholder="Clave Corta del Origen" value="<?php echo set_value('clave', $origen['clave']); ?>" name="clave" disabled />
				</div>
			</div>
		
			<div class="form-group">
      				<label class="col-md-2 control-label">Activo</label>
				<div class="col-lg-10">
					<div class="radio">
						<label>
						<input type="radio" name="activo" id="activo" value="1" <?php if (set_value('activo', $origen['activo']) == 1) echo 'checked="checked"'; ?>> Si
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="activo" id="activo" value="0"<?php if (set_value('activo', $origen['activo']) == 0) echo 'checked="checked"'; ?>>No
						</label>
					</div>
				</div>
			</div>	
	
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
					<button type="reset" class="btn btn-default">Borrar</button>
					<button type="submit" class="btn btn-primary">Actualizar</button>
				</div>
			</div>
		</fieldset>
	</form>
	</div>
	<div class="col-lg-4 col-md-2">
	<?php echo validation_errors('<div class="alert alert-dismissible alert-danger">', '</div>'); ?>
	</div>

</div>
