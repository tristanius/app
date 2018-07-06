<section class="padding1ex border" ng-app="admin" ng-controller="gestion">
	
	<fieldset class="padding1ex">
		<legend> <h4> Gestion de privilegios de aplicaciones </h4> </legend>

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formGestion"> Add. Gestión</button>

		<br><br>

		<table  class="table table-bordered table-hover" ng-init="getGestiones('<?= site_url('gestion/getAll') ?>'); getApps('<?= site_url('gestion/getApps') ?>')">
			<thead class="thead-dark">
				<tr>
					<th>ID</th>
					<th>Descripción gestión</th>
					<th>Codigo gestión</th>
					<th>App</th>
					<th data-icon="y"></th>
				</tr>

				<tr>
					<th> </th>
					<th> <input class="form-control" ng-model="filtroGest.descripcion_gestion" placeholder="Filtro de elementos"> </th>
					<th> <input class="form-control" ng-model="filtroGest.nombre_gestion" placeholder="Filtro de elementos"> </th>
					<th> <input class="form-control" ng-model="filtroGest.nombre_app" placeholder="Filtro de elementos">  </th>
					<th> </th>
				</tr>
			</thead>
			<tbody>

				<tr ng-repeat="g in gestiones | filter: filtroPrivs">
					<td ng-bind="g.idgestion"></td>
					<td ng-bind="g.descripcion_gestion"></td>
					<td ng-bind="g.nombre_gestion"></td>
					<td ng-bind="g.nombre_app"></td>
					<td>
						<button type="button" class="btn btn-warning" ng-click="formGestion('#formGestion', g)"> Modificar</button>
						<button type="button" class="btn btn-danger"> Eliminar</button>
					</td>
				</tr>
				
			</tbody>
		</table>


	</fieldset>

	<?php $this->load->view('administracion/gestion/form'); ?>
	

</section>