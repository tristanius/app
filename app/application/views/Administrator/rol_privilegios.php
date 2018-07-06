	<div ng-app="admin" ng-controller="privilegio_rol">
		<form ng-submit="send()" class="form bg-info" style="overflow:hidden;" method="post" accept-charset="utf-8">
			<legend><h3>Gestión de privilegios de usuarios</h3></legend>
			
			<div class="form-group col-md-3">
				<label for="name">ROL:</label> {{ rol.nombre_rol }}
			</div>
			<div class="form-group col-md-3">
				<label for="privi">privilegio:</label>
				<select name="privi" ng-model="privi">
					<optgroup ng-repeat="g_privs in gestiones" label="{{ g_privs.nombre_gestion }}">
						<option ng-repeat="pr in g_privs.privilegios" value="{{ pr.idprivilegio }}">
							{{ pr.idprivilegio+ '.' + pr.nombre_privilegio }}
						</option>
					</optgroup>
				</select>
			</div>
			<div class="form-group col-md-3">
				<button class="btn btn-primary"> + Agregar nuevo</button>
			</div>
			

			<br class="clear">
		</form>

		<table class="table table-stripped table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>ID priv.</th>
					<th>Nombre</th>
					<th>Gestión</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat=" it in privilegios_rol ">
					<td> {{ it.idprivilegio_has_rol }} </td>
					<td> {{ it.privilegio_idprivilegio }} </td>
					<td> {{ it.nombre_privilegio }} </td>
					<td> {{ it.nombre_gestion }} </td>
					<td> 
						<a ng-href="<?= site_url('administrator/del_priv_rol') ?>/{{ it.idprivilegio_has_rol }}" class="btn btn-danger">X</a> 
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<script type="text/javascript">
		var app = angular.module("admin", []);
		app.controller("privilegio_rol",function($scope, $http){
			$scope.rol = <?= json_encode($rol) ?>;
			$scope.privilegios_rol = <?= json_encode($privilegios_rol->result()) ?>;

			$scope.gestiones = <?= json_encode($gestiones) ?>;
			$scope.privi = "1";

			$scope.getNombrePr = function(id){
				var nom = {};
				angular.forEach($scope.gestiones, function(value, key){
					angular.forEach(value.privilegios, function(priv, k){
						console.log(priv);
						if(priv.idprivilegio == id){
							nom.nombre_privilegio =  priv.nombre_privilegio;
							nom.nombre_gestion = value.nombre_gestion;
						}
					});
				});
				return nom;
			}

			$scope.send = function(){
				var p = $scope.getNombrePr($scope.privi);
				var post = {
						'rol_idrol': $scope.rol.idrol ,
						'privilegio_idprivilegio': $scope.privi,
						'nombre_privilegio': p.nombre_privilegio,
						'nombre_gestion': p.nombre_gestion
					};
					
				$http.post("<?= site_url('administrator/add_privilegio_rol') ?>", post ).success(function(data){
					$scope.privilegios_rol.push(data);
				})
				.error(function(data){
					alert("Error: "+JSON.stringify(data));
				});
			}
		});
	</script>