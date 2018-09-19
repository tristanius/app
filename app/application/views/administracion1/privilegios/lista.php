
<section class="padding1ex border" ng-app="admin" ng-controller="privilegios">
	
	<fieldset class="padding1ex" >
		<legend> <h4> Gestion de privilegios de aplicaciones </h4> </legend>

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formPrivilegio" > Add. Privilegio</button>

		<br><br>

		<table  class="table table-bordered table-hover"  ng-init="getPrivilegios('<?= site_url('privilegio/getAll') ?>'); getGestiones('<?= site_url('gestion/getAll') ?>')">
			<thead class="thead-dark">
				<tr>
					<th>ID</th>
					<th>Privilegio</th>
					<th>Codigo priv.</th>
					<th>Gestion</th>
					<th>App</th>
					<th data-icon="y"></th>
				</tr>

				<tr>
					<th> </th>
					<th> <input class="form-control" ng-model="filtroPrivs.nombre_privilegio" placeholder="Filtro de elementos"> </th>
					<th> <input class="form-control" ng-model="filtroPrivs.codigo_privilegio" placeholder="Filtro de elementos"> </th>
					<th> <input class="form-control" ng-model="filtroPrivs.nombre_gestion" placeholder="Filtro de elementos"> </th>
					<th> <input class="form-control" ng-model="filtroPrivs.nombre_app" placeholder="Filtro de elementos">  </th>
					<th> </th>
				</tr>
			</thead>
			<tbody>

				<tr ng-repeat="p in privilegios | filter: filtroPrivs">
					<td ng-bind="p.idprivilegio"></td>
					<td ng-bind="p.nombre_privilegio"></td>
					<td ng-bind="p.codigo_privilegio"></td>
					<td ng-bind="p.nombre_gestion"></td>
					<td ng-bind="p.nombre_app"></td>
					<td>
						<button type="button" class="btn btn-warning" ng-click="formPrivilegio('#formPrivilegio', p)"> Modificar</button>
						<button type="button" class="btn btn-danger"> Eliminar</button>
					</td>
				</tr>
				
			</tbody>
		</table>

	</fieldset>

	<?php $this->load->view('administracion/privilegios/form'); ?>
	

</section>