<!-- Modal -->
<div class="modal fade" id="formUsuario" tabindex="-1" role="dialog" aria-labelledby="formUsuario" aria-hidden="true">
  
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="TituloModal">Formulario de usuario</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        
        <!--  contenido -->

        <div>
          <label>
            Identificacion: <input type="text" class="form-control text-info" ng-model="myUser.persona_identificacion" placeholder="Ej: Crear producto">
          </label>

          <label>
            Nombres: <input type="text" class="form-control text-info" ng-model="myUser.nombres" placeholder="Ej: Crear producto">
          </label>

          <label>
            Apellidos: <input type="text" class="form-control text-info" ng-model="myUser.apellidos" placeholder="Ej: Crear producto">
          </label>  

          <label>
            Correo: <input type="text" class="form-control text-info" ng-model="myUser.correo" placeholder="Ej: Crear producto">
          </label>  

          <label>
            C.O. / Oficina: <input type="text" class="form-control text-info" ng-model="myUser.base_idbase" placeholder="Ej: Crear producto">
          </label>   

          <label>
            Estado: 
            <select ng-model="myUser.estado">
              <option value="1">activo</option>
              <option value="0">No activo</option>
            </select> 
          </label>          


          <label>
            Rol: 
            <select ng-model="myUser.rol_idrol" ng-options="r.idrol as (r.nombre_rol+' '+r.grupo) group by r.grupo for r in roles">
            </select>
          </label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="myUser = {}">Close</button>
        <button type="button" 
            class="btn btn-success" 
            ng-click="save('<?= site_url('usuario/save') ?>', '#formUsuario', '<?= site_url('usuario/getAll') ?>' );" 
            ng-disabled="!myUser.persona_identificacion">
          Guardar
        </button>
      </div>

    </div>
  </div>

</div>