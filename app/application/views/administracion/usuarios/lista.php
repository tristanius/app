
<section class="padding1ex border" ng-app="admin" ng-controller="usuarios">
	
	<fieldset class="padding1ex" >
		<legend> <h4> Gestion de Usuarios</h4> </legend>

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formUsuario" ng-init="getUsuarios('<?= site_url('usuario/getAll') ?>'); getRoles('<?= site_url('rol/getAll') ?>')"> Add. usuario</button>

		<br><br>

		<table  class="table table-bordered table-hover font11" >
			<thead class="thead-dark">
				<tr>
					<th> No. ID </th>
					<th> C.C.</th>
					<th> Nombres</th>
					<th> Apellidos</th>
					<th> C.O. </th>
					<th> Visualización </th>
					<th> Estado</th>
					<th> Roles</th>
					<th data-icon="y"> <small>Asignar <br> accesos</small> </th>
					<th data-icon="y"> Modificar</th>
					<th data-icon="y"> Reset pass</th>
					<th data-icon="y"> Invalidar User</th>
				</tr>
				<tr>
					<th></th>
					<th> <input type="text" placeholder="Filtro" ng-model="filtroUsers.persona_identificacion"> </th>
					<th> <input type="text" placeholder="Filtro" ng-model="filtroUsers.nombres"> </th>
					<th> <input type="text" placeholder="Filtro" ng-model="filtroUsers.apellidos"> </th>
					<th> <input type="text" placeholder="Filtro" ng-model="filtroUsers.base_idbase" style="width: 6ex;"> </th>
					<th> <input type="text" placeholder="Filtro" ng-model="filtroUsers.tipo_visualizacion" style="width: 6ex;"> </th>
					<th> <input type="text" placeholder="Filtro" ng-model="filtroUsers.estado" style="width: 6ex;"> </th>
					<th> <input type="text" placeholder="Filtro" ng-model="filtroUsers.nombre_rol"> </th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="u in usuarios | filter: filtroUsers">
					<td ng-bind="u.idusuario"></td>
					<td ng-bind="u.persona_identificacion"></td>
					<td ng-bind="u.nombres"></td>
					<td ng-bind="u.apellidos"></td>
					<td ng-bind="u.base_idbase"></td>
					<td ng-bind="u.tipo_visualizacion"></td>
					<td ng-bind="u.estado?'Activo':'Inactivo'"></td>
					<td ng-bind="u.nombre_rol"></td>
					<td> 
						<button class="btn btn-warning" ng-click="initContratosUser('<?= base_url('ot/index.php/contrato/get_contratos') ?>', #formAccesoUser, u); getContratoByUser('<?= site_url('usuario/get_contratos') ?>', u.idusuario)">Acceso C.O.</button> 
					</td>
					<td> 
						<button class="btn btn-warning" ng-click="formUser('#formUsuario', u)">Modificar</button> 
					</td>
					<td><a class="btn btn-default" style="padding:3px" href="<?= site_url('usuario/resetPass/') ?>/{{u.idusuario}}">R. Pass</a></td>
					<td><a class="btn btn-default" style="padding:3px" href="<?= site_url('usuario/invalidarAcceso/') ?>/{{u.idusuario}}">Invalidar</a></td>
				</tr>				
			</tbody>
		</table>

	</fieldset>

	<?php $this->load->view('administracion/usuarios/form'); ?>
	<?php $this->load->view('administracion/usuarios/formAccesoUser'); ?>
	

</section>