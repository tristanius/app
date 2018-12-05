<section id="formUserRol"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="formUsuario" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
		        <h5 class="modal-title" id="TituloModal">Vista de asignacion de roles de usuario</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
		    </div>
			<div class="modal-body">
				<h5>Asinacion de rol al usuario: {{ myUser.identificacion }} - {{ myUser.nombres }} {{ myUser.apellidos }}</h5>
				<fieldset>
					<label>
						Rol Asignar: 
					</label>
					<select ng-model="formRol" ng-options="r as r.nombre_rol for r in roles">
					</select>

					<button ng-click="asignarRol(myUser, formRol, '<?= site_url('usuario/save'); ?>', '#formUserRol')">Asignaro rol</button>
				</fieldset>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="myUser = {}">Close</button>
		    </div>
		</div>
	</div>
</section>