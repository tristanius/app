<!-- Modal -->
<div class="modal fade" id="formGestion" tabindex="-1" role="dialog" aria-labelledby="formGestion" aria-hidden="true">
  
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="TituloModal">Formulario de gestiones</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        
        <!--  contenido -->

        <label>
          Descripcion de la gestion: <input type="text" class="form-control text-info" ng-model="gestion.descripcion_gestion" placeholder="Ej: Crear producto">
        </label>

        <label>
          Codigo de la gestion: <input type="text" class="form-control text-info" ng-model="gestion.nombre_gestion" placeholder="Ej: COD02">
        </label>

        <label>
          Gestion: 
          <select class="form-control  text-info" ng-model="gestion.nombre_app" ng-options="app.nombre_app as app.nombre_app for app in apps">
            
          </select>
        </label>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="gestion = undefined">Close</button>
        <button type="button" 
            class="btn btn-success" 
            ng-click="save('<?= site_url('gestion/save') ?>', gestion, '#formGestion', '<?= site_url('gestion/getAll') ?>' );" 
            ng-disabled="!gestion.descripcion_gestion && !gestion.nombre_gestion && !gestion.nombre_app">
          Guardar
        </button>
      </div>

    </div>
  </div>

</div>