<?php require_once INCLUDES.'inc_header.php'; ?>
<?php require_once MODALS.'userModal.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require_once INCLUDES.'inc_nav_header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $d->title; ?>
        <small>Panel de control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $d->title; ?></li>
      </ol>
    </section>

    <!-- <form action="" id="frmControl"> -->
   <!-- Main content -->
   <section class="content">
      <div class="row">
        <div class="col-md-2">
          <!-- <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a> -->

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Areas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding divAreas">
              <ul class="nav nav-pills nav-stacked areas" id="areas">
              
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Varios</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Varios</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Vacaciones</a></li>
                <!-- <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li> -->
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-10">
          
        <div class="row">       
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Productos</h3>
                </div>
                
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                          <input type="hidden" id="id" name="id" value="">
                          <input type="hidden" id="nrep" name="nrep" value="">
                              <label>Fecha:</label>
                              <div class="input-group date">
                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                              <input type="text" class="form-control pull-right" id="datepicker" autocomplete="off">
                              </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                                <label>Empleado</label>
                                <select class="form-control select2" style="width: 100%;" name="empleado" id="empleado" multiple="multiple">
                                
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1">
                          
                            <div class="form-group">
                              <label for="capacidad">Capacidad</label>
                              <input type="text" class="form-control" id="capacidad" name="capacidad" value="1" readonly>
                            </div>
                        </div>

                        <div class="col-md-1" id="reporte__num">
                          <div class="form-group">
                            <label for="nreporte">N° reporte</label>
                            <input type="text" class="form-control" id="nreporte" name="nreporte" readonly>
                          </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                          <div class="form-group">
                              <label>Nombre</label>
                              <select class="form-control select2" style="width: 100%;" name="nombres" id="nombres" onchange="change_prod()">
                              <option selected disabled value="0">Seleccione una opcion...</option>
                              </select>
                          </div>
                        </div>

                    </div>

                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <div class="box box-primary">
                        <div class="box-header box-header-sec">
                          <div class="box-body">

            <!-- </form> -->

                  <div id="labels" >


                              <div class="grid-body">

                                <div class="col-uno" id="col-uno">
                                    
                                  

                                </div>



                                <div class="col-dos">
                                  <div class="form-group">
                                    <label for="totalpuntos">Total Puntos</label>
                                    <input type="text" class="form-control" id="totalPunto" disabled>
                                  </div>
                                  <div class="form-group">
                                    <label for="totalpuntos">Total Porcentaje</label>
                                    <input type="text" class="form-control" id="totalPorcentaje" disabled>
                                  </div>
                                </div>

                              </div>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="box-body">

                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group btn-calcular-porc" style="display:inline-block; padding-right: 2rem;">
                        <button type="button" class="btn btn-block btn-primary" name="btnCalcular" id="btnCalcular">Calcular</button>
                      </div>
                      <div class="form-group" style="display:inline-block;">
                        <button type="button" class="btn btn-block btn-primary" name="btnSave" id="btnSave">Guardar</button>
                      </div>
                    </div>
                  </div>
                  </div>


                    <div class="row">
                        <div class="col-sm-12">
                        <div class="new_user">
                          <!-- <button type="button" class="btn btn-primary" onclick="openModal();"> <i class="fa fa-plus-circle"></i> Nuevo</button> -->
                        </div>
                        
                            <div class="table-responsive">
                              <table id="tableUser" class="table table-bordered table-hover dataTable hover" role="grid">
                                  <thead>
                                      <tr role="row">
                                      <th>N°</th>
                                      <th>N° reporte</th>
                                      <th>Nombre</th>
                                      <th>Fecha</th>
                                      <th>Area</th>
                                      <th>Producto</th>
                                      <th>Descripción</th>
                                      <th>Puntos</th>
                                      <th>Porcentaje</th>
                                      <th>Acciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      
                                  </tbody>
                              </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      </div>


        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->

 
  <?php require_once INCLUDES.'inc_fooder_copy.php'; ?>
  <?php require_once INCLUDES.'inc_footer.php'; ?>