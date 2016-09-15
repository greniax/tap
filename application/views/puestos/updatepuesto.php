<?php
	echo '<div class="alert alert-info">'. $puestos['id'].'</div>';
	$attributes = array ('class'=> 'form-horizontal');
?>
<div class="row">
	<div class="col-lg-10">
		<div class="page-header">
			<h1 id="updatepuesto">Actualizar Puesto/Perfil</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-md-4">
<?php echo form_open('puestos/updatepuesto/'.$puestos['id'], $attributes); ?>
		<fieldset>
			<legend> Actualizar Puesto / Perfil </legend>
			<div class="form-group">
			  <label for="puesto" class="col-md-2 control-label">Puesto / Perfil</label>
			<div class="col-lg-10">
			<input type="text" class="form-control" id="puesto" name="puesto" placeholder="Puesto / Perfil" value="<?php echo set_value('puesto' ,$puestos['puesto']); ?>">
			</div>
			</div>

		<div class="form-group">
				<label for="descripcion" class="col-md-2 control-label">Descripción</label>
			<div class="col-lg-10">
			<input type="text"  class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del Puesto / Perfil" value="<?php echo set_value('descripcion', $puestos['descripcion']); ?>" />
			</div>
		</div>
	<div class="form-group">	
	<label for="depto" class="col-md-2 control-label">Departamento </label>
	<div class="col-lg-10">
	<select class="control-form" id="depto" name="depto" />
		<option value="0">-- Selecciona --</option><br />
		<option value="1">Administracion</option><br />
		<option value="2">Servicio</option><br />
		<option value="3">Ventas</option><br />
		<option value="4">Refacciones</option><br />
		<option value="5">Seminuevos</option><br />

	</select>
	</div>
	</div>
	
	<div class="form-group">
      				<label class="col-md-2 control-label">Activo</label>
				<div class="col-lg-10">
					<div class="radio">
						<label>
						<input type="radio" name="activo" id="activo" value="1" <?php if (set_value('activo', $puestos['activo']) == 1) echo 'checked="checked"'; ?>> Si
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="activo" id="activo" value="0"<?php if (set_value('activo', $puestos['activo']) == 0) echo 'checked="checked"'; ?>>No
						</label>
					</div>
				</div>
			</div>	


		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
				<button class="btn btn-default" type="reset">Borrar </button>
				<button class="btn btn-primary" type="submit">Actualizar Puesto/Perfil</button>
			</div>
		</div>

		</fieldset>
	</form>
	</div>
	<div class="col-lg-4 col-md-2">
	<?php echo validation_errors('<div class="alert alert-dismissible alert-danger">', '</div>'); ?>
	</div>

</div>
