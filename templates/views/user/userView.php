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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    
    <section class="content">
      
      <div class="row">       
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">usuarios</h3>
                </div>
                
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="new_user">
                          <button type="button" class="btn btn-primary" onclick="openModal();"> <i class="fa fa-plus-circle"></i> Nuevo</button>
                        </div>
                        
                            <table id="tableUser" class="table table-bordered table-hover dataTable hover" role="grid">
                                <thead>
                                    <tr role="row">
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Acción</th>
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
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
  <?php require_once INCLUDES.'inc_fooder_copy.php'; ?>
  <?php require_once INCLUDES.'inc_footer.php'; ?>