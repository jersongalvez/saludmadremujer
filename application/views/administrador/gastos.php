<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Administracion / Gastos</title>
      <?php require_once("componentes/head.php"); ?>
   </head>
   <body class="g-sidenav-show bg-gray-100">
      <div class="min-height-300 bg-default position-absolute w-100"></div>
      <?php require_once("componentes/menu.php"); ?>
      <main class="main-content position-relative border-radius-lg">
         <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                     <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Administración</a></li>
                     <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gastos</li>
                  </ol>
                  <h6 class="font-weight-bolder text-white mb-0">Gastos</h6>
               </nav>
               <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                  <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                     <div class="input-group">
                     </div>
                  </div>
                  <ul class="navbar-nav  justify-content-end">
                     <li class="nav-item d-flex align-items-center">
                        <a href="<?php echo base_url(); ?>cerrarsesion" class="nav-link text-white font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Cerrar Sesión</span>
                        </a>
                     </li>
                     <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                           <div class="sidenav-toggler-inner">
                              <i class="sidenav-toggler-line bg-white"></i>
                              <i class="sidenav-toggler-line bg-white"></i>
                              <i class="sidenav-toggler-line bg-white"></i>
                           </div>
                        </a>
                     </li>
                     <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                     </li>
                     <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                           <li class="mb-2">
                              <a class="dropdown-item border-radius-md" href="javascript:;">
                                 <div class="d-flex py-1">
                                    <div class="my-auto">
                                       <img src="<?php echo base_url();?>img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                       <h6 class="text-sm font-weight-normal mb-1">
                                          <span class="font-weight-bold">New message</span> from Laur
                                       </h6>
                                       <p class="text-xs text-dark mb-0">
                                          <i class="fa fa-clock me-1"></i>
                                          13 minutes ago
                                       </p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="mb-2">
                              <a class="dropdown-item border-radius-md" href="javascript:;">
                                 <div class="d-flex py-1">
                                    <div class="my-auto">
                                       <img src="<?php echo base_url();?>public/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                       <h6 class="text-sm font-weight-normal mb-1">
                                          <span class="font-weight-bold">New album</span> by Travis Scott
                                       </h6>
                                       <p class="text-xs text-dark mb-0">
                                          <i class="fa fa-clock me-1"></i>
                                          1 day
                                       </p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item border-radius-md" href="javascript:;">
                                 <div class="d-flex py-1">
                                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                       <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                          <title>credit-card</title>
                                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                             <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                   <g transform="translate(453.000000, 454.000000)">
                                                      <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                                      <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                                   </g>
                                                </g>
                                             </g>
                                          </g>
                                       </svg>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                       <h6 class="text-sm font-weight-normal mb-1">
                                          Payment successfully completed
                                       </h6>
                                       <p class="text-xs text-dark mb-0">
                                          <i class="fa fa-clock me-1"></i>
                                          2 days
                                       </p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
         <!-- End Navbar -->
         <div class="container-fluid py-5">
         <div class="row ">
            <div class="card">
               <div class="row mt-4">
                  <div class="col-md-12">
                     <a class="btn bg-gradient-danger btn-xs" data-bs-toggle="modal" href="#AgregarCPE" id="btn_AddGasto" role="button">Agregar <i class="fas fa-plus"></i> </a>
                  </div>
               </div>
               <br>  
               <div class="table-responsive" >
                  <table class="table align-items-center table-borderless mb-0 text-uppercase" id="table-gastos">
                     <thead>
                        <tr>
                           <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-12" ></th>
                           <!--th class="text-uppercase text-dark text-xs font-weight-bolder opacity-12" >Estado CPE</th-->
                           <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-12" >Comprobante</th>
                           <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-12" >Razón Social</th>
                           <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-12" >Descripción</th>
                           <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-12" >Fe.Recepción</th>
                           <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-12" >Colaborador</th>
                           <!--th class="text-uppercase text-dark text-xs font-weight-bolder opacity-12" ></th-->
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($gastos->result() as $gastoss){ ?>
                        <tr>
                           <td>
                              <div class="row" style="padding-right:10px;">
                                 <a  
                                    class="icon icon-shape icon-sm me-1 bg-gradient-info shadow mx-3"
                                    onclick="editarCPE(<?php echo $gastoss->iddoc_cpe; ?>);"
                                    >
                                 <i class="fas fa-pencil-alt text-white opacity-10"></i>
                                 </a>
                              </div>
                           </td>
                           <!--td>
                              <div class="row">
                                 <a 
                                    style="cursor: pointer;" class="icon icon-shape icon-sm  <?php if($gastoss->estado==0){ echo " bg-gradient-success ";}else{ echo " bg-gradient-secondary ";} ?> shadow" title="Recepcionado"
                                    >
                                 <i class="fas <?php if($gastoss->estado==0){ echo " fa-check ";}else if($gastoss->estado>=0){ echo " fa-check-square ";}else{ echo " fa-square ";} ?> text-white opacity-10"></i>
                                 </a>
                                 <a 
                                    style="cursor: pointer;" class="icon icon-shape icon-sm  <?php if($gastoss->estado==1){ echo " bg-gradient-warning ";}else{ echo " bg-gradient-secondary ";} ?> shadow" title="Reportado"
                                    >
                                    <i class="fas <?php if($gastoss->estado==1){ echo " fa-check ";}else if($gastoss->estado>=1){ echo " fa-check-square ";}else{ echo " fa-square ";} ?> text-white opacity-10"></i>
                                 </a>
                                 <a 
                                    style="cursor: pointer;" class="icon icon-shape icon-sm  <?php if($gastoss->estado==2){ echo " bg-gradient-success ";}else{ echo " bg-gradient-secondary ";} ?> shadow" title="Tributado"
                                    >
                                 <i class="fas <?php if($gastoss->estado==2){ echo " fa-check ";}else if($gastoss->estado>=2){ echo " fa-check-square ";}else{ echo " fa-square ";} ?> text-white opacity-10"></i>
                                 </a>
                              </div>
                           </td-->
                           <td class="text-xs text-dark mb-0"><?php echo $gastoss->comprobante." ".$gastoss->monto_v2; ?></td>
                           <td class="text-xs text-dark mb-0"><?php echo $gastoss->razon_social; ?></td>
                           <td class="text-xs text-dark mb-0"><?php echo $gastoss->descripcion; ?></td>
                           <td class="text-xs text-dark mb-0"><?php echo $gastoss->f_recepcion; ?></td>
                           <td class="text-xs text-dark mb-0"><?php echo $gastoss->nombre." ".$gastoss->apellido; ?></td>
                           <!--td class="text-xs text-dark mb-0"><?php echo $gastoss->estado; ?></td-->
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <br>
               </div>
            </div>
            <?php require_once("componentes/footer.php"); ?>
         </div>
         <div class="modal fade" id="AgregarCPE" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-xl" role="document">
               <form class="modal-content" id="AddGasto">
                  <div class="modal-header">
                     <h5 class="modal-title text-uppercase" id="exampleModalLabel">Registrar Gasto</h5>
                     <button type="button" class=" close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <h6>
                                       <strong>Información del Comprobante</strong>
                                    </h6>
                                    <div class="dropdown-divider"></div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>Tipo Comprobante
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <select name="cpe_tipo" id="cpe_tipo" class="form-control" required>
                                          <option value="">Seleccionar</option>
                                          <option value="3">Boleta</option>
                                          <option value="1">Factura</option>
                                          <option value="2">RHE</option>
                                          <!--option value="7">Nota de Credito</option-->
                                          <!--option value="8">Nota de Debito</option-->
                                          <option value="12">Maq.Ticketera</option>
                                          <option value="13">Doc.Ins.Financieras</option>
                                          <option value="14">Recibos Servicios Publicos</option>
                                          <option value="9001">Otras Facturas</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>Nro. Serie
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <input type="text" name="statee" id="statee" style="display: none;" >
                                       <input type="text" name="idgastos" id="idgastos" style="display: none;" >
                                       <input type="text" name="cpe_serie" id="cpe_serie" maxlength="4" minlength="4" class="form-control text-uppercase" required data-validation-required-message="Complete el Numero">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>Nro. Correlativo
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <input type="text" name="cpe_numero" id="cpe_numero" minlength="1" maxlength="8" class="s_n form-control" required data-validation-required-message="Complete el Numero">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>Op. Gravada
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <input type="number" require step="0.01" name="cpe_gravada" id="cpe_gravada" maxlength="8" minlength="1" class="form-control" required data-validation-required-message="Complete el Numero">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>IGV
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <input type="number" require step="0.01" name="cpe_igv" id="cpe_igv" maxlength="8" minlength="1" class="form-control" required data-validation-required-message="Complete el Numero">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>Total *
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <input type="number" step="0.01" name="cpe_total" id="cpe_total" maxlength="8" minlength="1" class="form-control" required data-validation-required-message="Complete el Numero">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>Fe.Emisión
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <input name="f_emision" id="f_emision" type="date" class="form-control _date" required>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>Fe.Recepción
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <input name="f_recepcion" id="f_recepcion" type="date" class="form-control _date" required>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <h6>Detalle / Descripción<span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <textarea name="descripcion" id="descripcion" cols="5" rows="5" class="form-control" style="resize: none;"  maxlength="100"></textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <h6>
                                       <strong>Información del Proveedor</strong>
                                    </h6>
                                    <div class="dropdown-divider"></div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <h6>Tipo</h6>
                                    <div class="controls" class="for">
                                       <select name="prov_tipo_doc" id="prov_tipo_doc" required class="form-control manual">
                                          <option value="6" selected>RUC</option>
                                          <!--option value="1">DNI / Lib.Elect.</option-->
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group input-group-sm">
                                    <h6>N° Documento</h6>
                                    <div class="input-group">
                                       <input type="text" name="prov_nro_doc" id="prov_nro_doc" class="form-control" required data-validation-required-message="Complete el Numero" length="11" min="10000000001">
                                       <div class="input-group-append">
                                          <button type="button" style="padding: 5px;" class="btn btn-primary" id="prov_btn_buscar"><i class="fa fa-search"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <h6>Razón Social
                                       <span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <input type="text" name="prov_razon_social" id="prov_razon_social" maxlength="100" class="form-control" required data-validation-required-message="Complete el Numero" >
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <h6>
                                       <strong>Información del Colaborador Responsable</strong>
                                    </h6>
                                    <hr>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <h6>Responsable<span class="required">*</span>
                                    </h6>
                                    <div class="controls">
                                       <select required name="codigo_usuario" id="codigo_usuario" class="form-control" >
                                          <option value="">Seleccionar Colaborador</option>
                                          <?php foreach($users->result() as $users){ ?>
                                             <option value="<?php echo $users->codigo_usuario; ?>"><?php echo $users->nombre.' '.$users->apellido; ?></td>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
               </form>
            </div>
         </div>
      </main>
      <?php require_once("componentes/personalizar.php"); ?>
      <!-- LARGE MODAL -->
      <?php require_once("componentes/scripts.php"); ?>
      <script src="<?php echo base_url(); ?>public/js/scripts/gastos.js"></script>
   </body>
</html>