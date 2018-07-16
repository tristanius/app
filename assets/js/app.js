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

app.controller("roles",function($scope, $http, $timeout){

	$scope.apps = [];
	$scope.privilegios = [];
	$scope.roles = [];
	$scope.rolForm = {};
	
	$scope.formRol = function(tag, rol){		
		if(!rol.privilegios){
			rol.privilegios = [];
		}
		$(tag).modal('toggle'); 
		$scope.rolForm = rol;
	}

	$scope.save = function(lnk, tag, lnkConsulta){
		$http.post(lnk, $scope.rolForm).then(
			function(resp){
				if(resp.data.status){
					$scope.rolForm = undefined;
					$scope.getRoles(lnkConsulta);
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
	$scope.addPrivilegioRol = function(rol, priv){
		var check = false;
		angular.forEach( rol.privilegios, function(v,k){
			if(v.idprivilegio == priv.idprivilegio)
				check = true;
		});
		if(!check){
			rol.privilegios.push(priv);
		}else{
			alert("Ya añadido anteriormente");
		}
	}

	$scope.deletePrivRol = function(lnk, priv){
		$http.get( lnk+'/'+priv).then(
			function(resp){
				if(resp.data.status){
					var i = $scope.rolForm.privilegios.indexOf( priv );
					$scope.rolForm.splice(i,1);
				}else{
					alert("Algo ha fallado en el procedimiento.");
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error en conexion al servidor");
				console.log(resp.data);
			}
			);
	}

	$scope.getRoles = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.roles = resp.data.roles;
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al consultar  los roles.")
				console.log(resp.data);
			}
		);
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
				alert("Error al consultar privilegios.")
				console.log(resp.data);
			}
		);
	}

});