<!-- Modal -->
<div class="modal fade" id="formPrivilegio" tabindex="-1" role="dialog" aria-labelledby="formPrivilegio" aria-hidden="true">
  
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="TituloModal">Formulario de privilegio</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        
        <!--  contenido -->

        <label>
          Nombre del privilegio: <input type="text" class="form-control text-info" ng-model="priv.nombre_privilegio" placeholder="Ej: Crear producto">
        </label>

        <label>
          Codigo del privilegio: <input type="text" class="form-control text-info" ng-model="priv.codigo_privilegio" placeholder="Ej: COD02">
        </label>

        <label>
          Gestion: 
          <select class="form-control  text-info" ng-model="priv.gestion_idgestion" ng-options="g.idgestion  as g.nombre_gestion+' - ('+g.nombre_app+')' group by p.nombre_gestion  for g in gestiones">
            
          </select>
        </label>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="priv = undefined">Close</button>
        <button type="button" 
            class="btn btn-success" 
            ng-click="save('<?= site_url('privilegio/save') ?>', priv, '#formPrivilegio', '<?= site_url('privilegio/getAll') ?>' );" 
            ng-disabled="!priv.nombre_privilegio && !priv.codigo_privilegio && !priv.gestion_idgestion">
          Guardar
        </button>
      </div>

    </div>
  </div>

</div>