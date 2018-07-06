<section>
    <legend><h2>Configure sus datos de acceso y mail</h2></legend>

    <?php
    if(isset($data["err"])){
    ?>
    <p class="bg-danger">Datos erroneos; Reintentelo.</p>
    <?php
    }
    ?>

    <script>
        $(document).ready(function(){
            setTimeout( function(){$("input").val("");}, 100);
            $("#form-contra").hide();
            $("#form-mail").hide();
            $("#btn-form-contra").on("click",function(){
                $("#form-contra").show();
                $("#form-mail").hide();
            });
            $("#btn-form-mail").on("click",function(){
                $("#form-mail").show();    
                $("#form-contra").hide();   
            });
        });
    </script>
    <div>
        <?php 
        if (isset($data['success'])) {
            echo "<p class='bg-info'> ".$data['success']."</p>";
        }
        ?>
        <button id="btn-form-contra" class="btn btn-default">Cambiar contraseña</button>
        <button id="btn-form-mail" class="btn btn-default">Mail de notificaciones</button>
    </div>


    <br>
    <div style="padding:1em;">
        <div id="form-contra">
            <form class="" action="<?php echo site_url('sesion/cambia_pass') ?>" method="post">
                <legend style="color:#0f364b">fomulario para cambiar su contraseña:</legend>
                <p class="bg-warning">
                    Precaución: Diligencie este formulario solo si desea cambiar su contraseña.
                </p>
                
                <div>
                    <div class="form-group">
                        <label for="pass">Ingrese contraseña actual:</label>
                        <input name="pass" type="password" value=""  class="form-control" placeholder="ingrese su actual contraseña"/>
                    </div> 
                </div>
                <hr>
                <div class="form-group">
                    <label for="pass">Ingrese contraseña nueva:</label>
                    <input name="pass1" type="password" value="" class="form-control" placeholder="ingrese su nueva contraseña"/>
                </div>
                <br>
                <br>
                <div class="form-group">
                    <label for="pass2">Confirme contraseña nueva:</label>
                    <input name="pass2" type="password" value="" class="form-control" placeholder="confirme la contraseña"/>
                </div>
                <br>
                <button class="btn btn-success" type="submit" >Cambiar contraseña </button>
            </form>
        </div>
        <br>
        <div id="form-mail">
            <form action="<?php echo site_url('sesion/mail') ?>" method="post">
                <legend style="color:#0f364b">fomulario para Agregar un correo para envio de notificaciones:</legend>
                <p class="bg-warning">Precaución solo diligencie este campo si desea que le lleguen algunas notificaciones importantes a su cuenta</p>
                <div class="form-group">
                    <label for="oldpass">Correo:</label>
                    <input name="oldpass" type="text" value=""  class="form-control" placeholder="Ej: micorreo@correo.com"/>
                </div> 
                <button class="btn btn-success" type="submit" >Add. correo</button>
            </form>
        </div>

    </div>
</section>
