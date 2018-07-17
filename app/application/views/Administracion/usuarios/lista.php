
<section class="padding1ex border" ng-app="admin" ng-controller="privilegios">
	
	<fieldset class="padding1ex" >
		<legend> <h4> Gestion de Usuarios</h4> </legend>

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formUsuario" > Add. usuario</button>

		<br><br>

		<table  class="table table-bordered table-hover" >
			<thead class="thead-dark">
				<tr>
					<th>ID</th>

					<th data-icon="y"></th>
				</tr>
				<tr>
					<th> </th>
					<th> </th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
				</tr>				
			</tbody>
		</table>


	</fieldset>

	<?php $this->load->view('administracion/usuarios/form'); ?>
	

</section>