<?php $attributes = array ('class' => 'form-horizontal'); ?>
<div class="row">
	<div class="col-lg-10">
		<div class="page-header">
			<h1 id="adduser">Agregar Usuario</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-md-4">

<?php echo form_open('users/adduser', $attributes); ?>
	<fieldset>
		<legend> Nuevo Usuario </legend>

			<div class="form-group">
			  <label for="nombre" class="col-md-2 control-label">Nombre</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo">
			</div>
			</div>
		
			<div class="form-group">
			  <label for="paterno" class="col-md-2 control-label">Paterno</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="paterno" name="paterno" placeholder="Apellido Paterno">
			</div>
			</div>
		
			<div class="form-group">
			  <label for="materno" class="col-md-2 control-label">Materno</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="materno" name="materno" placeholder="Apellido Materno">
			</div>
			</div>
		
			<div class="form-group">
			  <label for="usuario" class="col-md-2 control-label">Usuario</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
			</div>
			</div>
		
			<div class="form-group">
			  <label for="passwd" class="col-md-2 control-label">Password</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="passwd" name="passwd" placeholder="Password de Usuario">
			</div>
			</div>
		
			<div class="form-group">
			  <label for="email" class="col-md-2 control-label">Email</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" id="email" name="email" placeholder=" @grupoautofin.com">
			</div>
			</div>
		
			<div class="form-group">
			  <label for="puesto" class="col-md-2 control-label">Puesto / Perfil</label>
			<div class="col-lg-10">

				<select name="puesto" class="form-control"/>
				<option value="0">Puestos / Perfiles</option><br />
				<?php foreach ($puestos as $row)
				{
				echo '<option value="'.$row['puesto'].'">'.$row['puesto'].'</option><br />';
				}
				?>
				</select>
			</div>
			</div>

			<div class="form-group">
      				<label class="col-md-2 control-label">Operador</label>
				<div class="col-lg-10">
					<div class="radio">
						<label>
							<input type="radio" name="operador" id="operador" value="1" checked=""> Si
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="operador" id="operador" value="0">No
						</label>
					</div>
				</div>
			</div>	

		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
				<button class="btn btn-default" type="reset">Borrar </button>
				<button class="btn btn-primary" type="submit">Agregar Usuario</button>
			</div>
		</div>

		</fieldset>
	</form>
	</div>
	<div class="col-lg-4 col-md-2">
	<?php echo validation_errors('<div class="alert alert-dismissible alert-danger">', '</div>'); ?>
	</div>

</div>

