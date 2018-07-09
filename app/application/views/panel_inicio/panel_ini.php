<div class="container-fluid">
   <legend><h4>Panel de general de modulos macro:</h4></legend>
    <style type="text/css">
    .gestions li{
        margin: 2px;
    }
    </style>
    
    <div class="padding1ex">
        <h5> <span class="badge badge-secondary"> Modulos generales: </span> </h5>


        <div class="row">

            <?php if ( existeAppSesion( $this->session->userdata('apps'),'gd' ) ): ?>
               <div class="card col-md-4">
                    <h6>Perfiles: </h6>
                    <p>
                        <a class="btn btn-info" href="<?= base_url('gd') ?>" >Docs. Perfiles y hojas de vida</a>
                    </p>
               </div>
            <?php endif ?>

            <?php if ( existeAppSesion( $this->session->userdata('apps'),'ot' ) ): ?>
                <div class="card col-md-4">
                    <h6>SICO - Sistema de Información para Control de Operaciones: </h6>
                    
                    <p>
                        <a class="btn btn-primary" href="<?= base_url('ot') ?>" >SICO App</a>
                    </p>

                    <?php 
                    $idrol = $this->session->userdata('idrol');
                    if ( $idrol = '1' ): 
                    ?>

                    <p>
                        <a class="btn btn-warning" href="<?= base_url('ot2') ?>" >SICO App [Pruebas] </a>
                    </p>

                    <?php endif ?>

                </div>               
            <?php endif ?>

            <?php 
                $idrol = $this->session->userdata('idrol');
                if ( $idrol == '1' ): 
            ?>
                <div class="card col-md-4">
                    <h6>Administración</h6>

                    <p>
                        <a href="<?= site_url('grud/') ?>" class="btn btn-outline-primary">Gestión Apps</a>
                    </p>

                    <p>
                        <a href="<?= site_url('administracion/privilegios') ?>" class="btn btn-outline-success">Gestión Privilegios</a>
                    </p>

                    <p>
                        <a href="<?= site_url('grud/') ?>" class="btn btn-outline-danger">Gestión Roles</a>
                    </p>

                    <p>
                        <a href="<?= site_url('grud/') ?>" class="btn btn-outline-warning">Gestión Usuarios</a>
                    </p>

                </div>               
            <?php endif ?>
        
        </div>
    </div>

    <hr style="clear:left;">


    <p>
        Señor usuario, tenga en cuenta que hay un seguimiento a cada uno de los procedimientos de la aplicación realizados.
    </p>   
    
</div>