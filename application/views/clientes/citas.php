<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas </title>
    <link rel="icon" href="<?php echo base_url(); ?>public/img/theme/logo2.ico" type="image/ico" /> 
    <link id="pagestyle" href="<?php echo base_url(); ?>public/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/fontawesome/css/fontawesome.css">
	<link href="<?php echo base_url(); ?>public/fontawesome/css/brands.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/fontawesome/css/solid.css" rel="stylesheet">
  
</head>
<body>

    <body style="background-color:#6AD5B9;">
    </body>

    <div class="container" id="pagina_principal">
    <div class="row align-items-start">
    <div class="d-flex px-2 py-1 align-items-center">
    <div>
    <br>
      <img src="<?php echo base_url(); ?>public/img/theme/logo1.png" width="120px;" class="img-fluid mb-3">
    </div>
    </div>
    <div class="row">
        <div class="jumbotron bloque_index" style="margin-bottom:0px">
          <br><br>
            <h1 class="titulo_index">La forma más rápida<br />de <strong>reservar tu cita</strong></h1>
            <hr size=3px color="#D91F16" >
        </div>
        <div class="col-md-12">
    <form class="row g-3">
  <div class="col-md-3">
    <select class="form-select" aria-label="Default select example">
            <option selected>DNI</option>
            <option value="1">Carné de Extranjería</option>
            <option value="2">Pasaporte</option>  
    </select>
  </div>
  <div class="col-md-3">
    <input type="" class="form-control" id="centro" placeholder="Ingrese N° de documento" >
  </div>
  <div class="col-md-4">
    <button type="submit" class="btn btn-primary mb-3">Reservar tu cita</button>
  </div>
  </form>
  <br><br><br><br><br>
     <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="https://cdn.pixabay.com/photo/2020/03/30/09/15/corona-4983590__340.jpg" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Nuevo Paciente </h5>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                  <label for="">DNI</label>
                  <input type="text" class="form-control ">
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                  <label for="">Nombres Completos</label>
                  <input type="text" class="form-control ">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                  <label for="">Celular</label>
                  <input type="text" class="form-control ">
                </div>
            </div>
            <div class="col-md-7">
            <div class="form-group">
                  <label for="">Sexo</label>
            <select class="form-select" aria-label="Default select example">
                  <option value="1">Femenino</option>
                  <option value="2">Masculino</option>
            </select>
            </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
          

  <script src="<?php echo base_url(); ?>public/js/core/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/core/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/plugins/chartjs.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/argon-dashboard.min.js?v=2.0.2"></script>
</body>
</html>