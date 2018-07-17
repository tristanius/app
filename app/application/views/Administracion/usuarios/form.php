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
            Identificacion: <input type="text" class="form-control text-info" ng-model="user.identificacion" placeholder="Ej: Crear producto">
          </label>


          <label>
            Rol: 
            <select ng-model="user.rol_idrol">
              <option>Seleccione una opcion</option>
            </select>
          </label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="user = {}">Close</button>
        <button type="button" 
            class="btn btn-success" 
            ng-click="save('<?= site_url('usuario/save') ?>', '#formUsuario', '<?= site_url('usuario/getAll') ?>' );" 
            ng-disabled="!user.identificacion">
          Guardar
        </button>
      </div>

    </div>
  </div>

</div>