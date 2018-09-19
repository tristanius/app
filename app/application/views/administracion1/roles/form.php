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
            Grupo: <input type="text" class="form-control text-info" ng-model="rolForm.grupo" placeholder="Ej: Facturación">
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
        </div>
        <br><hr>

        <fieldset class="padding1ex">

          <h5>Lista de permisos y privilegios del rol</h5>

          Añadir privilegio:
          <select ng-model="privilegioAdd" ng-options="p as (p.idprivilegio+'. '+p.nombre_privilegio+' - '+p.codigo_privilegio) group by p.nombre_gestion for p in privilegios">
          </select>
          <button type="button" class="btn btn-primary" ng-click="addPrivilegioRol(rolForm, privilegioAdd)">Añadir</button>

          <div style="max-height: 600px; overflow: auto;">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>codigo</th>
                  <th>gestion</th>
                  <th></th>
                </tr>
                <tr>
                  <th> <input type="" ng-model="subFilterPriv.idprivilegio"> </th>
                  <th> <input type="" ng-model="subFilterPriv.nombre_privilegio"> </th>
                  <th> <input type="" ng-model="subFilterPriv.codigo_privilegio"> </th>
                  <th> <input type="" ng-model="subFilterPriv.nombre_gestion"> </th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="pr in rolForm.privilegios | filter: subFilterPriv">
                  <td ng-bind="pr.idprivilegio"></td>
                  <td ng-bind="pr.nombre_privilegio"></td>
                  <td ng-bind="pr.codigo_privilegio"></td>
                  <td ng-bind="pr.nombre_gestion"></td>
                  <td>
                    <button class="btn btn-danger" ng-click="deletePrivRol('<?= site_url('rol/del_priv_rol') ?>', pr)">X</button> 
                  </td>
                </tr>            
              </tbody>
            </table>  
          </div>        

        </fieldset>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="rolForm = {privilegios:[]}; subFilterPriv = {}">Close</button>
        <button type="button" 
            class="btn btn-success" 
            ng-click="save('<?= site_url('rol/save') ?>', '#formRol', '<?= site_url('rol/getAll') ?>' );" 
            ng-disabled="!rolForm.nombre_rol">
          Guardar
        </button>
      </div>

    </div>
  </div>

</div>