 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="titleModal">Usuario</h4>
        </div>
        <div class="modal-body">
        
            <form class="form-horizontal" id="form_user">
            <input type="hidden" id="idUsr" name="idUsr" value="">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                  </div>
                </div>

                <div class="form-group">
                  <label for="usuario" class="col-sm-2 control-label">Usuario</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                  </div>
                </div>                

                <div class="form-group">
                  <label for="clave" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="clave" name="clave" placeholder="Password">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="border-top: 0px">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-primary pull-left" id="actionForm" ><span id="btnText">Guardar</span></button>
                <button type="button" class="btn bg-navy pull-right" data-dismiss="modal"><span>Cerrar</span></button>
              </div>
              <!-- /.box-footer -->
            </form>

        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div> -->
      </div>
      
    </div>
  </div>