<section class="padding1ex border" ng-app="admin" ng-controller="roles">
	
	<fieldset class="padding1ex" >
		<legend> <h4> Gestion de roles de usuarios </h4> </legend>

		<button type="button" class="btn btn-primary" ng-click="formRol('#formRol', {} )"> Add. Rol</button>

		<br><br>

		<table  class="table table-bordered table-hover"  ng-init="getPrivilegios('<?= site_url('privilegio/getAll') ?>'); getRoles('<?= site_url('rol/getAll') ?>')">
			<thead class="thead-dark">
				<tr>
					<th>ID</th>
					<th>Rol</th>
					<th>Grupo</th>
					<th>Visualización</th>
					<th data-icon="y"></th>
				</tr>

				<tr>
					<th> </th>
					<th> <input class="form-control" ng-model="filtroRol.nombre_rol" placeholder="Filtro de elementos"> </th>
					<th> <input class="form-control" ng-model="filtroRol.grupo" placeholder="Filtro de elementos"> </th>
					<th></th>
					<th> </th>
				</tr>
			</thead>
			<tbody>

				<tr ng-repeat="r in roles | filter: filtroRol">
					<td ng-bind="r.idrol"></td>
					<td ng-bind="r.nombre_rol"></td>
					<td ng-bind="r.grupo"></td>
					<td ng-bind="r.tipo_visualizacion"></td>
					<td>
						<button type="button" class="btn btn-warning" ng-click="formRol('#formRol', r)"> Modificar</button>
						<button type="button" class="btn btn-danger" ng-click="delRol('<?= site_url('rol/delete') ?>/'+r.idrol, '<?= site_url('rol/getAll') ?>')"> Eliminar</button>
					</td>
				</tr>
				
			</tbody>
		</table>


	</fieldset>

	<?php $this->load->view('administracion/roles/form'); ?>

</section>