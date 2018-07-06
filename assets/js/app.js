var app = angular.module("admin", []);

app.controller("privilegios",function($scope, $http, $timeout){

	$scope.privilegios = [];
	$scope.gestiones = [];
	$scope.priv = {};
	
	$scope.formPrivilegio = function(tag, priv){
		$(tag).modal('toggle'); 
		$scope.priv = JSON.parse(JSON.stringify( priv ));
	}

	$scope.save = function(lnk, priv, tag, lnkConsulta){
		$http.post(lnk, priv).then(
			function(resp){
				if(resp.data.status){
					$(tag).modal('hide');
					priv = undefined;
					$scope.getPrivilegios(lnkConsulta);
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al consultar  los privilegios.")
				console.log(resp.data);
			}
		)
	}

	$scope.getPrivilegios = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.privilegios = resp.data.privilegios;
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al guardar  los privilegios.")
				console.log(resp.data);
			}
		);
	}


	$scope.getGestiones = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.gestiones = resp.data.gestiones;
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al consultar  los privilegios.")
				console.log(resp.data);
			}
		);
	}

});

app.controller("gestion",function($scope, $http, $timeout){

	$scope.apps = [];
	$scope.gestiones = [];
	$scope.gestion = {};
	
	$scope.formGestion = function(tag, gestion){
		$(tag).modal('toggle'); 
		$scope.gestion = JSON.parse(JSON.stringify( gestion ));
	}

	$scope.save = function(lnk, gestion, tag, lnkConsulta){
		$http.post(lnk, gestion).then(
			function(resp){
				if(resp.data.status){
					$(tag).modal('hide');
					gestion = undefined;
					$scope.getGestiones(lnkConsulta);
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al guardar  los gestiones.")
				console.log(resp.data);
			}
		)
	}

	$scope.getGestiones = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.gestiones = resp.data.gestiones;
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al consultar  los gestiones.")
				console.log(resp.data);
			}
		);
	}


	$scope.getApps = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.apps = resp.data.apps;
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al consultar apps.")
				console.log(resp.data);
			}
		);
	}

});