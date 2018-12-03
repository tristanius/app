<section id="formUserRol"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="formUsuario" aria-hidden="true">
	<h5>Asinacion de rol al usuario: {{ myuser.identificacion }}</h5>
	<fieldset>
		<label>
			Rol Asignar: 
		</label>
		<select ng-model="formRol" ng-options="r as r.nombre_rol for r in roles">
		</select>

		<button ng-class="asignarRol(myuser, formRol, '<?= site_url('usuario/save'); ?>')">Asignaro rol</button>
	</fieldset>
</section>