<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form</title>
     <!--link the bootstrap css file-->
     <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/simplex/bootstrap.min.css" rel="stylesheet">
     
     <style type="text/css">
	.panel-heading {
          padding: 5px 15px;
	}
	.panel-footer {
	 padding: 1px 15px;
	 color: #A0A0A0;
	}
	.profile-img {
	width:152px;
	height:120px;
	margin: 0 auto 10px;
	display:block;
/*	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;*/
	background-image: url('<?php echo base_url().'assets/images/imperio.png';?>');
	}
     </style>
</head>
<body>
<div class="container" style="margin-top:40px">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong> Acceso </strong>
					</div>
					<div class="panel-body">
	<?php $attributes = array("id"=>"loginform", "name"=>"loginform"); ?>
			<?php echo form_open("auth", $attributes); ?>			
			<fieldset>
								<div class="row">
									<div class="center-block">
										<img class="profile-img"
										src="<?php echo base_url().'assets/images/imperio.png';?>" alt="">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control" placeholder="Usuario" name="txt_usuario" id="txt_usuario" value="<?php echo set_value('txt_usuario'); ?>" type="text" autofocus>
																						</div>
										</div><span class="text-danger"><?php echo form_error('txt_usuario'); ?></span>	
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control" placeholder="Password" id="txt_passwd" name="txt_passwd" type="password" value="<?php echo set_value('txt_passwd'); ?>">
																							</div>
										</div>
										<span class="text-danger"><?php echo form_error('txt_passwd'); ?></span>

										<div class="form-group">
	<input type="submit" id="btn_login" name="btn_login" class="btn btn-lg btn-primary btn-block" value="Ingresar">
										</div>
									</div>
								</div>
							</fieldset>
<?php echo form_close(); ?>
					</div>
					<div class="panel-footer "> &copy 2016 
<?php echo $this->session->flashdata('msg'); ?>					</div>
                </div>
			</div>
		</div>
	</div>
</body>
</html>
