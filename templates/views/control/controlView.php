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

    <form action="" id="frmControl">
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
               <!--  <li class="pillArea active" id="corte"><a href="#"><i class="fa fa-file-text-o"></i> Corte<span class="label label-primary pull-right">12</span></a></li>
                <li class="pillArea" id="router"><a href="#"><i class="fa fa-file-text-o"></i> Router</a></li>
                <li class="pillArea" id="pulido_banda"><a href="#"><i class="fa fa-file-text-o"></i> Pulido de banda</a></li>
                <li class="pillArea" id="armado"><a href="#"><i class="fa fa-file-text-o"></i> Armado <span class="label label-warning pull-right">65</span></a></li>
                <li class="pillArea" id="pulido"><a href="#"><i class="fa fa-file-text-o"></i> Pulido</a></li>
                <li class="pillArea" id="detalle"><a href="#"><i class="fa fa-file-text-o"></i> Detalle</a></li>
                <li class="pillArea" id="pintura"><a href="#"><i class="fa fa-file-text-o"></i> Pintura</a></li>
                <li class="pillArea" id="laca"><a href="#"><i class="fa fa-file-text-o"></i> Laca</a></li>
                <li class="pillArea" id="frentes_cajones"><a href="#"><i class="fa fa-file-text-o"></i> Frentes y cajones</a></li>
                <li class="pillArea" id="melamina"><a href="#"><i class="fa fa-file-text-o"></i> Melamina</a></li> -->
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
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
                                <option value="emp1">Empleado 1</option>
                                <option value="emp2">Empleado 2</option>
                                <option value="emp3">Empleado 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <label for="capacidad">Capacidad</label>
                            <select class="form-control" name="capacidad" id="capacidad">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                            </select>
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

                            
                            <div id="labels" > <!-- style="margin-top: -13px !important;" -->
                              
<!-- <form action="" class="form-inline frm">
  <div class="fila-uno">
    <div class="form-group in">
      <label for="cabecera" class="lbls">Cabecera</label>
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
    </div>
  </div>
  
  <div class="fila-dos">
    <div class="form-group in">
      <label for="tocador" class="lbls">Tocador</label>
      <input type="text" name="tocador" id="tocador" class="form-control por">
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
    </div>
  </div>

  <div class="fila-tres">
    <div class="form-group in">
      <label for="buro" class="lbls">Buro</label>
      <input type="text" name="buro" id="buro" class="form-control por">
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
    </div>
  </div>

  <div class="fila-cuatro">
    <div class="form-group in">
      <label for="luna" class="lbls">Luna</label>
      <input type="text" name="luna" id="luna" class="form-control por">
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
      <input type="text" name="cabecera" id="cabecera" class="form-control por">
    </div>
  </div>
</form> -->

</form>


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
 
              <!-- <div class="row fila-resultados">
                <div class="col-xs-1">
                <label for="">Puntos</label>
                  <input type="text" class="form-control" disabled>
                </div>
                <div class="col-xs-1">
                  <label for="">Porcentaje</label>
                  <input type="text" class="form-control" disabled>
                </div>
              </div> -->

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
                                      <th>Nombre</th>
                                      <th>Fecha</th>
                                      <th>Area</th>
                                      <th>Producto</th>
                                      <th>Descripción</th>
                                      <th>Puntos</th>
                                      <th>Porcentaje</th>
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