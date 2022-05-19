<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion / Triaje</title>
    <?php require("componentes/head.php"); ?>

</head>
<body>
  <?php require_once("componentes/menu.php"); ?>
  <div class="main-content" id="panel">
    <!-- Header -->
    <!-- Header -->
    <div class="header color-cyan pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
            </div>
          </div>
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <!-- <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6> -->
                  <h3 class="h2 mb-0">Doctor <?php echo $this->session->userdata("nombre")." ".$this->session->userdata("apellido"); ?></h3> 
                </div>
                <div class="col">
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table align-items-center " id="table-triaje">
                <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="name">Opciones</th>
                    <th scope="col" class="sort" data-sort="name">DNI</th>
                    <th scope="col" class="sort" data-sort="name">HC</th>
                    <th scope="col" class="sort" data-sort="name">Apellido</th>
                    <th scope="col" class="sort" data-sort="name">Nombre</th>
                    <th scope="col" class="sort" data-sort="name">Dirección</th>
                    <th scope="col" class="sort" data-sort="name">Telefono</th>
                    <th scope="col" class="sort" data-sort="budget">Especialidad</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($paciente->result() as $pacientes){ ?>
                    <tr>
                        <td><a href="<?php echo base_url(); ?>administracion/cambiarestadomedico/<?php echo $pacientes->codigo_atencion; ?>" title="pasar a triaje" class="btn btn-success btn-sm"> <li class="fas fa-check"></li> </a><a href="<?php echo base_url(); ?>administracion/historia/<?php echo $pacientes->documento ?>" type="button" class="btn btn-danger btn-sm" title="Historias"> <li class="fas fa-folder-open"></li> </a></td>
                        <td><?php echo $pacientes->documento; ?></td>
                        <td><?php echo $pacientes->hc; ?></td>
                        <td><?php echo $pacientes->apellido; ?></td>
                        <td><?php echo $pacientes->paciente; ?></td>
                        <td><?php echo $pacientes->direccion; ?></td>
                        <td><?php echo $pacientes->telefono; ?></td>
                        <td><?php echo $pacientes->descripcion; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require_once("componentes/footer.php"); ?>
    </div>
  </div>
  <?php require("componentes/scripts.php"); ?>


</body>
</html>