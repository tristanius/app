<!-- Modal -->
<div class="modal fade" id="formRol" tabindex="-1" role="dialog" aria-labelledby="formRol" aria-hidden="true">
  
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="TituloModal">Formulario de gestiones</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        
        <!--  contenido -->

        <div>
          <label>
            Nombre del Rol: <input type="text" class="form-control text-info" ng-model="rolForm.nombre_rol" placeholder="Ej: Crear producto">
          </label>

          <label>
            Tipo de visualización: 
            <select ng-model="rolForm.tipo_visualizacion">
              <option value="sector">sector</option>
              <option value="base">base</option>
              <option value="contrato">contrato</option>
              <option value="general">general</option>
            </select>
          </label>

          <label>
            Grupo: <input type="text" class="form-control text-info" ng-model="rolForm.grupo" placeholder="Ej: Facturación">
          </label>
        </div>
        <br><hr>

        <fieldset class="padding1ex">

          <h5>Lista de permisos y privilegios del rol</h5>

          Añadir privilegio:
          <select ng-model="privilegioAdd" ng-options="p as (p.idprivilegio+'. '+p.nombre_privilegio+' - '+p.codigo_privilegio) group by p.nombre_gestion for p in privilegios">
          </select>
          <button type="button" class="btn btn-primary" ng-click="addPrivilegioRol(rolForm, privilegioAdd)">Añadir</button>

          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>codigo</th>
                <th>Nombre</th>
                <th>gestion</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="pr in rolform.privilegios">
                <td ng-bind="pr.idprivilegio_has_rol"></td>
                <td ng-bind="pr.codigo_privilegio"></td>
                <td ng-bind="pr.nombre_privilegio"></td>
                <td ng-bind="pr.nombre_gestion"></td>

              </tr>            
            </tbody>
          </table>          

        </fieldset>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="gestion = undefined">Close</button>
        <button type="button" 
            class="btn btn-success" 
            ng-click="save('<?= site_url('rol/save') ?>', gestion, '#formRol', '<?= site_url('rol/getAll') ?>' );" 
            ng-disabled="!rol.nombre_rol">
          Guardar
        </button>
      </div>

    </div>
  </div>

</div>