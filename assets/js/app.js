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
	$scope.rolForm = {privilegios:[]};
	
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
					$scope.getRoles(lnkConsulta);
					$(tag).modal('toggle'); 
					$scope.rolForm = {};
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al guardar el rol.")
				console.log(resp.data);
			}
		);
	}
	$scope.delRol = function(lnk, lnkConsulta){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.getRoles(lnkConsulta);
				}else{
					alert(resp.data.msj)
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error: no se puede eliminar el rol, revisa si ha sido asignado a un usuario.")
				console.log(resp.data);
			}
		);
	}

	$scope.addPrivilegioRol = function(rol, priv){
		var check = false;				
		if(!rol.privilegios){
			rol.privilegios = [];
		}
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
		if(confirm('¿Esta seguro de eliminar este privilegio al rol seleccionado? La eliminación será inmediata.')){
			var i = $scope.rolForm.privilegios.indexOf(priv);
			if(priv.idprivilegio_has_rol){
				$http.get(lnk+'/'+priv.idprivilegio_has_rol).then(
					function(resp){
						if(resp.data.status){
							$scope.rolForm.privilegios.splice(i,1);
						}else{
							alert('Algo ha salido mal, revisa tu sesión y vuelve a intentar.')
							console.log(resp.data);
						}
					},
					function(resp){
						alert('Error de consulta de servidor.');
						console.log(resp.data);
					}
				);
			}else{
				$scope.rolForm.privilegios.splice(i,1);
			}
		}
	}

	$scope.getRoles = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.roles = resp.data.roles;
				}else{
					alert("Algo no ha salido bien.")
				}

					console.log(resp.data);
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

app.controller("usuarios",function($scope, $http, $timeout){

	$scope.apps = [];
	$scope.usuarios = [];
	$scope.roles = [];
	$scope.myUser = {};
	
	$scope.formUser = function(tag, user){
		$(tag).modal('toggle'); 
		$scope.myUser = user;
	}

	$scope.save = function(lnk, tag, lnkConsulta){
		console.log($scope.myUser)
		$http.post(lnk, $scope.myUser).then(
			function(resp){
				if(resp.data.status == true){
					$scope.getUsuarios(lnkConsulta);
					$(tag).modal('toggle'); 
					$scope.myUser = {};
				}else if(resp.data.status == false){
					alert(resp.data.msj);
				}else{
					alert("Algo no ha salido bien.")
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error al guardar el usuario.")
				console.log(resp.data);
			}
		);
	}

	$scope.peticion = function(lnk, data, func){
		$http.post(lnk, data).then(
			function(resp){
				if(resp.data.status == true){
					func(resp);
				}else if(resp.data.status == false) {
					alert(resp.data.msj)
				}else{
					alert('Algo ha salido mal.')
					console.log(resp.data);
				}
			},
			function(resp){
				alert("Error: no se ha podido completar la petición al servidor.")
				console.log(resp.data);
			}
		);
	}

	$scope.getUsuarios = function(lnk){
		$scope.peticion(lnk, {}, function(resp){
			$scope.usuarios = resp.data.usuarios;
		});
	}

	$scope.getRoles = function(lnk,){
		$scope.peticion(lnk, {}, function(resp){
			$scope.roles = resp.data.roles;
		});
	}

	$scope.initContratosUser = function(lnk, tag, user){
		$scope.peticion(lnk, {}, function(resp){
			$scope.contratos = resp.data.contratos;
		});
		$scope.formUser(tag, user);
	}

	$scope.getContratoByUser = function(lnk, user){
		$scope.peticion(lnk, {idusuario: iduser}, function(resp){
			user.contratos =  resp.data.contratos;
		});
	}

	$scope.relacionarAcceso = function(user, rol, lnk, tag){
		if( confirm("¿Confirma el acceso de este contrato al usuario?") ){
			
		}
	}

});