<!DOCTYPE html >
<html lang="es">
	<?php $this->load->view('inicio/head',array()); ?>
	<body>

        <script type="text/javascript">
            var tp = false;
        $(document).ready(function(){
            $("#ver-pass").on("click",function(){
                if(!tp){
                    $("#password").attr({type:"text"});
                    tp = true;
                }else{
                    $("#password").attr({type:"password"});
                    tp = false;
                }
            });
            
            $(".detalle").on("click",function(){
                alert("Este campo es obligatorio");
            })
            ;
            $(document).on('click', function(e) {
              if (e.button == 2) {
                  e.preventDefault();
                  alert("Algunas funcionalidades has sido deshabilitadas en este punto por seguridad.");
                  return;
              }
            });
        });
        </script>

		<?php $this->load->view("inicio/header2",array()); ?>
		<hr class="hr-termo">
		<div class="bg-gray">
            <section class="content">
                <style>
                    #inisession{
                        margin:0 auto;
                    }
                    form h3{
                        font-family: 'Michroma', sans-serif;
                    }
                    
                </style>
                
                
                <div id="inisession" class="bg-white card col-sm-6 padding1ex">

                <?php
                if(isset($error) && $error){
                    ?>
                    <h4 class="bg-danger">Los datos ingresados no son correctos.</h4>
                    <?php
                }
                ?>
                    <form action="<?= site_url("sesion/validar_datos") ?>" method="POST" >
                        <fieldset>
                            <legend class=" text-center"><h3>Iniciar sesión</h3></legend>
                        </fieldset>    

                        <hr style="clear:left"/>

                        <div id="" class="row padding1ex">
                            
                            <div class="col-sm-4">
                                <a href="<?= site_url() ?>"><img src="<?php echo base_url("assets/img/termotecnica.jpg") ?>" style="width:100%"/></a>
                            </div>

                            <div class="col-sm-8 card">
                                <p>
                                    <div class="form-group">
                                        <label class="input-group-addon" data-icon="@"> 
                                            Nombre de Usuario:
                                        </label>              

                                        <input type="text" class="form-control" id="user" name="user"
                                             placeholder="Ingrese aqui el nombre de usuario" autofocus required>

                                    </div>
                                </p>
                                
                                <p>
                                    <div class="form-group">
                                        <label class="input-group-addon" data-icon="&#xe005;"> 
                                            Su Contraseña : 
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password"
                                             placeholder="Ingrese aqui su contraseña" required>
                                    </div>
                                </p>
                                
                                <button type="submit" class="btn btn-success" data-icon="&#xe007;"> Iniciar sesión</button>
                                <br><br>

                                
                                <p>
                                    <a href="<?= site_url('welcome/recover') ?>"> ¡He olvidado mis datos de acceso!</a>
                                </p>
                            </div>
                        
                        </div>
                    </form>
                </div>
                
                <!-- gestiones -->

                <hr style="clear:left"/>

            </section>
        </div>
        
        <hr class="hr-gray">
		<?php $this->load->view('inicio/footer'); ?>      

	</body>
</html>