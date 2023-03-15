<?php require_once INCLUDES.'inc_header.php'; ?>

    <!-- <div>
        <h1>Home</h1>
    </div> -->

    
    <body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Control</b>-Sys</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión</p>

    <form action="#" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesion</button>
        </div>
        <!-- /.col -->
      </div>
    </form>    

  </div>
  <!-- /.login-box-body -->
</div>
   

<?php require_once INCLUDES.'inc_footer.php'; ?>
