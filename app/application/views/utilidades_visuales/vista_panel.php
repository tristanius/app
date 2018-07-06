
<?php $this->load->view("utilidades_visuales/ruta_actual",array("direccion_act"=>$direccion_act)) ?>

<section class="row padding1ex">
    <?php 
        if(isset($menu)){
            $this->load->view("utilidades_visuales/menu",array("menu"=>$menu, "selected"=>$selected)) ;
        }	
    ?>

    <div class="col-md-10 border rounded">
    	<br>
        <?php echo $vista_pr ?>
    </div>

    <hr>
</section>

