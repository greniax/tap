<html>
	<head>
		<title>Plan de Correciones, Acciones Preventivas y Correctivas</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include ('cdn.php'); ?>
	</head>
<body>
<!-- ########### Navbar ############-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url().'/'; ?>"><span class="glyphicon glyphicon-home"></span></a>  </div>

    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-2" aria-expanded="true">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Dashboard<span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo site_url().'/consulta'; ?>">Consultas</a></li>
<?php	if ($this->session->operador == 1 ) { ?>
	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Catalogo<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
	  <li><a href="<?php echo site_url().'/users'; ?>"><span class="glyphicon glyphicon-user" style="right:13px;"></span> Usuarios</a><i class="fa fa-home fa-2x fa-fw"></i></li>
            <li><a href="<?php echo site_url().'/puestos'; ?>"><span class="glyphicon glyphicon-briefcase" style="right:13px;"></span> Perfiles/Puestos</a></li>
            <li><a href="<?php echo site_url().'/origen'; ?>"><span class="glyphicon glyphicon-pushpin" style="right:13px;"></span> Origen</a></li>
            <li class="divider"></li>
            <li><a href="#"><span class="glyphicon glyphicon-wrench" style="right:13px;"></span>Parametros</a></li>
            <li class="divider"></li>
            <li><a href="#"><span class="glyphicon glyphicon-cog" style="right:13px;"></span> General</a></li>
	  </ul>
<?php } ?>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Buscar">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
      <li class="active"><span class="sr-only">(current)</span><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->usuario.' - '. $this->session->operador; ?></a></li>
      <li><a href="<?php echo site_url().'/auth/logout';?>"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
	<h1><?php $title; ?></h1>
<?php echo generaBreadcrumb(); ?>
