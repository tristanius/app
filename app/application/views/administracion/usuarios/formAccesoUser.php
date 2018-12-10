<section id="formAccesoUser"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="formUsuario" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
		        
		        <h5 class="modal-title" id="TituloModal">Vista de asignacion de roles de usuario</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
		         
		    </div>
			<div class="modal-body">
				
				<fieldset>
					<h5>Información de usuario</h5>

					<table>
						<thead>
							<tr>
								<th>Identificación</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Tipo de acceso</th>
								<th>C.O.</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td ng-bind="myUser.identificación"></td>
								<td ng-bind="myUser.nombres"></td>
								<td ng-bind="myUser.apellidos"></td>
								<td ng-bind="myUser.tipo_visualizacion"></td>
								<td ng-bind="myUser.base_idbase"></td>
							</tr>
						</tbody>
					</table>
				</fieldset>
				
				<br>

				<div class="row" ng-if="myUser.tipo_visualizacion == 'contrato'">

					<div class="col-md-5">
						<legend>Selecciona un contrato para dar acceso</legend>
						<div>
							<table>
								<thead>
									<tr>
										<td> <input type="text" ng-model="filtroContratos.no_contrato"> </td>
										<td> <input type="text" ng-model="filtroContratos.objeto"> </td>
										<td> </td>
									</tr>
									<tr>
										<th>No. contrato</th>
										<th>Objeto de contrato</th>
										<th>Dar acceso <br>a contrato </th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="c in contratos">
										<td ng-bind="c.no_contrato"></td>
										<td> <p ng-bind="c.objeto"></p> </td>
										<td>
											<button ng-click="relacionarContrato('<?= site_url('usuario/relacionar_acceso_contrato') ?>', c.idcontrato, myUser.idusuario)">Add. acceso</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="col-md-5">

						<div class="alert alert-success" role="alert" ng-repeat="uc in myUser.contratos">
							<span ng-bind="uc.no_contrato"></span> <button class="btn btn-danger btn-sm">X</button>
						</div>
						
					</div>
					
				</div>

			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="myUser = {}">Close</button>
		    </div>
		</div>
	</div>
</section>